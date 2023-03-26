<?php

namespace Mafacturation\MaFacturationPhpClient\Exceptions;

use Exception;

class TooManyAttempts extends Exception
{
    public function __construct($message = 'Too Many Attempts to perform this action on MaFacturation.')
    {
        parent::__construct($message);
    }
}