<?php
namespace App\Console;

use App\Console\Commands\ClearAccountCommand;
use App\Console\Commands\CopyCourseCommand;
use App\Console\Commands\ExportUsersToExcelmailingCommand;
use App\Console\Commands\FixAccessDays;
use App\Console\Commands\FixFullAccessCommand;
use App\Console\Commands\FixSpecialCoursesVisibilityCommand;
use App\Console\Commands\LoginAsUserCommand;
use App\Console\Commands\ProlongSubscriptionsCommand;
use App\Console\Commands\RecalculateRatingCommand;
use App\Console\Commands\SendPasswordResetCommand;
use App\Console\Commands\TestServicesCommand;
use App\Console\Commands\UploadFontsCommand;
use App\Domains\Integrations\Mailerlite\Commands\AddStripeSubscriptionsToMailerliteCommand;
use App\Domains\Payments\ManualCancelSubscriptionsCommand;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        Commands\GenerateThumbnails::class,
        Commands\SendPlannedEmails::class,
        Commands\ImportUsers::class,
        Commands\SendPasswordResetEmails::class,
        Commands\ImportCoupons::class,
        Commands\CheckForExpiredAccounts::class,
        Commands\SendPlannedFollowups::class,
        Commands\DiscoverLeftOrders::class,
        Commands\CopyUsersToNewsletter::class,
        ProlongSubscriptionsCommand::class,
        FixAccessDays::class,
        ExportUsersToExcelmailingCommand::class,
        ClearAccountCommand::class,
        RecalculateRatingCommand::class,
        UploadFontsCommand::class,
        SendPasswordResetCommand::class,
        FixSpecialCoursesVisibilityCommand::class,
        LoginAsUserCommand::class,
        TestServicesCommand::class,
        FixFullAccessCommand::class,
        AddStripeSubscriptionsToMailerliteCommand::class,
        ManualCancelSubscriptionsCommand::class,
        CopyCourseCommand::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        $schedule->command('subscriptions:prolong')
            ->everyFiveMinutes();

        $schedule->command('iexcel:followups')
            ->everyMinute();

        $schedule->command('iexcel:emails')
            ->everyMinute();

        $schedule->command('iexcel:expired')
            ->everyTenMinutes();

        $schedule->command('subscriptions:cancel')
            ->hourly();

        $schedule->command('iexcel:orders')
            ->dailyAt('13:00');

        $schedule->command('mailerlite:add')
            ->dailyAt('3:45');
    }

    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
