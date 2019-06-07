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

    
    
    
    public function newAction(Request $request, \AppBundle\Entity\Categoria $categoria) {
    return $this->redirectToRoute('admin_candidatura_index');
    }
    
    
    /**
     * Creates a new candidatura entity.
     *
     */
    public function newRealAction(Request $request, \AppBundle\Entity\Categoria $categoria) {
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


            $body = "<p>Olá " . $candidatura->getPromotorNome() . ", recebemos a sua candidatura com sucesso. Obrigado por nos ajudar a valorizar o seu trabalho.</p>
         <p>Vamos agora avaliar se a sua candidatura cumpre todos os requisitos do regulamento e iremos notificá-lo/a caso seja necessário fazer alguma correção.</p>
         <p>Caso a sua candidatura cumpra todos os requisitos necessários, entraremos em contato assim que forem selecionados os três finalistas da sua categoria a partir do dia 20 de Junho.</p>
         <p>Fique atento e boa sorte!</p>";

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
