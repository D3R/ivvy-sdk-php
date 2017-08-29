<?php
declare(strict_types=1);

namespace Fcds\Ivvy;

/**
 * Class: JobFactory
 *
 * @final
 */
final class JobFactory
{
    /**
     * Creates a job for the ping endpoint
     *
     * @return Job
     */
    public function newPingJob(): Job
    {
        return new Job('test', 'ping');
    }
}
