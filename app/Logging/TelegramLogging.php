<?php

namespace App\Logging;

use Monolog\Logger;
class TelegramLogging
{
    public function __invoke(array $config): Logger
    {
        return (new Logger('telegram'))
            ->pushHandler(new TelegramHandler($config));
    }
}
