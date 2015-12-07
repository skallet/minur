<?php
/**
 * Created by PhpStorm.
 * User: blaze
 * Date: 07.12.2015
 * Time: 21:31
 */

namespace PalufBundle\Security\User;


use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class PalufUserProvider implements UserProviderInterface
{

    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * PalufUserProvider constructor.
     * @param EntityManager $entityManager
     */
    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function loadUserByUsername($username)
    {
        $user = $this
            ->entityManager
            ->getRepository('PalufBundle:Team')
            ->findOneBy(['email' => $username]);

        if ($user) {
            return new PalufUser($user);
        }

        $user = $this
            ->entityManager
            ->getRepository('PalufBundle:Admin')
            ->findOneBy(['email' => $username]);

        if ($user) {
            return new PalufUser($user);
        }

        throw new UsernameNotFoundException(
            sprintf('Username "%s" does not exist.', $username)
        );
    }

    public function refreshUser(UserInterface $user)
    {
        if (!$user instanceof PalufUser) {
            throw new UnsupportedUserException(
                sprintf('Instances of "%s" are not supported.', get_class($user))
            );
        }

        return $this->loadUserByUsername($user->getUsername());
    }

    public function supportsClass($class)
    {
        return $class === 'PalufBundle\Security\User\PalufUser';
    }

}