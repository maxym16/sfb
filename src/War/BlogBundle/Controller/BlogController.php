<?php

namespace War\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
* Blog controller.
*/
class BlogController extends Controller
{
/**
* Show a blog entry
*/
public function showAction($id, $slug, $comments)
{
$em = $this->getDoctrine()->getManager();
$blog = $em->getRepository('WarBlogBundle:Blog')->find($id);//шукаємо об'єкт в таблиці blog
if (!$blog) {throw $this->createNotFoundException('Unable to find Blog post.');}
$comments = $em->getRepository('WarBlogBundle:Comment')
->getCommentsForBlog($blog->getId());
return $this-> render('WarBlogBundle:Blog:show.html.twig',array('blog' => $blog,
'comments' => $comments));
}
}
