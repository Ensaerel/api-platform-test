<?php

namespace AppBundle\Mailer\User;

use AppBundle\Entity\User\User;
use AppBundle\Mailer\BaseMailer;

/**
 * Class UserMailer
 * @package AppBundle\Mailer\User
 */
class UserMailer extends BaseMailer
{
    public function sendActivationMail(User $user)
    {
        $message = $this->createMessage(
            'Activate you account',
            'mail/user/user/account_activation.html.twig',
            ['user' => $user]
        );
        $message->setTo($user->getEmail());
        
        return $this->mailer->send($message);
    }
}
