<?php

namespace App\Queue;

class Dispatcher
{
    public function __construct(
        protected Queue $queue
    )
    {
    }

    public function dispatch(Job $job): void
    {
        $this->queue->enqueue($job);
    }

    public function dispatchSync(Job $job): void
    {
        \App::call([$job, 'handle']);
    }
}
