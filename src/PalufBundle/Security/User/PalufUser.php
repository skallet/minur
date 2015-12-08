<?php

namespace PalufBundle\Security\User;

use Symfony\Component\Security\Core\User\EquatableInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Created by PhpStorm.
 * User: blaze
 * Date: 07.12.2015
 * Time: 21:28
 */
class PalufUser implements UserInterface, EquatableInterface
{

    /**
     * @var UserInterface
     */
    private $user;

    public function __construct(UserInterface $user)
    {

        $this->user = $user;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function isEqualTo(UserInterface $user)
    {
        if ($this->user->getPassword() !== $user->getPassword()) {
            return false;
        }

        if ($this->user->getSalt() !== $user->getSalt()) {
            return false;
        }

        if ($this->user->getUsername() !== $user->getUsername()) {
            return false;
        }

        return true;
    }

    public function getRoles()
    {
        return $this->user->getRoles();
    }

    public function getPassword()
    {
        return $this->user->getPassword();
    }

    public function getSalt()
    {
        return $this->user->getSalt();
    }

    public function getUsername()
    {
        return $this->user->getUsername();
    }

    public function eraseCredentials()
    {
    }

}