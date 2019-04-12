<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Candidatura;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

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
    
    
        public function indexAction() {
               
        $user = $this->getUser();
        $candidaturas = $user->getCandidaturas();
        
        //$candidaturas = $em->getRepository('AppBundle:Candidatura')->findAll();

        return $this->render('candidatura/index.html.twig', array(
                    'candidaturas' => $candidaturas,
        ));
    }
    
    
    
    
    
    

    /**
     * Creates a new candidatura entity.
     *
     */
    public function newAction(Request $request, \AppBundle\Entity\Categoria $categoria) {
        $em = $this->getDoctrine()->getManager();
        $candidatura = new Candidatura();
        $candidatura->setCategoria($categoria);
        
        $criterios = $categoria->getCriterios();
       
            //$criterios = $em->getRepository('AppBundle:Criterio')->findBy(array('categoria' => $categoria->getId()));
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

 

            return $this->redirectToRoute('admin_candidatura_edit', array('id' => $candidatura->getId()));
        }

        return $this->render('candidatura/new.html.twig', array(
                    'candidatura' => $candidatura,
                    'form' => $form->createView(),
            'criterios' => $criterios
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

    /**
     * Displays a form to edit an existing candidatura entity.
     *
     */
    public function editAction(Request $request, Candidatura $candidatura) {
        
        //$respostas = $candidatura->getRespostas();
        
        //dump($respostas);
        
        
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
            'criterios' => $criterios
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
