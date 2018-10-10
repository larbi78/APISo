<?php
/**
 * Created by PhpStorm.
 * User: lukas
 * Date: 08/10/18
 * Time: 18:57
 */

namespace App\Controller;

use App\Form\TaskType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Task;
use Symfony\Component\HttpFoundation\Request;

class MainController extends Controller
{
    public function ListAction()
    {
        $taskList = $this->getDoctrine()->getRepository('App\Entity\Task')->findAll();
        return $this->render('list.html.twig',
            [
                'taskList' => $taskList
            ]);
    }

    public function CreateAction(Request $request)
    {
        $form = $this->createForm(TaskType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() and $form->isValid()) {
            $task = new Task();
            $data = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $task->setTitle($data['Title']);
            $task->setDescription($data['Description']);
            $task->setStatus($data['Status']);
            $task->setCreationDate(new \DateTime);
            $em->persist($task);
            $em->flush();
            return $this->redirectToRoute('list');
        }
        return $this->render('create.html.twig',
            [
                'form' => $form->createView()
            ]);
    }

    public function DeleteAction()
    {

    }

    public function UpdateAction()
    {

    }

}