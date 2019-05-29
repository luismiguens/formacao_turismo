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

        $em = $this->getDoctrine()->getManager();

        $parceiros = $em->getRepository('AppBundle:Parceiro')->findBy(['isJuri' => false]);
        $juris = $em->getRepository('AppBundle:Parceiro')->findBy(['isJuri' => true]);
        $categorias = $em->getRepository('AppBundle:Categoria')->findAll();


        $contact = new \AppBundle\Entity\Contact();
        $form = $this->createForm('AppBundle\Form\ContactType', $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
//            $em = $this->getDoctrine()->getManager();
//            $em->persist($contact);
//            $em->flush();

            if ($this->sendEmail($contact) == 0) {
                $this->addFlash(
                        'error', 'O seu contacto não pude ser enviado neste momento. Por favor tente mais tarde, ou contacte os nossos serviços.'
                );
            } else {
                $this->get('session')->getFlashBag()->add(
                        'notice', 'O seu contacto foi enviado com sucesso. Por favor, aguarde um contacto dos nossos serviços.'
                );
            }



            return $this->redirectToRoute('homepage', array(
                        'contact' => $contact,
                        'parceiros' => $parceiros,
                        'juris' => $juris,
                        'categorias' => $categorias,
                        'form' => $form->createView(),
                        '_fragment' => 'contact'
            ));
        }

        return $this->render('default/index.html.twig', array(
                    'contact' => $contact,
                    'parceiros' => $parceiros,
                    'juris' => $juris,
                    'categorias' => $categorias,
                    'form' => $form->createView(),
        ));
    }

    private function sendEmail(\AppBundle\Entity\Contact $contact) {

        
        $message = (new \Swift_Message('Novo contacto em Hea.pt'))
                ->setFrom('hea.no.reply@gmail.com', "Hea.pt")
                ->setTo(['luis.t.miguens@gmail.com', 'csilva@forumturismo21.org', 'amarto@forumturismo21.org']) //TESTING
                //->setCc(['luis.t.miguens@gmail.com', 'csilva@forumturismo21.org', 'vcunha@forumturismo21.org'])
                ->setBody('Foi efetuado um novo contacto no site Hea.pt com os seguintes dados:' . '<br><br>'
                        . 'Nome: ' . '' . $contact->getName() . '<br>'
                        . 'Email: ' . '' . $contact->getEmail() . '<br>'
                        . 'Telefone: ' . '' . $contact->getPhone() . '<br>'
                        .'<br><br>'
                        . 'Mensagem: ' . '' . $contact->getMessage() . '<br>'
                        )
                
                ->setContentType("text/html");

        return $this->get('mailer')->send($message);
        //return $mailer->send($message);
    }

}
