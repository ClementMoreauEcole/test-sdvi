<?php

declare(strict_types = 1);

namespace App\Repository;

use App\Entity\Pizzeria;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Class PizzeriaRepository
 * @package App\Repository
 */
class PizzeriaRepository extends ServiceEntityRepository
{
    /**
     * PizzeriaRepository constructor.
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Pizzeria::class);
    }

    /**
     * @return array
     */
    public function findAll(): array
    {
        // exécution de la requête
        return parent::findAll();
    }

    /**
     * @param int $pizzeriaId
     * @return Pizzeria
     */
    public function findCartePizzeria($pizzeriaId): Pizzeria
    {
        // test si l'id de la pizza est bien un nombre supérieur à 0
        if (!is_numeric($pizzeriaId) || $pizzeriaId <= 0) {
            throw new \Exception("Impossible de d'obtenir le détail de la pizza ({$pizzeriaId}).");
        }

        // création du query builder avec l'alias p pour pizza
        $qb = $this->createQueryBuilder("p");

        // création de la requête
        $qb
            ->addSelect(["piz"])
            ->innerJoin("p.pizzas", "piz")
            ->where("p.id = :idPizzeria")
            ->setParameter("idPizzeria", $pizzeriaId)
        ;

        // exécution de la requête
        return $qb->getQuery()->getSingleResult();
    }
}
