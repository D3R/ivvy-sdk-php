<?php
declare(strict_types=1);

namespace Fcds\Ivvy;

/**
 * Class: Job
 *
 * An immutable class that represents a job to be run in a batch operation.
 */
class Job
{
    protected $namespace;

    protected $action;

    protected $params;

    public function __construct(string $namespace, string $action, array $params = [])
    {
        $this->namespace = $namespace;
        $this->action = $action;
        $this->params = $params;
    }

    public function toArray()
    {
        $namespace = $this->namespace;
        $action = $this->action;
        $params = $this->params;

        return compact('namespace', 'action', 'params');
    }
}
