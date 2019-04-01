<?php
/**
 * Created by PhpStorm.
 * User: lukas
 * Date: 08/10/18
 * Time: 18:57
 */

namespace App\Controller;

use App\Entity\Produit;
use App\Entity\TableClient;
use Symfony\Bundle\FrameWorkBundle;
use App\Entity\Commande;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ProduitController extends Controller
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function ListAction(Request $request)
    {
        $filter = $request->request->all();
        $produitList = $this->getDoctrine()->getRepository(Produit::class)->findBy([$filter['type']]);
        return new JsonResponse($produitList);
    }
}