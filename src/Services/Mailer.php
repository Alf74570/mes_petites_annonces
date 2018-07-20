<?php

namespace App\Services;

use App\Entity\Person;
use Twig\Environment;


class Mailer
{
    private $mailer;
    private $twig;

    /**
     * Mailer constructor.
     * @param $mailer
     * @param $twig
     */
    public function __construct(\Swift_Mailer $mailer, Environment $twig)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
    }


    public function sendMessage($from, $to, $subject, $body, $attachement = null)
    {
        $message = (new \Swift_Message("Reset Password"))
            ->setFrom($from)
            ->setTo($to)
            ->setSubject($subject)
            ->setBody($body)
            ->setReplyTo($from)
            ->setContentType('text/html');

        $this->mailer->send($message);
    }

    public function createBodyMail($view, array $parameters)
    {
        return $this->twig->render($view, $parameters);
    }
}