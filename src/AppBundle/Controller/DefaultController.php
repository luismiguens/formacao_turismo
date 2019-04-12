<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{

//    public function indexAction(Request $request)
//    {
//        // replace this example code with whatever you need
//        return $this->render('default/index.html.twig', [
//            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
//        ]);
//    }
    
    
    
    
    
    
    
     public function indexAction(Request $request) {

//        $em = $this->getDoctrine()->getManager();
//
//        $yearNumber = $request->get('year');
//        $year = $em->getRepository('AppBundle:Year')->findOneBy(['number' => $yearNumber]);
//
//        
//        $businesses = $em->getRepository('AppBundle:Business')->findBusinessByYear($year);
//        $speakers = $year->getSpeakers();
//        $photos = $year->getPhotos();
//        $sponsors = $year->getSponsors();

//        return $this->render('AppBundle:default:index.html.twig', array(
//                    'year' => $yearNumber,
//                    'businesses' => $businesses,
//                    'speakers' => $speakers,
//                    'photos' => $photos,
//                    'sponsors' => $sponsors,
//        ));
         
         
         $em = $this->getDoctrine()->getManager();
         
         $parceiros = $em->getRepository('AppBundle:Parceiro')->findAll();
          $categorias = $em->getRepository('AppBundle:Categoria')->findAll();
         
         
                 return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
                     'parceiros' => $parceiros ,
                     'categorias' => $categorias 
        ]);
         
    }
    
    
    
}
