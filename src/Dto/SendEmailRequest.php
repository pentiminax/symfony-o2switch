<?php

namespace App\Dto;

class SendEmailRequest
{
    public function __construct(
        public string $email,
        public string $message
    ) {}
}