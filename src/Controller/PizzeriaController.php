<?php

declare(strict_types = 1);


namespace App\Controller;

use App\Service\Dao\PizzeriaDao;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Pizzeria;

/**
 * Class PizzeriaController
 * @package App\Controller
 */
class PizzeriaController extends AbstractController
{
    /**
     * @param PizzeriaDao $pizzeriaDao
     * @Route("/pizzerias")
     * @return Response
     */
    public function listeAction(PizzeriaDao $pizzeriaDao): Response
    {
        // récupération des différentes pizzéria de l'application
        $pizzerias = $pizzeriaDao->getAllPizzerias();

        return $this->render("Pizzeria/liste.html.twig", [
            "pizzerias" => $pizzerias,
        ]);
    }

    /**
     * @param int $pizzeriaId
     * @Route(
     *     "/pizzerias/carte-{pizzeriaId}",
     *     requirements={"pizzeriaId": "\d+"}
     * )
     * @return Response
     */
    public function detailAction($pizzeriaId): Response
    {
        $repository=$this->getDoctrine()->getRepository(Pizzeria::class);
        // $pizzeria = $repository->find($pizzeriaId);
        $pizzeriaDao = new PizzeriaDao($repository);
        $Carte = $pizzeriaDao->getCartePizzeria(intval($pizzeriaId));
        $marge = $Carte->getMarge();
        // $Pizza = $repository->find(intval($pizzeriaId));
        // $listeIngredient = $Pizza->getQuantiteIngredients();
        // $cout = $marge;
        // foreach( $listeIngredient as $ingredient)
        // {
        //     $cout += $ingredient->getIngredient()->getCout();
        
           
        // }
        return $this->render("Pizzeria/carte.html.twig", [
            "Carte" => $Carte,
        
        ]);
    }
}
