<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('DeleteInActiveUsers:deleteusers')
        //          ->everyFiveMinute();
        $url_begin = "http://localhost/api/cron/begin";
        $url_end   = "http://localhost/api/cron/end";
        $schedule->exec('echo "\n"')
                 ->everyMinute()
                 ->pingBefore($url_begin)
                 ->thenPing($url_end);
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
