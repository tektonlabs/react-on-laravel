<?php

namespace TektonLabs\ReactOnLaravel\Exceptions;

class RenderException extends \Exception
{
    public function __construct($message)
    {
        parent::__construct($message);
    }
}
