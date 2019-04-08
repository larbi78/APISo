<?php
/**
 * Created by PhpStorm.
 * User: lukas
 * Date: 08/10/18
 * Time: 18:57
 */

namespace App\Controller;

use App\Entity\Produit;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProduitController extends Controller
{
    /**
     * @Route("/api/produits", methods={"GET"})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function ListAction(Request $request)
    {
        $filterArray = [];
        $filter = $request->request->all();
        if(isset($filter['type'])) {
            $filterArray['type'] = $filter['type'];
        }
        $filter = $request->request->all();
        $produitList = $this->getDoctrine()->getRepository(Produit::class)->findBy([$filter['type']]);
        return new JsonResponse($produitList);
    }
}