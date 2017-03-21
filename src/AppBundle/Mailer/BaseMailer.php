<?php

namespace AppBundle\Mailer;

abstract class BaseMailer
{
    /**
     * @var \Swift_Mailer
     */
    protected $mailer;

    /**
     * @var \Twig_Environment
     */
    protected $twig;

    public function __construct(\Swift_Mailer $mailer, \Twig_Environment $twig)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
    }

    /**
     * @param $subject
     * @param $template
     * @param array $templateData
     * @return \Swift_Message
     */
    protected function createMessage($subject, $template, array $templateData = [])
    {
        $message = \Swift_Message::newInstance(
            $subject,
            $this->twig->render($template, $templateData),
            'text/html'
        );
        $message->setFrom('noreply@api-platform-test.fr', 'API platform test');

        return $message;
    }
}