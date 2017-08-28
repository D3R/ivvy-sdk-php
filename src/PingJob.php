<?php
declare(strict_types=1);

namespace Fcds\Ivvy;

class PingJob extends Job
{
    public function __construct()
    {
        parent::__construct('test', 'ping');
    }
}
