<?php

namespace App\Logging;

use Illuminate\Support\Facades\Http;
use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Handler\HandlerInterface;
use Monolog\Level;
use Monolog\LogRecord;

class TelegramHandler extends AbstractProcessingHandler
{
    private const BOT_API = 'https://api.telegram.org/bot';

    private string $token;
    private string $chatId;

    public function __construct(array $config = [])
    {
        $this->token = $config['with']['token'];
        $this->chatId = $config['with']['chat_id'];

        parent::__construct(
            $config['level'] ?? Level::Debug,
            $config['bubble'] ?? true
        );
    }

    protected function write(LogRecord $record): void
    {
        Http::get(self::BOT_API.$this->token.'/sendMessage', [
            'chat_id' => $this->chatId,
            'text' => $record->formatted,
        ]);
    }
}
