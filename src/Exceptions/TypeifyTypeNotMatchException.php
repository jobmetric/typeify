<?php

namespace JobMetric\Typeify\Exceptions;

use Exception;
use Throwable;

class TypeifyTypeNotMatchException extends Exception
{
    public function __construct(string $service, string $type, int $code = 400, ?Throwable $previous = null)
    {
        parent::__construct("Type [$type] is not match in service [$service].", $code, $previous);
    }
}
