<?php

namespace App\Console;
use App\Console\Commands;
use DB;
use App\Models\Notify;
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

        

       $notify = Notify::All();
       foreach($notify as $notif){
        
           if($notif->name == "Annually"){
                $schedule->command('remind:daily1')->everyMinute();
           }elseif($notif->name == "Quarterly"){
                $schedule->command('remind:daily2')->everyMinute();
             }elseif($notif->name == "Monthly"){
                $schedule->command('remind:daily3')->everyMinute();
                //$schedule->command('remind:unfixedmonthly')->everyMinute();
            }elseif($notif->name == "SemiAnnually"){
                $schedule->command('remind:daily4')->everyMinute(); 
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
