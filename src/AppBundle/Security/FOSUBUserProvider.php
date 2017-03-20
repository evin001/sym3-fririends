<?php
namespace AppBundle\Security;

use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;
use HWI\Bundle\OAuthBundle\Security\Core\User\FOSUBUserProvider as BaseClass;
use HWI\Bundle\OAuthBundle\Security\Core\Exception\AccountNotLinkedException;

/**
 * Class FOSUBUserProvider.
 *
 * @package AppBundle\Security
 */
class FOSUBUserProvider extends BaseClass
{
    /**
     * Load user from social network.
     *
     * @param UserResponseInterface $response
     *
     * @return \FOS\UserBundle\Model\UserInterface
     */
    public function loadUserByOAuthUserResponse(UserResponseInterface $response)
    {
        $username = $response->getUsername();
        $socialId = $this->getProperty($response);

        $setSocialMethod = 'set'.ucfirst($socialId);
        $getSocialMethod = 'get'.ucfirst($socialId);

        $user = $this->userManager->findUserBy([$socialId => $username]);

        if (null === $user || null === $username) {
            // Find user by E-mail
            if (!$response->getEmail()) {
                throw new AccountNotLinkedException(sprintf("User '%s' not found.", $username));
            }

            $user = $this->userManager->findUserByEmail($response->getEmail());
        }

        if ($user && !$user->$getSocialMethod()) {
            // Set social id for already registered user
            $user->$setSocialMethod($username);
            $this->userManager->updateUser($user);
        }

        if (null === $user) {
            // Create new user
            $user = $this->userManager->createUser();

            $user->setUsername(uniqid());
            $user->setEmail($response->getEmail());
            $user->setPlainPassword($this->generatePassword());
            $user->setEnabled(true);
            $user->$setSocialMethod($username);

            if ($response->getFirstName()) {
                $user->setFirstName($response->getFirstName());
            }
            if ($response->getLastName()) {
                $user->setLastName($response->getLastName());
            }

            $this->userManager->updateUser($user);
        }

        return $user;
    }

    /**
     * Generate password.
     *
     * @param int $length Password length.
     *
     * @return string Password.
     */
    protected function generatePassword($length = 8)
    {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $count = mb_strlen($chars);

        for ($i = 0, $result = ''; $i < $length; $i++) {
            $index = rand(0, $count - 1);
            $result .= mb_substr($chars, $index, 1);
        }

        return $result;
    }
}
