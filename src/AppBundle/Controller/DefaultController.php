<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Contact;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\ContactType;
use Symfony\Component\HttpFoundation\Response;


class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        $projects = $this->getDoctrine()
            ->getRepository('AppBundle:Project')
            ->findBy(array('slug' => array('intu_digital','sportlobster', 'bbc_worldwide')), array('startDate'=>'DESC') )
        ;

        $skills = array();
//        $skills[] = array('title' => 'Coding', 'content' => 'PHP5 OO, MySQL, HTML5, CSS3, XML, JavaScript/jQuery, JSON, AJAX');
        $skills[] = array('title' => 'Frameworks', 'content' => 'Symfony2, Silex, Zend (BBC), CodeIgniter');
        $skills[] = array('title' => 'Services', 'content' => 'Elasticsearch, Apache Solr, Memcached, Varnish');
        $skills[] = array('title' => 'Test', 'content' => 'Behat, PHPUnit, phpspec');
        $skills[] = array('title' => 'Agile', 'content' => 'Scrum, Kanban');

        return $this->render('default/index.html.twig', array(
            'projects' => $projects,
            'skills' => $skills
        ));
    }

    /**
     * @Route("/page/{slug}", name="page")
     */
    public function pageAction($slug)
    {
        $page = $this->getDoctrine()
            ->getRepository('AppBundle:Page')
            ->findOneBy(array('slug' => $slug));

        return $this->render('default/page.html.twig', array('page' => $page));
    }

    /**
     * @Route("/projects/{slug}", defaults={"slug" = null}, name="projects")
     */
    public function projectsAction($slug = null)
    {
        if ($slug) {
            $project = $this->getDoctrine()
                ->getRepository('AppBundle:Project')
                ->findOneBy(array('slug' => $slug));

            return $this->render('default/project.html.twig', array(
                'project' => $project
            ));
        } else {
            $projects = $this->getDoctrine()
                ->getRepository('AppBundle:Project')
                ->findBy(array(), array('startDate'=>'DESC'))
            ;

            return $this->render('default/projects.html.twig', array(
                'projects' => $projects
            ));
        }
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

            $em = $this->getDoctrine()->getManager();
            $em->persist($contact);
            $em->flush();

            $this->sendMail($contact);

            return $this->redirect($this->generateUrl(
                'page', array('slug' => 'contact_thanks')
            ));
        }

        return $this->render('default/contact.html.twig', array(
            'form' => $form->createView(),
        ));
    }


    /**
     * @Route("/admin")
     */
    public function adminAction()
    {
        return new Response('Admin page!');
    }

    private function sendMail(Contact $contact)
    {
        $mailer = $this->get('mailer');
        $message = $mailer->createMessage()
            ->setSubject('GDS.com Contact Form message')
            ->setFrom('orders@brainboxweb.co.uk')
            ->setTo('gary@garystraughan.com')
            ->setBody(
                $this->renderView(
                    'email/contact.html.twig',
                    array('contact' => $contact)
                ),
                'text/html'
            )
        ;
        $mailer->send($message);
    }

}
