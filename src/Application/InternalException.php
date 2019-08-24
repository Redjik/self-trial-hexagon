<?php

namespace AwesomeApplication\Application;

use Exception;
use Throwable;

class InternalException extends Exception
{
    public function __construct(Throwable $previous = null)
    {
        parent::__construct('Internal exception', 0, $previous);
    }
}
