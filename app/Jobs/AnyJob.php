<?php

namespace App\Jobs;

use App\Models\Podcast;
use App\Services\AudioProcessor;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class AnyJob implements ShouldQueue, ShouldBeUnique
{
    use Queueable;

    /**
     * Создать новый экземпляр задания.
     */
    public function __construct(
    ) {}

    /**
     * Выполнить задание.
     */
    public function handle(): void
    {
        // Обработка загруженного подкаста ...
    }
}
