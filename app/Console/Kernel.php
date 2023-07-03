<?php

namespace App\Console;

use App\Jobs\CollegeAdmissionSeat;
use App\Models\AdmissionSeat;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->call('\App\Http\Controllers\AdmissionController@AdmissionSeat')->everyMinute();
        $schedule->call('\App\Http\Controllers\AdmissionController@AdmissionSeat')->yearlyOn(1, 1, '00:00');
        // $schedule->command('inspire')->hourly();
        $schedule->command('publish-notice:cron')->everyMinute();
        $schedule->command('update:project-data')->everyMinute();

    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
