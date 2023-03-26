<?php

namespace Mafacturation\PhpClient\Exceptions;

use Exception;

class Unauthenticated extends Exception
{
    public function __construct($message = 'Your are not authenticated to perform this action on MaFacturation')
    {
        parent::__construct($message);
    }
}