<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Criterio;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Criterio controller.
 *
 */
class CriterioController extends Controller
{
    /**
     * Lists all criterio entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $criterios = $em->getRepository('AppBundle:Criterio')->findAll();

        return $this->render('criterio/index.html.twig', array(
            'criterios' => $criterios,
        ));
    }

    /**
     * Creates a new criterio entity.
     *
     */
    public function newAction(Request $request)
    {
        $criterio = new Criterio();
        $form = $this->createForm('AppBundle\Form\CriterioType', $criterio);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($criterio);
            $em->flush();
            
                $this->get('session')->getFlashBag()->add(
                    'notice', 'Critério criado com sucesso!'
            );

            return $this->redirectToRoute('admin_criterio_edit', array('id' => $criterio->getId()));
        }

        return $this->render('criterio/new.html.twig', array(
            'criterio' => $criterio,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a criterio entity.
     *
     */
    public function showAction(Criterio $criterio)
    {
        $deleteForm = $this->createDeleteForm($criterio);

        return $this->render('criterio/show.html.twig', array(
            'criterio' => $criterio,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing criterio entity.
     *
     */
    public function editAction(Request $request, Criterio $criterio)
    {
        $deleteForm = $this->createDeleteForm($criterio);
        $editForm = $this->createForm('AppBundle\Form\CriterioType', $criterio);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

               $this->get('session')->getFlashBag()->add(
                    'notice', 'Critério actualizado com sucesso!'
            );
            
            return $this->redirectToRoute('admin_criterio_edit', array('id' => $criterio->getId()));
        }

        return $this->render('criterio/edit.html.twig', array(
            'criterio' => $criterio,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a criterio entity.
     *
     */
    public function deleteAction(Request $request, Criterio $criterio)
    {
        $form = $this->createDeleteForm($criterio);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($criterio);
            $em->flush();
            
               $this->get('session')->getFlashBag()->add(
                    'notice', 'Critério eliminado com sucesso!'
            );
            
        }

        return $this->redirectToRoute('admin_criterio_index');
    }

    /**
     * Creates a form to delete a criterio entity.
     *
     * @param Criterio $criterio The criterio entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Criterio $criterio)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_criterio_delete', array('id' => $criterio->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
