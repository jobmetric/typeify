<?php

namespace JobMetric\Typeify\Exceptions;

use Exception;
use Throwable;

class TypeifyTypeNotFoundException extends Exception
{
    public function __construct(string $service, string $type, int $code = 400, ?Throwable $previous = null)
    {
        parent::__construct("Type [$type] is not available in service [$service].", $code, $previous);
    }
}
