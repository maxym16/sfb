<?php
// src/War/BlogBundle/Controller/PageController.php

namespace War\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use War\BlogBundle\Entity\Enquiry;
use War\BlogBundle\Form\EnquiryType;

class PageController extends Controller
{
    public function indexAction()
    {
    $em = $this->getDoctrine()
    ->getManager();
    $blogs = $em->getRepository('WarBlogBundle:Blog')
    ->getLatestBlogs();
    return $this-> render('WarBlogBundle:Page:index.html.twig', array(
    'blogs' => $blogs));
    }
    public function aboutAction()
    {
    return $this-> render('WarBlogBundle:Page:about.html.twig');
    }
    public function contactAction(Request $request)
    {
    $enquiry = new Enquiry();
    $form = $this->createForm(EnquiryType::class, $enquiry);

    if ($request->getMethod()=='POST') {
//    $form->submit($request);
    $form->handleRequest($request);//Symfony3
//    $form->submit($request->request->all());
    if ($form->isValid()) {
    $message = \Swift_Message::newInstance()
    ->setSubject('Contact enquiry from Warblog')
    ->setFrom('enquiries@warblog.co.ua')
//    ->setTo('goolyamaxym@gmail.com')
    ->setTo($this->container->getParameter('war_blog.emails.contact_email'))
    ->setBody($this->renderView('WarBlogBundle:Page:contactEmail.txt.twig', array('enquiry'=>$enquiry)));
    $this-> get('mailer')->send($message);
    $this-> get('session')->getFlashBag()->add('war-notice', 'Your contact enquiry was successfully sent. Ваш контактний запит було успішно відправлено. Thank you!');
    // Redirect - This is important to prevent users re-posting
    // the form if they refresh the page
    return $this->redirect($this->generateUrl('WarBlogBundle_contact'));
    }
    //if ($form->isValid()) {
    // Perform some action, such as sending an email
    // Redirect - This is important to prevent users re-posting
    // the form if they refresh the page
    //return $this->redirect($this->generateUrl('WarBlogBundle_contact'));
    //}
    }
    return $this-> render('WarBlogBundle:Page:contact.html.twig', array(
    'form' => $form->createView() ));        
    }
    
    public function sidebarAction()
    {
    $em = $this->getDoctrine()
    ->getManager();

    $tags = $em->getRepository('WarBlogBundle:Blog')
    ->getTags();

    $tagWeights = $em->getRepository('WarBlogBundle:Blog')
    ->getTagWeights($tags);

    $commentLimit = $this->container
    ->getParameter('war_blog.comments.latest_comment_limit');
    $latestComments = $em->getRepository('WarBlogBundle:Comment')
    ->getLatestComments($commentLimit);

    return $this-> render('WarBlogBundle:Page:sidebar.html.twig', array(
    'latestComments' => $latestComments,
    'tags' => $tagWeights));
    }
}

