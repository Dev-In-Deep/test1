<?php

namespace App\Queue;

use Illuminate\Support\Str;
use RuntimeException;

class DatabaseQueue implements Queue
{
    public function __construct(
        protected string $table,
    )
    {
    }


    public function enqueue(Job $item): void
    {
        $payload = json_encode($this->getPayload($item), \JSON_UNESCAPED_UNICODE);
        \DB::table($this->table)->insert([
            'payload' => $payload,
            'created_at' => now()->timestamp,
        ]);
    }

    protected function getPayload(Job $job): array
    {
        return [
            'uuid' => (string) Str::uuid(),
            'displayName' => $job::class,
            'job' => 'Illuminate\Queue\CallQueuedHandler@call',
            'data' => [
                'commandName' => $job::class,
                'command' => serialize(clone $job),
            ],
        ];
    }

    public function dequeue(): Job
    {
        $record = $this->getTopRecord();
        $job = $this->getJob($record);
        \DB::table($this->table)->where('id', $record->id)->delete();

        return $job;
    }

    public function head(): Job
    {
        return $this->getJob($this->getTopRecord());
    }

    public function tail(): Job
    {
        return$this->getJob($this->getTailRecord());
    }

    public function isEmpty(): bool
    {
        return \DB::table($this->table)->count() === 0;
    }

    public function size(): int
    {
        return \DB::table($this->table)->count();
    }

    protected function getJob($record): Job{
        $payload = json_decode($record->payload, true);

        $job = $this->getCommand($payload['data']);

        return $job;
    }

    protected function getTopRecord()
    {
        return \DB::table($this->table)->orderByDesc('id')->limit(1)->first();
    }

    protected function getTailRecord()
    {
        return \DB::table($this->table)->orderByDesc('id')->limit(1)->first();
    }

    protected function getCommand(array $data)
    {
        if (str_starts_with($data['command'], 'O:')) {
            return unserialize($data['command']);
        }

        throw new RuntimeException('Unable to extract job payload.');
    }
}
