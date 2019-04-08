<?php
/**
 * Created by PhpStorm.
 * User: lukas
 * Date: 08/10/18
 * Time: 18:57
 */

namespace App\Controller;

use App\Entity\ProduitIngredient;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class IngredientController extends Controller
{
    /**
     * @Route("/api/ingredients", methods={"GET"})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function ListAction(Request $request)
    {
        $ingredientList = [];
        $filterArray = [];
        $filter = $request->request->all();
        if(isset($filter['idProduit'])) {
            $filterArray['id_Produit'] = $filter['idProduit'];
        }
        $produitIngredientList = $this->getDoctrine()->getRepository(ProduitIngredient::class)->findBy($filterArray);

        if ($produitIngredientList) {
            foreach($produitIngredientList as $produitIngredient) {
                $ingredientList[] = $produitIngredient->getIngredient();
            }
        }
        return new JsonResponse($ingredientList);
    }
}