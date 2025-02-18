<?php

namespace App\Queue;

use UnderflowException;


interface Queue
{
    /**
     * Добавляет элемент в конец очереди.
     *
     * @param mixed $item Элемент, который нужно добавить.
     * @return void
     */
    public function enqueue(Job $item): void;

    /**
     * Удаляет элемент из начала очереди и возвращает его.
     *
     * @return mixed Элемент, удаленный из начала очереди.
     * @throws UnderflowException Если очередь пуста.
     */
    public function dequeue() : Job;

    /**
     * Возвращает элемент из начала очереди без его удаления.
     *
     * @return mixed Элемент из начала очереди.
     * @throws UnderflowException Если очередь пуста.
     */
    public function head(): Job;

    /**
     * Возвращает элемент из конца очереди без его удаления.
     *
     * @return mixed Элемент из начала очереди.
     * @throws UnderflowException Если очередь пуста.
     */
    public function tail(): Job;

    /**
     * Возвращает `true`, если очередь пуста, иначе `false`.
     *
     * @return bool
     */
    public function isEmpty(): bool;

    /**
     * Возвращает количество элементов в очереди.
     *
     * @return int
     */
    public function size(): int;
}
