<?php
declare(strict_types=1);

namespace Fcds\Ivvy;

final class PingJob extends Job
{
    public function __construct()
    {
        parent::__construct('test', 'ping');
    }
}
