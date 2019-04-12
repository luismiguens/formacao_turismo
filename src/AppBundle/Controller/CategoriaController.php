<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Categoria;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Categoria controller.
 *
 */
class CategoriaController extends Controller {

    /**
     * Lists all categoria entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $categorias = $em->getRepository('AppBundle:Categoria')->findAll();

        return $this->render('categoria/index.html.twig', array(
                    'categorias' => $categorias,
        ));
    }

    /**
     * Creates a new categoria entity.
     *
     */
    public function newAction(Request $request) {
        $categoria = new Categoria();
        $form = $this->createForm('AppBundle\Form\CategoriaType', $categoria);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($categoria);
            $em->flush();


            $this->get('session')->getFlashBag()->add(
                    'notice', 'Categoria criada com sucesso!'
            );

            return $this->redirectToRoute('admin_categoria_edit', array('id' => $categoria->getId()));
        }

        return $this->render('categoria/new.html.twig', array(
                    'categoria' => $categoria,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a categoria entity.
     *
     */
    public function showAction(Categoria $categoria) {
        $deleteForm = $this->createDeleteForm($categoria);

        return $this->render('categoria/show.html.twig', array(
                    'categoria' => $categoria,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing categoria entity.
     *
     */
    public function editAction(Request $request, Categoria $categoria) {
        $deleteForm = $this->createDeleteForm($categoria);
        $editForm = $this->createForm('AppBundle\Form\CategoriaType', $categoria);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->get('session')->getFlashBag()->add(
                    'notice', 'Categoria actualizada com sucesso!'
            );

            return $this->redirectToRoute('admin_categoria_edit', array('id' => $categoria->getId()));
        }

        return $this->render('categoria/edit.html.twig', array(
                    'categoria' => $categoria,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a categoria entity.
     *
     */
    public function deleteAction(Request $request, Categoria $categoria) {
        $form = $this->createDeleteForm($categoria);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($categoria);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                    'notice', 'Categoria eliminada com sucesso!'
            );
        }

        return $this->redirectToRoute('admin_categoria_index');
    }

    /**
     * Creates a form to delete a categoria entity.
     *
     * @param Categoria $categoria The categoria entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Categoria $categoria) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('admin_categoria_delete', array('id' => $categoria->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

}
