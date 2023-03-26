<?php

namespace Mafacturation\Exceptions;

use Exception;

class InternalServerError extends Exception
{
    public function __construct($message = 'Internal Server Error on MaFacturation, please contact support.')
    {
        parent::__construct($message);
    }
}