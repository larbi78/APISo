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
     * Create or update a commande
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
        $commande->setDate(new \DateTime($commandeArray['date']));
        $commande->setStatus($commandeArray['status']);
        $tableClient = $this->getDoctrine()->getRepository(TableClient::class)->find($commandeArray['table_client']);
        if($tableClient)
            $commande->setTableClient($tableClient);
        $this->getDoctrine()->getManager()->persist($commande);
        $this->getDoctrine()->getManager()->flush();
        return new JsonResponse(200);
    }

    /**
     * List one or many commandes
     * @Route("/api/commandes", methods={"GET"})
     */
    public function ListAction(Request $request)
    {
        $commandeList = [];
        $filter = $request->request->all();
        $commandeList = $this->getDoctrine()->getRepository(Commande::class)->findBy($filter);

        if ($commandeList !== null) {
            /** @var Commande $commande */
            foreach($commandeList as $commande) {
                $array[] = [
                    'id' => $commande->getId(),
                    'date' => $commande->getDate()->format('Y/m/d'),
                    'status' => $commande->getStatus(),
                    'tableClient' => $commande->getTableClient()->getId()
                ];
            }
        }
        return new JsonResponse($array);
    }
}