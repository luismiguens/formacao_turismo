<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller {
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


        $message = (new \Swift_Message('Candidatura a Emprego submetida '))
                ->setFrom('hea.no.reply@gmail.com', "HEA")
                ->setTo('luis.t.miguens@gmail.com')
                ->setCc(['luis.t.miguens@gmail.com'])
                ->setBody('Foi submetida uma nova candidatura a emprego no site com os seguintes dados:' . '<br/>'
                        . 'Em anexo segue o curriculo do candidato e poderá consultar todos os candidatos  clicando no seguinte '
                )
                ->setContentType("text/html");



        $this->get('mailer')->send($message);

        $this->get('session')->getFlashBag()->add(
                'notice', 'Candidatura Criada com Sucesso!'
        );


        return $this->render('default/email.html.twig', [
                    'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR
        ]);
    }

    public function indexAction(Request $request) {

        
        echo phpinfo();
        
        
        $em = $this->getDoctrine()->getManager();

        $parceiros = $em->getRepository('AppBundle:Parceiro')->findBy(['isJuri' => false]);
        $juris = $em->getRepository('AppBundle:Parceiro')->findBy(['isJuri' => true]);
        $categorias = $em->getRepository('AppBundle:Categoria')->findAll();


        return $this->render('default/index.html.twig', [
                    'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
                    'parceiros' => $parceiros,
                    'juris' => $juris,
                    'categorias' => $categorias
        ]);
    }

}
