<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Contact;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\ContactType;
//use Symfony\Component\BrowserKit\Request;


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

    /**
     * @Route("/contact", name="contact")
     */
    public function contactAction(Request $request)
    {
        $contact = new Contact();

        $form = $this->createForm(new ContactType(), $contact);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            echo 'Submitted!';
            $em = $this->getDoctrine()->getManager();
            $em->persist($contact);
            $em->flush();

//            return $this->redirect($this->generateUrl(
//                'admin_post_show',
//                array('id' => $post->getId())
//            ));
        }

        return $this->render('default/contact.html.twig', array(
            'form' => $form->createView(),
        ));

    }









}
