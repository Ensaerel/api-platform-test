<?php

namespace AppBundle\EventSubscriber\User;

use ApiPlatform\Core\EventListener\EventPriorities;
use AppBundle\Entity\User\User;
use AppBundle\Mailer\User\UserMailer;
use AppBundle\Manager\User\UserManager;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * Class UserSubscriber
 * @package AppBundle\EventSubscriber\User
 *
 */
final class UserEventSubscriber implements EventSubscriberInterface
{
    /**
     * @var UserManager
     */
    private $userManager;

    /**
     * @var UserMailer
     */
    private $userMailer;

    /**
     * @param UserManager $userManager
     * @param UserMailer  $userMailer
     */
    public function __construct(UserManager $userManager, UserMailer $userMailer)
    {
        $this->userManager = $userManager;
        $this->userMailer = $userMailer;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => [
                ['encodePassword', EventPriorities::PRE_WRITE],
                ['sendActivationMail', EventPriorities::POST_WRITE],
            ],
        ];
    }

    /**
     * @param GetResponseForControllerResultEvent $event
     */
    public function encodePassword(GetResponseForControllerResultEvent $event)
    {
        /** @var User $user */
        $user = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        if (!$user instanceof User
            || !in_array($method, [Request::METHOD_POST, Request::METHOD_PATCH])
        ) {
            return;
        }

        $this->userManager->encodePassword($user);
    }

    /**
     * @param GetResponseForControllerResultEvent $event
     */
    public function sendActivationMail(GetResponseForControllerResultEvent $event)
    {
        /** @var User $user */
        $user = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        if (!$user instanceof User || Request::METHOD_POST !== $method) {
            return;
        }

        $this->userMailer->sendActivationMail($user);
    }
}