<?php

namespace TektonLabs\ReactOnLaravel\Exceptions;

class RenderException extends \Exception
{
    public function __construct($componentName, $html)
    {
        $message = 'Error rendering component '.$componentName."\n".$html;
        parent::__construct($message);
    }
}
