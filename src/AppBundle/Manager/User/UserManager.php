<?php

namespace AppBundle\Manager\User;

use AppBundle\Entity\User\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Component\Security\Core\Tests\Encoder\PasswordEncoder;

/**
 * Class UserManager
 * @package AppBundle\Manager\User
 */
class UserManager
{
    /**
     * @var UserPasswordEncoder
     */
    protected $userPasswordEncoder;

    /**
     * @param UserPasswordEncoder $userPasswordEncoder
     */
    public function __construct(UserPasswordEncoder $userPasswordEncoder)
    {
        $this->userPasswordEncoder = $userPasswordEncoder;
    }

    /**
     * @param User $user
     * @return void
     */
    public function encodePassword(User $user)
    {
        $encoded = $this->userPasswordEncoder
                        ->encodePassword(
                            $user,
                            $user->getPlainPassword()
                        );
        $user->setPassword($encoded);
    }
}
