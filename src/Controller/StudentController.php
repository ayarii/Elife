<?php

namespace App\Controller;

use App\Entity\Classroom;
use App\Entity\Student;
use App\Form\ClassroomType;
use App\Form\SearchStudentType;
use App\Form\StudentType;
use App\Repository\StudentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StudentController extends AbstractController
{
    /**
     * @Route("/student", name="student")
     */
    public function index(): Response
    {
        return $this->render('student/index.html.twig', [
            'controller_name' => 'StudentController',
        ]);
    }

    /**
     * @Route("/home", name="homePage")
     */
    public function homePage()
    {
        return new Response("bonjour DL3");
    }


    /**
     * @Route("/students", name="listStudent")
     */
    public function listStudent()
    {
        return new Response(" list Student");
    }

    /**
     * @Route("/addStudent", name="addStudent")
     */
    public function addStudent(StudentRepository $repository, Request $request)
    {

        //afficher la liste des étudiants
        $students = $repository->findAll();
        //$students= $repository->listOfStudentOrderByName();
        //  $students= $repository->listStudent();
        //ajouter un étudiant
        $student = new Student();
        $classroom = new Classroom();
        $form = $this->createForm(StudentType::class, $student);
        $formClassroom = $this->createForm(ClassroomType::class, $classroom);
        $formsearchStudent = $this->createForm(SearchStudentType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($student);
            $em->flush();
            // return new Response("Edudiant Ajouté avec succé");
            return $this->redirectToRoute("addStudent");
        }
        //ajouter  une classe
        $formClassroom->handleRequest($request);
        if ($formClassroom->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $dateNow = new \DateTime();
            $classroom->setCreatedAt($dateNow);
            $em->persist($classroom);
            $em->flush();
            return $this->redirectToRoute("addStudent");
        }
       //recherche d'un étudiant
        $formsearchStudent->handleRequest($request);
        if($formsearchStudent->isSubmitted() ){
            $nce=$formsearchStudent->getData();
            $listStudents= $repository->searchStudent($nce);
            return $this->render("student/add.html.twig", array('students'=>$listStudents,'searchStudent' => $formsearchStudent->createView(), 'formClassroom' => $formClassroom->createView(), 'formStudent' => $form->createView()));
        }

        return $this->render("student/add.html.twig", array('searchStudent' => $formsearchStudent->createView(), 'formClassroom' => $formClassroom->createView(), 'students' => $students, 'formStudent' => $form->createView()));
    }

    /**
     * @Route("/updateStudent/{nce}", name="updateStudent")
     */
    public function updateStudent($nce, Request $request)
    {
        $student = $this->getDoctrine()->getRepository(Student::class)->find($nce);
        $x = $student->getNce();
        $form = $this->createForm(StudentType::class, $student);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $student->setNce($x);
            $em->flush();
            return new Response("L'étudiant:" . $student->getFirstName() . " " . $student->getLastName() . "a été modifié");
            //return $this->redirectToRoute("addStudent");
        }
        return $this->render("student/update.html.twig", array('formStudent' => $form->createView()));
    }


}
