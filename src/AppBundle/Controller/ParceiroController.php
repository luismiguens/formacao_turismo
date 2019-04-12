<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Parceiro;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Parceiro controller.
 *
 */
class ParceiroController extends Controller
{
    /**
     * Lists all parceiro entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $parceiros = $em->getRepository('AppBundle:Parceiro')->findAll();

        return $this->render('parceiro/index.html.twig', array(
            'parceiros' => $parceiros,
        ));
    }

    /**
     * Creates a new parceiro entity.
     *
     */
    public function newAction(Request $request)
    {
        $parceiro = new Parceiro();
        $form = $this->createForm('AppBundle\Form\ParceiroType', $parceiro);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($parceiro);
            $em->flush();
            
            
                $this->get('session')->getFlashBag()->add(
                    'notice', 'Parceiro criado com sucesso!'
            );

            return $this->redirectToRoute('admin_parceiro_edit', array('id' => $parceiro->getId()));
        }

        return $this->render('parceiro/new.html.twig', array(
            'parceiro' => $parceiro,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a parceiro entity.
     *
     */
    public function showAction(Parceiro $parceiro)
    {
        $deleteForm = $this->createDeleteForm($parceiro);

        return $this->render('parceiro/show.html.twig', array(
            'parceiro' => $parceiro,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing parceiro entity.
     *
     */
    public function editAction(Request $request, Parceiro $parceiro)
    {
        $deleteForm = $this->createDeleteForm($parceiro);
        $editForm = $this->createForm('AppBundle\Form\ParceiroType', $parceiro);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            
            
                $this->get('session')->getFlashBag()->add(
                    'notice', 'Parceiro actualizado com sucesso!'
            );

            return $this->redirectToRoute('admin_parceiro_edit', array('id' => $parceiro->getId()));
        }

        return $this->render('parceiro/edit.html.twig', array(
            'parceiro' => $parceiro,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a parceiro entity.
     *
     */
    public function deleteAction(Request $request, Parceiro $parceiro)
    {
        $form = $this->createDeleteForm($parceiro);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($parceiro);
            $em->flush();
            
            
               $this->get('session')->getFlashBag()->add(
                    'notice', 'Parceiro eliminado com sucesso!'
            );
            
        }

        return $this->redirectToRoute('admin_parceiro_index');
    }

    /**
     * Creates a form to delete a parceiro entity.
     *
     * @param Parceiro $parceiro The parceiro entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Parceiro $parceiro)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_parceiro_delete', array('id' => $parceiro->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
