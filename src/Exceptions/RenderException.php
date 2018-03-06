<?php

namespace TektonLabs\ReactOnLaravel\Exceptions;

class RenderException extends \Exception
{
    public function __construct($componentName, $html)
    {
        $message = 'Error rendering component '.$componentName."\n".html_entity_decode($html, ENT_QUOTES);
        parent::__construct($message);
    }
}
