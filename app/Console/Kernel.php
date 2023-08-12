<?php

namespace App\Console;
use App\Jobs\SendEmailJob;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected $commands = [
        \App\Console\Commands\Test::class,
    ];
    protected function schedule(Schedule $schedule): void
    {
         $schedule->command('expired')->everyTwentySeconds();	
         $schedule->job(new SendEmailJob)->everyTwentySeconds();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}

 
