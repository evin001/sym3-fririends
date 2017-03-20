<?php
namespace AppBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class User.
 *
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 *
 * @package AppBundle\Entity
 */
class User extends BaseUser
{
    /**
     * User identifier.
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * User first name.
     *
     * @ORM\Column(type="string", name="first_name", length=50, nullable=true)
     * @Assert\Length(
     *     min=3,
     *     max=255,
     *     minMessage="The first name is too short",
     *     maxMessage="The first name is too long",
     *     groups={"Profile"}
     * )
     * @var string
     */
    protected $firstName;

    /**
     * User last name.
     *
     * @ORM\Column(type="string", name="last_name", length=100, nullable=true)
     * @Assert\Length(
     *     min=3,
     *     max=255,
     *     minMessage="The last name is too short",
     *     maxMessage="The last name is too long",
     *     groups={"Profile"}
     * )
     * @var string
     */
    protected $lastName;

    /**
     * Facebook user identifier.
     *
     * @ORM\Column(name="facebook_id", type="string", length=255, nullable=true)
     * @var string
     */
    protected $facebookId;

    /**
     * Vkontakte user identifier.
     *
     * @ORM\Column(name="vkontakte_id", type="string", length=255, nullable=true)
     * @var string
     */
    protected $vkontakteId;

    /**
     * Return user identifier.
     *
     * @return int User identifier.
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Return user first name.
     *
     * @return string User first name.
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set user first name.
     *
     * @param string $firstName User first name.
     *
     * @return $this
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Return user last name.
     *
     * @return string User last name.
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set user last name.
     *
     * @param string $lastName User last name.
     *
     * @return $this
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Return facebook user identifier.
     *
     * @return string Facebook user identifier.
     */
    public function getFacebookId()
    {
        return $this->facebookId;
    }

    /**
     * Set facebook user identifier.
     *
     * @param string $facebookId Facebook user identifier.
     *
     * @return $this
     */
    public function setFacebookId($facebookId)
    {
        $this->facebookId = $facebookId;

        return $this;
    }

    /**
     * Return vkontakte user identifier.
     *
     * @return string Vkontakte user identifier.
     */
    public function getVkontakteId()
    {
        return $this->vkontakteId;
    }

    /**
     * Set vkontakte user identifier.
     *
     * @param string $vkontakteId Vkontakte user identifier.
     *
     * @return $this
     */
    public function setVkontakteId($vkontakteId)
    {
        $this->vkontakteId = $vkontakteId;

        return $this;
    }
}
