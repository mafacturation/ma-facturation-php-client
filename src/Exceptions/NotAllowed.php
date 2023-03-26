<?php

namespace Mafacturation\Exceptions;

use Exception;

class NotAllowed extends Exception
{
    public function __construct($message = 'You are not allowed to perform this action on MaFacturation')
    {
        parent::__construct($message);
    }
}