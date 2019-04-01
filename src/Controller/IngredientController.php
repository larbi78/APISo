<?php
/**
 * Created by PhpStorm.
 * User: lukas
 * Date: 08/10/18
 * Time: 18:57
 */

namespace App\Controller;

use App\Entity\Ingredient;
use App\Entity\ProduitIngredient;
use App\Entity\TableClient;
use Symfony\Bundle\FrameWorkBundle;
use App\Entity\Commande;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class IngredientController extends Controller
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function ListAction(Request $request)
    {
        $ingredientList = [];
        $filter = $request->request->all();
        $produitIngredientList = $this->getDoctrine()->getRepository(ProduitIngredient::class)->findBy([$filter['id_Produit']]);

        if ($produitIngredientList) {
            foreach($produitIngredientList as $produitIngredient) {
                $ingredientList[] = $produitIngredient->getIngredient();
            }
        }
        return new JsonResponse($ingredientList);
    }
}