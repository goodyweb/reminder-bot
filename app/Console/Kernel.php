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
                $schedule->command('remind:daily1')->dailyAt('7:00');//this is fixed date
                $schedule->command('remind:unfixedannually')->dailyAt('7:00');//this is unfixed date
           }elseif($notif->name == "Quarterly"){
                $schedule->command('remind:daily2')->dailyAt('7:00');//this is fixed date
                $schedule->command('remind:unfixedquarterly')->dailyAt('7:00');//this is unfixed date
            }elseif($notif->name == "Monthly"){
                $schedule->command('remind:daily3')->dailyAt('7:00');//this is fixed date
                $schedule->command('remind:unfixedmonthly')->dailyAt('7:00');//this is unfixed date
            }elseif($notif->name == "SemiAnnually"){
                $schedule->command('remind:daily4')->dailyAt('7:00'); 
                $schedule->command('remind:unfixedsemiannually')->dailyAt('7:00');//this is unfixed date
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
