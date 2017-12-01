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
        // \App\Console\Commands\DiscoverAllImages::class,
        // \App\Console\Commands\DiscoverAllVideos::class,
        Commands\GenerateThumbnails::class,
        Commands\SendPlannedEmails::class,
        Commands\ImportUsers::class,
        Commands\SendPasswordResetEmails::class,
        Commands\ImportCoupons::class,
        Commands\CheckForExpiredAccounts::class,
        Commands\SendPlannedFollowups::class,
        Commands\DiscoverLeftOrders::class,
        Commands\CopyUsersToNewsletter::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
        
        $schedule->command('iexcel:followups')
            ->everyMinute();
        
        $schedule->command('iexcel:emails')
            ->everyMinute();

        $schedule->command('iexcel:expired')
            ->everyTenMinutes();

        $schedule->command('iexcel:orders')
            ->dailyAt('13:00');

    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
