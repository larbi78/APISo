<?php
/**
 * Created by PhpStorm.
 * User: lukas
 * Date: 08/10/18
 * Time: 18:57
 */

namespace App\Controller;

use App\Form\OptionsType;
use App\Form\TaskType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Task;
use Symfony\Component\HttpFoundation\Request;

class MainController extends Controller
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function ListAction(Request $request)
    {
        $taskList = $this->getDoctrine()->getRepository('App\Entity\Task')->findAll();
        $form = $this->createForm(OptionsType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() and $form->isValid()) {
            $data = $form->getData();
            if ($data['status']) {
                $newTaskList = [];
                /** @var Task $task */
                foreach ($taskList as $task) {
                    if ($task->getStatus() == $data['status'])
                        array_push($newTaskList, $task);
                }
                $taskList = $newTaskList;
            }
            if ($data['tri'] == 'asc') {
                uasort($taskList, function (Task $a, Task $b) {
                    return strcmp($a->getCreationDate()->format('Y-m-d H:i:s'), $b->getCreationDate()->format('Y-m-d H:i:s'));
                });
            } elseif ($data['tri'] == 'desc') {
                uasort($taskList, function (Task $a, Task $b) {
                    return strcmp($b->getCreationDate()->format('Y-m-d H:i:s'), $a->getCreationDate()->format('Y-m-d H:i:s'));
                });
            }
        }
        return $this->render('list.html.twig',
            [
                'taskList' => $taskList,
                'form' => $form->createView()
            ]);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
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

    /**
     * @param Task $task
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function DeleteAction(Task $task)
    {
        if (!$task)
            return $this->redirectToRoute('list');
        $this->getDoctrine()->getManager()->remove($task);
        $this->getDoctrine()->getManager()->flush();
        return $this->redirectToRoute('list');
    }

    /**
     * @param Request $request
     * @param Task $task
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function UpdateAction(Request $request, Task $task)
    {
        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);
        if ($form->isSubmitted() and $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            if ($task != $form->getData()) {
                $task = $form->getData();
                $task->setModifiedDate(new \DateTime);
            } else
                $task = $form->getData();
            $em->persist($task);
            $em->flush();
            return $this->redirectToRoute('list');
        }
        return $this->render('update.html.twig',
            [
                'form' => $form->createView(),
                'task' => $task
            ]);
    }
}