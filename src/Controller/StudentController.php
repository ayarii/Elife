<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
    public function homePage(){
        return  new Response("bonjour DL3");
    }


    /**
     * @Route("/students", name="listStudent")
     */
    public function listStudent()
    {
        return new Response(" list Student");
   }
}
