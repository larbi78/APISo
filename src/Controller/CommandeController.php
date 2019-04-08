<?php
/**
 * Created by PhpStorm.
 * User: lukas
 * Date: 08/10/18
 * Time: 18:57
 */

namespace App\Controller;

use App\Entity\TableClient;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use App\Entity\Commande;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class CommandeController extends AbstractFOSRestController
{
    /**
     * List the rewards of the specified user.
     *
     * This call takes into account all confirmed awards, but not pending or refused awards.
     *
     * @Route("/api/commandes", methods={"POST"})
     */
    public function AddAction(Request $request)
    {

        $commandeArray = $request->request->all();
        $commande = $this->getDoctrine()->getRepository(Commande::class)->find($commandeArray['id']);

        if ($commande === null) {
            $commande = new Commande();
        }
        $commande->setId($commandeArray['id']);
        $commande->setDate($commandeArray['date']);
        $commande->setStatus($commandeArray['status']);
        $tableClient = $this->getDoctrine()->getRepository(TableClient::class)->find($commandeArray['table_client']);
        if($tableClient)
            $commande->setTableClient($tableClient);
        $this->getDoctrine()->getManager()->persist($commande);
        $this->getDoctrine()->getManager()->flush();
        return new JsonResponse(200);
    }

}