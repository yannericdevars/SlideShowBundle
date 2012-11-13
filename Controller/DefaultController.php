<?php

namespace DW\SlideShowBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use DW\UserBundle\Entity\User;
use Symfony\Component\HttpFoundation\Session\Session;

class DefaultController extends Controller
{
    public function boutiqueAction($ref)
    {
        
        $item = null;
        $images = null;
        
        $item = $this->getDoctrine()->getRepository('DWSlideShowBundle:Item')->findOneBy(array ('ref' => $ref));
        
        if (is_object($item))
          $images = $this->getDoctrine()->getRepository('DWSlideShowBundle:Image')->findBy(array ('item' => $item->getId()));
        
        
        return $this->render('DWSlideShowBundle:Default:index.html.twig', array('images' => $images, 'element' => $item));
    }
    
    public function loginAction(\Symfony\Component\HttpFoundation\Request $request)
    {
        
           $user = new User();
        
            $form = $this->createFormBuilder($user)
                    ->add('username', 'text')
                    ->add('password', 'text')
                    ->getForm();
           
        
        if ($request->isMethod('POST')) 
        {
            
            $form->bind($request);
            
            $user = $form->getData();
            
            $encoded_password = sha1($user->getPassword());
            
            $user_log = $this->getDoctrine()->getRepository('DWUserBundle:User')->findOneBy(array ('username' => $user->getUsername(), 'encrypted_password' => $encoded_password));
            
            $is_admin = false;
            
            if (is_object($user_log))
            {
                foreach ($user_log->getRoles() as $role)
                {
                    if ($role->getName() == 'ADMIN')
                        $is_admin = true;
                }
            }
           
            
            if (is_object($user_log) && $is_admin)
            {
                if (is_null($this->getRequest()->getSession()->get('userAutentif')) && $is_admin)
                {
                    $this->getRequest()->getSession()->set('userAutentif', true);
                }   
                else if ($this->getRequest()->getSession()->get('userAutentif') === false && $is_admin)
                {
                    $this->getRequest()->getSession()->set('userAutentif', true);
                }
                    
                
            }
            else 
            {
               $this->getRequest()->getSession()->set('userAutentif', false);
            }
        }
        
         return $this->render('DWSlideShowBundle:Default:login.html.twig', array(
                'form' => $form->createView(),
            ));     
    }   

}
