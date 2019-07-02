<?php

declare(strict_types = 1);

namespace App\Controller;

use App\Service\Dao\PizzaDao;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Proxies\__CG__\App\Entity\Pizza;

/**
 * Class PizzaController
 * @package App\Controller
 */
class PizzaController extends AbstractController
{
    /**
     * @param PizzaDao $pizzaDao
     * @Route("/pizzas")
     * @return Response
     */
    public function listeAction(PizzaDao $pizzaDao): Response
    {
        // récupération des différentes pizzas
        $pizzas = $pizzaDao->getAllPizzas();

        return $this->render("Pizza/liste.html.twig", [
            "pizzas" => $pizzas,
        ]);
    }

    /**
     * @param int $pizzaId
     * @Route(
     *     "/pizzas/detail-{pizzaId}",
     *     requirements={"pizzaId": "\d+"}
     * )
     * @return Response
     */
    public function detailAction(int $pizzaId): Response
    {
        $repository=$this->getDoctrine()->getRepository(Pizza::class);
        $Pizza = $repository->find($pizzaId);
        $listeIngredient = $Pizza->getQuantiteIngredients();
        $cout = -1;
        foreach( $listeIngredient as $ingredient)
        {
            $cout += $ingredient->getIngredient()->getCout();
        }
        return $this->render("Pizza/detail.html.twig", [
            "pizza" => $Pizza,
            "cout" => $cout,
            
        ]);
    }
}
