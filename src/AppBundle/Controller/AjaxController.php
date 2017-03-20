<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class AjaxController.
 *
 * @package AppBundle\Controller
 */
class AjaxController extends Controller
{
    /**
     * @Route("ajax/comment/add/", name="ajax_comment_add")
     *
     * Add or update comment.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function addComment(Request $request)
    {
        $commentText = $request->get('text');
        $commentId = $request->get('commentId');

        $updateCommentId = $this->getDoctrine()->getRepository('AppBundle:Comment')
            ->updateTextComment($this->getUser(), $commentText, $commentId);

        if ($commentId && $updateCommentId) {
            $keyMessage = 'Comment update';
        } elseif ($updateCommentId) {
            $keyMessage = 'Comment added';
        } else {
            $keyMessage = 'Error when comment add';
        }

        $translator = $this->get('translator');

        return new JsonResponse([
            'id'      => $updateCommentId,
            'message' => $translator->trans($keyMessage),
        ]);
    }
}
