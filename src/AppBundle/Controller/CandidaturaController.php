<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Candidatura;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\File;

/**
 * Candidatura controller.
 *
 */
class CandidaturaController extends Controller {

    /**
     * Lists all candidatura entities.
     *
     */
//    public function indexAction() {
//        $em = $this->getDoctrine()->getManager();
//
//        $candidaturas = $em->getRepository('AppBundle:Candidatura')->findAll();
//
//        return $this->render('candidatura/index.html.twig', array(
//                    'candidaturas' => $candidaturas,
//        ));
//    }
    
    
    
    
        public function nomeadasAction() {
        $em = $this->getDoctrine()->getManager();

        $candidaturas = $em->getRepository('AppBundle:Candidatura')->findBy(array('nomeada'=>1), array('categoria' => 'DESC'));

        return $this->render('candidatura/nomeadas.html.twig', array(
                    'candidaturas' => $candidaturas,
        ));
    }


    


    public function indexAction() {
        $em = $this->getDoctrine()->getManager();


        if ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN') || $this->get('security.authorization_checker')->isGranted('ROLE_JURI')) {
            $candidaturas = $em->getRepository('AppBundle:Candidatura')->findAll();
            return $this->render('candidatura/index_admin.html.twig', array(
                        'candidaturas' => $candidaturas
            ));
        } else {
            $user = $this->getUser();
            $candidaturas = $user->getCandidaturas();
            $categorias = $em->getRepository('AppBundle:Categoria')->findBy(['isSemCandidatura' => false]);

            return $this->render('candidatura/index.html.twig', array(
                        'candidaturas' => $candidaturas,
                        'categorias' => $categorias
            ));
        }
    }

    
    
    
    public function newAfterAction(Request $request, \AppBundle\Entity\Categoria $categoria) {
    return $this->redirectToRoute('admin_candidatura_index');
    }
    
    
    /**
     * Creates a new candidatura entity.
     *
     */
    public function newAction(Request $request, \AppBundle\Entity\Categoria $categoria) {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();

        $candidatura = new Candidatura();
        $candidatura->setCategoria($categoria);
        $candidatura->setFosUser($user);




        $criterios = $categoria->getCriterios();

        //$criterios = $em->getRepository('AppBundle:Criterio')->findBy(array('categoria' => $categoria->getId(), 'isApenasVotacao' => true));



        foreach ($criterios as $key => $criterio) {
            $resposta = new \AppBundle\Entity\Resposta();
            $resposta->setCriterio($criterio);
            $candidatura->getRespostas()->add($resposta);
        }

        $form = $this->createForm('AppBundle\Form\CandidaturaType', $candidatura);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            foreach ($candidatura->getRespostas() as $resposta) {
                $resposta->setCandidatura($candidatura);
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($candidatura);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                    'notice', 'Candidatura criada com sucesso!'
            );

            if ($request->getLocale() == 'pt') {

                $body = "<p>Olá " . $candidatura->getPromotorNome() . "! Recebemos a sua candidatura com sucesso. Obrigado por nos ajudar a valorizar o seu trabalho.</p>
             <p>Entretanto, caso queira atualizar a sua candidatura, pode fazê-lo até à data de encerramento das candidaturas, no dia 30 de Junho.</p>
             <p>Depois dessa data, iremos avaliar se a sua candidatura cumpre todos os requisitos do regulamento e, caso seja necessário fazer alguma correção, iremos notificá-lo/a e terá 48h para proceder à sua correção após notificação dada.</p>
             <p>A partir do dia 16 de Julho iremos anunciar todos os finalistas dos Hospitality Education Awards 2020.</p>
             <p>Fique atento e boa sorte!</p>";

            } else {

                $body = "<p>Hello " . $candidatura->getPromotorNome() . "! We have successfully received your application. Thank you for helping us value your work.</p>
             <p>However, if you want to update your application, you can do so until the closing date of applications, on 30th of June.</p>
             <p>After that date, we will assess whether your application meets all the requirements of the regulation and, if it is necessary to make any correction, we will notify you and you will have 48 hours to proceed with your correction after giving notification.</p>
             <p>From the 16th of July we will announce all the finalists of the Hospitality Education Awards 2020. </p>
             <p>Stay tuned and good luck!</p>";

            }

            $message = (new \Swift_Message('Hea.pt - Candidatura numero ' . $candidatura->getId() . ' criada com sucesso! '))
                    ->setFrom('hea.no.reply@gmail.com', "Hea.pt")
                    //->setTo('luis.t.miguens@gmail.com')
                    ->setTo($candidatura->getPromotorEmail())
                    ->setBcc(['luis.t.miguens@gmail.com', 'csilva@forumturismo21.org', 'vcunha@forumturismo21.org'])
                    ->setBody($body)
                    ->setContentType("text/html");

            $this->get('mailer')->send($message);

            return $this->redirectToRoute('admin_candidatura_edit', array('id' => $candidatura->getId()));
        }

        return $this->render('candidatura/new.html.twig', array(
                    'candidatura' => $candidatura,
                    'form' => $form->createView(),
                    'criterios' => $criterios,
                    'categoria' => $categoria
        ));
    }

    /**
     * Finds and displays a candidatura entity.
     *
     */
    public function showAction(Candidatura $candidatura) {
        $deleteForm = $this->createDeleteForm($candidatura);

        return $this->render('candidatura/show.html.twig', array(
                    'candidatura' => $candidatura,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    
    
    
     public function editAction(Request $request, Candidatura $candidatura) {
    return $this->redirectToRoute('admin_candidatura_index');
    }
    
    
    /**
     * Displays a form to edit an existing candidatura entity.
     *
     */
    public function editRealAction(Request $request, Candidatura $candidatura) {

       
        $criterios = $candidatura->getCategoria()->getCriterios();

        $deleteForm = $this->createDeleteForm($candidatura);
        $editForm = $this->createForm('AppBundle\Form\CandidaturaType', $candidatura);
        $editForm->handleRequest($request);



        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->get('session')->getFlashBag()->add(
                    'notice', 'Candidatura actualizada com sucesso!'
            );

            return $this->redirectToRoute('admin_candidatura_edit', array('id' => $candidatura->getId()));
        }

        return $this->render('candidatura/edit.html.twig', array(
                    'candidatura' => $candidatura,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
                    'criterios' => $criterios,
                    'categoria' => $candidatura->getCategoria()
        ));
    }

    /**
     * Deletes a candidatura entity.
     *
     */
    public function deleteAction(Request $request, Candidatura $candidatura) {
        $form = $this->createDeleteForm($candidatura);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($candidatura);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                    'notice', 'Candidatura eliminada com sucesso!'
            );
        }

        return $this->redirectToRoute('admin_candidatura_index');
    }

    /**
     * Creates a form to delete a candidatura entity.
     *
     * @param Candidatura $candidatura The candidatura entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Candidatura $candidatura) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('admin_candidatura_delete', array('id' => $candidatura->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

}
