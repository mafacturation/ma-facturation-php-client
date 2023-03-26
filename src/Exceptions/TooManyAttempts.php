<?php

namespace Mafacturation\Exceptions;

use Exception;

class TooManyAttempts extends Exception
{
    public function __construct($message = 'Too Many Attempts to perform this action on Mafacturation.')
    {
        parent::__construct($message);
    }
}