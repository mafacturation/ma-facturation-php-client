<?php

namespace Mafacturation\Exceptions;

use Exception;

class Unauthenticated extends Exception
{
    public function __construct($message = 'Your are not authenticated to perform this action on Mafacturation')
    {
        parent::__construct($message);
    }
}