<?php
declare(strict_types=1);

namespace Fcds\Ivvy\Model;

use Exception;

class BusinessRuleException extends Exception
{
    public function __construct(string $message)
    {
        parent::__construct($message);
    }
}
