<?php
namespace War\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use War\BlogBundle\Entity\Comment;
use War\BlogBundle\Form\CommentType;
use Symfony\Component\HttpFoundation\Request;

/**
* Comment controller.
*/
class CommentController extends Controller
{
public function newAction($blog_id)
{
$blog = $this->getBlog($blog_id);

$comment = new Comment();
$comment->setBlog($blog);
$form = $this->createForm(CommentType::class, $comment);

return $this-> render('WarBlogBundle:Comment:form.html.twig', array(
'comment' => $comment,
'form' => $form->createView()
));
}

public function createAction(Request $request, $blog_id)
{
$blog = $this->getBlog($blog_id);

$comment = new Comment();
$comment->setBlog($blog);
$form = $this->createForm(CommentType::class, $comment);
$form->handleRequest($request);

if ($form->isValid()) {
$em = $this->getDoctrine()->getManager();
$em->persist($comment);
$em->flush();

return $this->redirect($this->generateUrl('WarBlogBundle_blog_show', array(
'id' => $comment->getBlog()->getId(),
'slug' => $comment->getBlog()->getSlug())) .
'#comment-' . $comment->getId());
}

return $this-> render('WarBlogBundle:Comment:create.html.twig', array(
'comment' => $comment,
'form' => $form->createView()
));
}

protected function getBlog($blog_id)
{
$em = $this->getDoctrine()
->getManager();

$blog = $em->getRepository('WarBlogBundle:Blog')->find($blog_id);

if (!$blog) {
throw $this->createNotFoundException('Unable to find Blog post.');
}

return $blog;
}

}


