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
    
    
    
        /**
     * Creates a job entity.
     *
     */
    public function emailAction(Request $request) {


            $message = (new \Swift_Message('Candidatura a Emprego submetida em http://bolsadeempregabilidade.pt'))
                    ->setFrom('hea.no.reply@gmail.com', "HEA")
                    ->setTo('luis.t.miguens@gmail.com')
                    ->setCc(['luis.t.miguens@gmail.com'])
                    ->setBody('Foi submetida uma nova candidatura a emprego no site http://bolsadeempregabilidade.pt com os seguintes dados:' . '<br/>'
//                            . 'Titulo do Emprego: ' . '' . $tituloEmprego . '<br/>'
//                            . 'Nome do Candidato: ' . '' . $nomeCandidato . '<br/>'
//                            . 'Email do Candidato: ' . '' . $emailCandidato . '<br/>'
//                            . '<br/>'
                            . 'Em anexo segue o curriculo do candidato e poderá consultar todos os candidatos  clicando no seguinte '
                    )
                    ->setContentType("text/html");
            
            
            
//            if ($user->getCv() != NULL):
//                $curriculo = $request->getUriForPath('/uploads/curriculo/' . $user->getCv());
//                $message->attach(\Swift_Attachment::fromPath($curriculo)->setFilename('curriculo_' . $nomeCandidato . '.' . pathinfo($user->getCv(), PATHINFO_EXTENSION)));
//            endif;

            $this->get('mailer')->send($message);

            $this->get('session')->getFlashBag()->add(
                    'notice', 'Candidatura Criada com Sucesso!'
            );
        

   return $this->render('default/email.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR
 
        ]);
    }

    
    
    
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
