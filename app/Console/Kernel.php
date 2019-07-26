<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Jobs\UserReminder;
use App\Jobs\HourlyReminder;
use App\Jobs\DailyReminder;
use App\Jobs\WeeklyReminder;
use App\Jobs\MonthlyReminder;
use App\Jobs\YearlyReminder;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('send:mail')
        //          ->everyMinute();
        // $schedule->job(new UserReminder)->everyMinute();
        $schedule->job(new HourlyReminder)->hourly();
        $schedule->job(new DailyReminder)->daily();
        $schedule->job(new WeeklyReminder)->weekly();
        $schedule->job(new MonthlyReminder)->monthly();
        $schedule->job(new YearlyReminder)->yearly();
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
