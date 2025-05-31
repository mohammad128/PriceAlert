<?php

use Illuminate\Support\Facades\Schedule;


Schedule::command(command: 'app:price-alert-processor')
    ->name(description: 'process price alerts')
    ->withoutOverlapping()
    ->everyMinute();
