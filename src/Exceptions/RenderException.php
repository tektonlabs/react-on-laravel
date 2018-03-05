<?php

namespace TektonLabs\ReactOnLaravel\Exceptions;

class RenderException extends \Exception
{
    public function __construct($componentName, $consoleReplay)
    {
        $message = 'Error rendering component '.$componentName."\nConsole log:".$consoleReplay;
        parent::__construct($message);
    }
}
