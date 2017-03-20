<?php
namespace AppBundle\Repository;

use AppBundle\Entity\Comment;
use Doctrine\ORM\EntityRepository;
use FOS\UserBundle\Model\UserInterface;

/**
 * Class CommentRepository.
 *
 * @package AppBundle\Repository
 */
class CommentRepository extends EntityRepository
{
    /**
     * Return comment for user.
     *
     * @param array $users Users id.
     *
     * @return array Array data with keys: text, id, username, firstName, lastName, createAt.
     */
    public function getCommentByUser(array $users)
    {
        $builder = $this->getEntityManager()->getRepository('AppBundle:Comment')
            ->createQueryBuilder('c');

        return $builder
            ->select('c.text, u.id, u.username, u.firstName, u.lastName, c.createAt')
            ->join('AppBundle:User', 'u', 'WITH', 'c.user = u.id')
            ->where($builder->expr()->in('c.user', ':users'))
            ->setParameter('users', $users)
            ->orderBy('c.createAt', 'DESC')
            ->getQuery()
            ->getArrayResult();
    }

    /**
     * Create text comment.
     *
     * @param UserInterface $user        User.
     * @param string        $commentText Comment text.
     * @param mixed         $commentId   Comment identifier.
     *
     * @return bool|int Comment identifier if success, else false.
     */
    public function updateTextComment(UserInterface $user, $commentText, $commentId)
    {
        $em = $this->getEntityManager();
        $comment = null;

        if ($commentId) {
            $comment = $em->getRepository('AppBundle:Comment')->find((int) $commentId);
        }

        if (!$comment) {
            // Create comment if not exist
            $comment = new Comment();
            $comment->setUser($user);
            $comment->setCreateAt();
        }

        $comment->setText($commentText);

        try {
            $em->persist($comment);
            $em->flush($comment);
        } catch (\Exception $exception) {
            return false;
        }

        return $comment->getId();
    }

    /**
     * Create comment.
     *
     * @param Comment       $comment Comment.
     * @param UserInterface $user    User.
     *
     * @return int Comment identifier.
     */
    public function updateComment(Comment $comment, UserInterface $user)
    {
        $comment->setUser($user);
        $comment->setCreateAt();

        $em = $this->getEntityManager();
        $em->persist($comment);
        $em->flush();

        return $comment->getId();
    }
}
