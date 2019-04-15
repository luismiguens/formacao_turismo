<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * User controller.
 *
 */
class UserController extends Controller {


    
    public function afterLoginAction(Request $request)
    {
         $user = $this->getUser();
         
         
          $this->get('session')->getFlashBag()->add(
                    'notice', 'Bem-vindo ao website da Hospitality Education Awards '.$user->getUsername(). '! Aproveita para te candidatares a uma das categorias dos prémios!'
            );
        
        
        return $this->redirectToRoute('admin_candidatura_index');
        
        
        
        
    }
    
    
}
