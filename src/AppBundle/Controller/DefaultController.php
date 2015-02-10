<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        $projects = $this->getDoctrine()
            ->getRepository('AppBundle:Project')
            ->findBy(array(), array('publishedAt'=>'ASC'), 5)
        ;

        return $this->render('default/index.html.twig', array(
            'projects' => $projects
        ));
    }
}
