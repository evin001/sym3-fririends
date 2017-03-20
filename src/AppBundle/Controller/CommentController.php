<?php
namespace AppBundle\Controller;

use AppBundle\Entity\Comment;
use AppBundle\Form\CommentType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * Class CommentController.
 *
 * @package AppBundle\Controller
 */
class CommentController extends Controller
{
    /**
     * @Route("comment/add/", name="comment_add")
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        if (false === $this->get('security.authorization_checker')
                ->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw new AccessDeniedException();
        }

        $form = $this->createForm(CommentType::class);

        $form->handleRequest($request);

        // Save comment
        if ($form->isSubmitted() && $form->isValid()) {
            /* @var Comment $comment*/
            $comment = $form->getData();

            $commentId = $this->getDoctrine()->getManager()->getRepository('AppBundle:Comment')
                ->updateComment($comment, $this->getUser());

            if ($commentId) {
                $this->addFlash('success', 'Comment add');
            }
        }

        return $this->render('@App/comment/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
