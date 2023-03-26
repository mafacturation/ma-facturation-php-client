<?php

namespace Mafacturation\PhpClient\Exceptions;

use Exception;

class PerformingMaintenance extends Exception
{
    public function __construct($message = 'MaFacturation is performing maintenance. Please try again later.')
    {
        parent::__construct($message);
    }
}