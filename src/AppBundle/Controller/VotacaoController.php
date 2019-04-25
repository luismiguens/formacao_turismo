<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Votacao;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Votacao controller.
 *
 */
class VotacaoController extends Controller {

    /**
     * Lists all votacao entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $user = $this->getUser();
        
//VOTACOES JÁ EXISTENTES
//$votacaos = $em->getRepository('AppBundle:Votacao')->findAll();
        $votacoes = $user->getVotacoes();
        
        //CANDIDATURAS SEM VOTACAO
        
        $candidaturas = $em->getRepository('AppBundle:Candidatura')->findAll();
        
        
        dump(count($votacoes));
        dump(count($candidaturas));
        
        
        //dump($candidaturas);

        return $this->render('votacao/index.html.twig', array(
            'votacoes' => $votacoes,
                    'candidaturas' => $candidaturas,
        ));
    }

    /**
     * Creates a new votacao entity.
     *
     */
    public function newAction(Request $request, \AppBundle\Entity\Candidatura $candidatura) {
        
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        
        
        $votacao = new Votacao();
        $votacao->setCandidatura($candidatura);
        $votacao->setFosUser($user);

        $respostas = $candidatura->getRespostas();

        foreach ($respostas as $key => $resposta) {
            $voto = new \AppBundle\Entity\Voto();
            $voto->setResposta($resposta);
            $votacao->getVotos()->add($voto);
        }

        $form = $this->createForm('AppBundle\Form\VotacaoType', $votacao);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            
            foreach ($votacao->getVotos() as $voto) {
                $voto->setVotacao($votacao);
                $em->persist($votacao);
            }
            
            
            $em->flush();
            
              $this->get('session')->getFlashBag()->add(
                    'notice', 'Votação criada com sucesso!'
            );

            return $this->redirectToRoute('admin_votacao_edit', array('id' => $votacao->getId()));
        }

        return $this->render('votacao/new.html.twig', array(
                    'votacao' => $votacao,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a votacao entity.
     *
     */
    public function showAction(Votacao $votacao) {
        $deleteForm = $this->createDeleteForm($votacao);

        return $this->render('votacao/show.html.twig', array(
                    'votacao' => $votacao,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing votacao entity.
     *
     */
    public function editAction(Request $request, Votacao $votacao) {
        $deleteForm = $this->createDeleteForm($votacao);
        $editForm = $this->createForm('AppBundle\Form\VotacaoType', $votacao);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            
            $this->get('session')->getFlashBag()->add(
                    'notice', 'Votação actualizada com sucesso!'
            );

            return $this->redirectToRoute('admin_votacao_edit', array('id' => $votacao->getId()));
        }

        return $this->render('votacao/edit.html.twig', array(
                    'votacao' => $votacao,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a votacao entity.
     *
     */
    public function deleteAction(Request $request, Votacao $votacao) {
        $form = $this->createDeleteForm($votacao);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($votacao);
            $em->flush();
        }

        return $this->redirectToRoute('admin_votacao_index');
    }

    /**
     * Creates a form to delete a votacao entity.
     *
     * @param Votacao $votacao The votacao entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Votacao $votacao) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('admin_votacao_delete', array('id' => $votacao->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

}
