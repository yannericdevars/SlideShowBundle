<?php

namespace DW\SlideShowBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


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
    


}
