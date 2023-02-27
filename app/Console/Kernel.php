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
                $schedule->command('remind:monthly')->monthly();
            }elseif($reminder->notif == 'daily'){
                $schedule->command('remind:daily')->daily();
            }elseif($reminder->notif == 'hourly'){
                $schedule->command('remind:hourly')->hourly();
            }elseif($reminder->notif == 'minutes'){
                $schedule->command('remind:minutes')->everyMinute();
            }

            
        }
       //$schedule->command('command:remind')->everyMinute();
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
