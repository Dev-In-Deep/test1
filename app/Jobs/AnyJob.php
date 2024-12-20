<?php

namespace App\Jobs;

use App\Models\Guest;
use App\Models\Podcast;
use App\Queue\Job;
use App\Queue\Queue;
use App\Services\AudioProcessor;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class AnyJob implements ShouldQueue, Job
{
    use Queueable;

    /**
     * Создать новый экземпляр задания.
     */
    public function __construct(
        protected $type = 'registered',
        protected Guest $guest,
        protected string $message,
    ) {}



    /**
     * Выполнить задание.
     */
    public function handle(): void
    {
        dump($this->guest);
        dump($this->message);
    }
}
