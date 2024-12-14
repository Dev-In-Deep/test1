<?php

namespace App\Queue;

interface Job
{
    public function run();
}
