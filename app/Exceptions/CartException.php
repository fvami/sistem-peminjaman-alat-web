<?php

namespace App\Exceptions;

class CartException extends \Exception
{
    public array $context;

    public function __construct(string $message, array $context = [])
    {
        parent::__construct($message);
        $this->context = $context;
    }
}
