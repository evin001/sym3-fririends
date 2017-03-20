<?php
namespace AppBundle\Repository;

use AppBundle\Entity\Friend;
use Doctrine\ORM\EntityRepository;
use FOS\UserBundle\Model\UserInterface;

/**
 * Class FriendRepository.
 *
 * @package AppBundle\Repository
 */
class FriendRepository extends EntityRepository
{
    /**
     * Return friends is for user.
     *
     * @param UserInterface $user User.
     *
     * @return array Array with friends id.
     */
    public function getFriendsId(UserInterface $user)
    {
        $result = $this->getEntityManager()->getRepository('AppBundle:Friend')
            ->createQueryBuilder('f')
            ->select('IDENTITY(f.user) AS user, IDENTITY(f.friend) AS friend')
            ->where('f.friend = :user Or f.user = :user')
            ->setParameter('user', $user)
            ->getQuery()
            ->getArrayResult();

        $friends = [];
        $userId = $user->getId();

        if ($result) {
            foreach ($result as $item) {
                $friends[] = ($item['friend'] != $userId) ? $item['friend'] : $item['user'];
            }
        }

        return $friends;
    }

    /**
     * Add new user friend.
     *
     * @param UserInterface $user   User.
     * @param mixed         $friend Friend identifier.
     *
     * @return bool True if success, else false.
     */
    public function addFriend(UserInterface $user, $friend)
    {
        $this->updateFriend($friend);

        try {
            $newFriend = new Friend();
            $newFriend->setUser($user);
            $newFriend->setFriend($friend);

            $em = $this->getEntityManager();
            $em->persist($newFriend);
            $em->flush();
        } catch (\Exception $exception) {
            return false;
        }

        return true;
    }

    /**
     * Set friend object.
     *
     * @param mixed $friend Friend.
     */
    private function updateFriend(&$friend)
    {
        if (is_numeric($friend)) {
            $friend = $this->getEntityManager()->getRepository('AppBundle:User')->find($friend);
        }
    }
}
