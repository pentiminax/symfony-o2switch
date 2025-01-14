<?php

namespace App\Controller;

use App\Dto\SendEmailRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Mailer\Messenger\SendEmailMessage;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Attribute\Route;

class SendEmailController extends AbstractController
{
    #[Route('/send-email', name: 'send_email')]
    public function __invoke(MessageBusInterface $bus, #[MapRequestPayload] SendEmailRequest $request): Response
    {
        $email = (new Email())
            ->from('pentiminax@gmail.com')
            ->to($request->email)
            ->text($request->message);

        $bus->dispatch(new SendEmailMessage($email));

        return $this->redirectToRoute('home.index');
    }
}