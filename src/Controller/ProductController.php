<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/product", name="product")
     */
    public function index(): Response
    {
        return $this->render('product/index.html.twig', [
            'controller_name' => 'ProductController',
        ]);
    }


    /**
     * @Route("/listproduct/{name}", name="listproduct")
     */
    public function listProduct($name){
        return new Response("la liste des étudiants de la classe".$name);
    }

    /**
     * @Route("/showProducts", name="showProducts")
     */
    public function showProduct(){
        $x= "salim";
        $y="marwen";
        $formations = array(
            array('ref' => 'form147', 'Titre' => 'Formation Symfony
4','Description'=>'formation pratique',
                'date_debut'=>'12/06/2020', 'date_fin'=>'19/06/2020',
                'nb_participants'=>19) ,
            array('ref'=>'form177','Titre'=>'Formation SOA' ,
                'Description'=>'formation
theorique','date_debut'=>'03/12/2020','date_fin'=>'10/12/2020',
                'nb_participants'=>0),
            array('ref'=>'form178','Titre'=>'Formation Angular' ,
                'Description'=>'formation
theorique','date_debut'=>'10/06/2020','date_fin'=>'14/06/2020',
                'nb_participants'=>12));

        return $this->render("product/list.html.twig",array("value1"=>$x,"value2"=>$y,"listFormation"=>$formations));
    }
}
