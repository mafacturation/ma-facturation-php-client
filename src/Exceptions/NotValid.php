<?php

namespace Mafacturation\MaFacturationPhpClient\Exceptions;

use Exception;

class NotValid extends Exception
{
    public function __construct($message = 'The given data was invalid.')
    {
        parent::__construct($message);
    }
}