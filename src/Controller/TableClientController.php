<?php
/**
 * Created by PhpStorm.
 * User: lukas
 * Date: 08/10/18
 * Time: 18:57
 */

namespace App\Controller;

use App\Entity\TableClient;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TableClientController extends Controller
{
    /**
     * List the rewards of the specified user.
     *
     * This call takes into account all confirmed awards, but not pending or refused awards.
     *
     * @Route("/api/tableclients", methods={"GET"})
     */
    public function ListAction(Request $request)
    {
        $filter = $request->request->all();
        $filterArray = [];
        if(isset($filter['status']))
            $filterArray['status'] = $filter['status'];

        $tableClientList = $this->getDoctrine()->getRepository(TableClient::class)->findBy($filterArray);

        return new JsonResponse($tableClientList);
    }


    /**
     * @Route("/api/tableclients/{id}", methods={"PUT"})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function UpdateAction(Request $request)
    {
        $tableClientArray = $request->request->all();
        $tableClient = $this->getDoctrine()->getRepository(TableClient::class)->find([$tableClientArray['id']]);
        $tableClient->setStatus($tableClientArray['status']);

        return new JsonResponse(200);
    }
}