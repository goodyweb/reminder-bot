<?php

namespace App\Console;
use App\Console\Commands;
use DB;
use App\Models\Reminders;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{

    protected $commands = [            
        Commands\remindCommand::class
    ];
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
      $reminders = Reminders::all();

      foreach($reminders as $reminder)
        {
            if($reminder->notif == 'monthly'){
                $schedule->command('command:remind')->monthly();
            }elseif($reminder->notif == 'daily'){
                $schedule->command('command:remind')->daily();
            }elseif($reminder->notif == 'hourly'){
                $schedule->command('command:remind')->hourly();
            }elseif($reminder->notif == 'minutes'){
                $schedule->command('command:remind')->everyFiveMinutes();
            }
            
        }
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
