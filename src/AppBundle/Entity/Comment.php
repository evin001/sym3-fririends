<?php
namespace AppBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * Class Comment.
 *
 * @ORM\Entity
 * @ORM\Table(name="comments")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CommentRepository")
 *
 * @package AppBundle\Entity
 */
class Comment
{
    /**
     * Comment identifier.
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * Text comment.
     *
     * @Assert\NotBlank()
     * @ORM\Column(type="text", name="text", length=65535, nullable=false)
     * @var string
     */
    private $text;

    /**
     * User.
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * @var User
     */
    private $user;

    /**
     * Date create.
     *
     * @ORM\Column(type="datetime", name="create_at", nullable=true)
     * @var \DateTime
     */
    private $createAt;

    /**
     * Comment constructor.
     */
    public function __construct()
    {
        $this->createAt = new DateTime();
    }

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
     * Return text comment.
     *
     * @return string Text comment.
     */
    public function getText()
    {
        return htmlspecialchars_decode($this->text);
    }

    /**
     * Set text comment.
     *
     * @param string $text Text comment.
     *
     * @return $this
     */
    public function setText($text)
    {
        $this->text = htmlspecialchars($text);

        return $this;
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
     * Return date create.
     *
     * @return mixed Date create.
     */
    public function getCreateAt()
    {
        return $this->createAt;
    }

    /**
     * Set date create.
     *
     * @param mixed $createAt Date create.
     *
     * @return $this
     */
    public function setCreateAt($createAt = null)
    {
        if (!$createAt) {
            $createAt = new \DateTime();
        }
        $this->createAt = $createAt;

        return $this;
    }
}
