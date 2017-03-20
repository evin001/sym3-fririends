<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * Class UserController.
 *
 * @package AppBundle\Controller
 */
class UserController extends Controller
{
    /**
     * @Route("/", name="homepage")
     *
     * Homepage.
     *
     * @return Response
     */
    public function indexAction()
    {
        if (false === $this->get('security.authorization_checker')
                ->isGranted('IS_AUTHENTICATED_FULLY')) {
            return $this->render('@App/user/empty.html.twig');
        }

        $doctrine = $this->getDoctrine();
        $user = $this->getUser();

        $userFriend = $doctrine->getRepository('AppBundle:Friend')
            ->getFriendsId($user);
        $friends = $doctrine->getRepository('AppBundle:User')->getFriends($userFriend);

        $userFriend[] = $user->getId();
        $comments = $doctrine->getRepository('AppBundle:Comment')
            ->getCommentByUser($userFriend);

        return $this->render('@App/user/index.html.twig', [
            'friends'  => $friends,
            'comments' => $comments,
        ]);
    }

    /**
     * @Route("friend/add/{id}", name="user_add_friend")
     *
     * Add user friend.
     *
     * @param int $id User identifier.
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function addFriendAction($id)
    {
        if (false === $this->get('security.authorization_checker')
                ->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw new AccessDeniedException();
        }

        $userId = $this->getUser()->getId();
        $userFriend = $this->getDoctrine()->getRepository('AppBundle:Friend')
            ->getFriendsId($this->getUser());

        if (!in_array($id, $userFriend) && $userId != $id) {
            if ($this->getDoctrine()->getRepository('AppBundle:Friend')
                ->addFriend($this->getUser(), $id)) {
                $this->addFlash('success', 'Friend added');
            }
        } else {
            $this->addFlash('danger', 'User already your friend');
        }

        return $this->redirectToRoute('user_list');
    }

    /**
     * @Route("user/list/", name="user_list")
     *
     * List of users who are not friends.
     *
     * @return Response
     */
    public function listAction()
    {
        if (false === $this->get('security.authorization_checker')
                ->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw new AccessDeniedException();
        }

        $user = $this->getUser();

        $userList = $this->getDoctrine()->getRepository('AppBundle:User')
            ->findAllToArray($user);
        $userFriend = $this->getDoctrine()->getRepository('AppBundle:Friend')
            ->getFriendsId($user);

        return $this->render("@App/user/list.html.twig", [
            'userList'   => $userList,
            'userFriend' => $userFriend,
        ]);
    }
}
