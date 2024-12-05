<?php

declare(strict_types=1);

namespace App\Service;

use Psr\Log\LoggerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;

class MailService
{
    public function __construct(private readonly MailerInterface $mailer, private readonly LoggerInterface $logger)
    {
    }

    public function sendMail(
        string $toEmail,
        string $subject,
        string $htmlTemplate,
    ): bool {
        try {
            $email = (new TemplatedEmail())
                ->to($toEmail)
                ->subject($subject)
                ->htmlTemplate($htmlTemplate);

            $this->mailer->send($email);

            return true;
        } catch (TransportExceptionInterface $exception) {
            $this->logger->error($exception->getMessage());

            return false;
        }
    }
}
