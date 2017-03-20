<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Friend.
 *
 * @ORM\Entity
 * @ORM\Table(name="friend")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FriendRepository")
 *
 * @package AppBundle\Entity
 */
class Friend
{
    /**
     * Friend identifier.
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * User.
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * @var User
     */
    private $user;

    /**
     * User friend.
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(name="friend_id", referencedColumnName="id")
     * @var User
     */
    private $friend;

    /**
     * Return friend identifier.
     *
     * @return int Friend identifier.
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Return user.
     *
     * @return User User.
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set user.
     *
     * @param User $user User.
     *
     * @return $this
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Set user friend.
     *
     * @return User User friend.
     */
    public function getFriend()
    {
        return $this->friend;
    }

    /**
     * Return user friend.
     *
     * @param User $friend User friend.
     *
     * @return $this
     */
    public function setFriend($friend)
    {
        $this->friend = $friend;

        return $this;
    }
}
