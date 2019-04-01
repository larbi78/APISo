<?php
/**
 * Created by PhpStorm.
 * User: lukas
 * Date: 08/10/18
 * Time: 18:57
 */

namespace App\Controller;

use App\Entity\TableClient;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class TableClientController extends Controller
{
    /**
     * List the rewards of the specified user.
     *
     * This call takes into account all confirmed awards, but not pending or refused awards.
     *
     * @Rest\Route("/api/list2", methods={"GET"})
     */
    public function ListAction(Request $request)
    {
        $filter = $request->request->all();
        if(isset($filter['status']))
            $tableClientList = $this->getDoctrine()->getRepository(TableClient::class)->findBy([$filter['status']]);
        else
            $tableClientList = $this->getDoctrine()->getRepository(TableClient::class)->findAll();

        return new JsonResponse($tableClientList);
    }


    /**
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