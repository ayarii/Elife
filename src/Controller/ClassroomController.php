<?php

namespace App\Controller;

use App\Entity\Classroom;
use App\Form\ClassroomType;
use App\Repository\ClassroomRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClassroomController extends AbstractController
{
    /**
     * @Route("/classroom", name="classroom")
     */
    public function index(): Response
    {
        return $this->render('classroom/index.html.twig', [
            'controller_name' => 'ClassroomController',
        ]);
    }


    /**
     * @Route("/listClassroom", name="classroomlist")
     */
    public function listClassroom()
    {
        $classe1 = "DL3";
        $classe2 = "DL2";

        return $this->render("classroom/listClassroom.html.twig", array("classe1" => $classe1, "classe2" => $classe2));
    }

    /**
     * @Route("/list", name="listclassroom")
     */
    public function list(ClassroomRepository $classroomRepository)
    {
        $classrooms = $classroomRepository->findAll();
        //  $listClassroom= $this->getDoctrine()->getRepository(Classroom::class)->findAll();
        return $this->render("classroom/list.html.twig", array("classrooms" => $classrooms));
    }

    /**
     * @Route("/add", name="addClassroom")
     */
    public function add(Request $request)
    {
        $classroom = new Classroom();
        $form = $this->createForm(ClassroomType::class, $classroom);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($classroom);
            $em->flush();
            return $this->redirectToRoute("listclassroom");
        }
        return $this->render("classroom/add.html.twig", array("formClassroom" => $form->createView()));
    }

    /**
     * @Route("/update/{id}", name="updateClassroom")
     */
    public function update($id, Request $request)
    {
        $classroom = $this->getDoctrine()->getRepository(Classroom::class)->find($id);
        $form = $this->createForm(ClassroomType::class, $classroom);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute("listclassroom");
        }
        return $this->render("classroom/update.html.twig", array("formClassroom" => $form->createView()));
    }

    /**
     * @Route("/remove/{id}", name="removeClassroom")
     */
    public function delete($id)
    {
        $classroom = $this->getDoctrine()->getRepository(Classroom::class)->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($classroom);
        $em->flush();
        return $this->redirectToRoute("listclassroom");
    }
}
