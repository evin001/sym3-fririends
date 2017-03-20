<?php
namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use FOS\UserBundle\Model\UserInterface;

/**
 * Class UserRepository.
 *
 * @package AppBundle\Repository
 */
class UserRepository extends EntityRepository
{
    /**
     * Return user friends.
     *
     * @param array $friends Array friends id.
     *
     * @return array Data array with keys: id, username, email, firstName, lastName.
     */
    public function getFriends(array $friends)
    {
        if (!$friends) {
            return [];
        }

        $builder = $this->getEntityManager()->getRepository('AppBundle:User')
            ->createQueryBuilder('u');

        return $builder
            ->select('u.id, u.username, u.email, u.firstName, u.lastName')
            ->where(
                $builder->expr()->in('u.id', $friends)
            )
            ->getQuery()
            ->getArrayResult();
    }
    /**
     * Return all user.
     *
     * @param UserInterface $user User.
     *
     * @return array Data array with keys: id, username, firstName, lastName.
     */
    public function findAllToArray(UserInterface $user)
    {
        return $this->getEntityManager()->getRepository('AppBundle:User')
            ->createQueryBuilder('u')
            ->select('u.id, u.username, u.firstName, u.lastName')
            ->where('u.id <> :user')
            ->setParameter('user', $user)
            ->getQuery()
            ->getArrayResult();
    }
}
