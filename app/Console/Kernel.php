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
                $schedule->command('remind:daily1')->everyMinute();//this is fixed date
                $schedule->command('remind:unfixedannually')->everyMinute();//this is unfixed date
           }elseif($notif->name == "Quarterly"){
                $schedule->command('remind:daily2')->everyMinute();//this is fixed date
                $schedule->command('remind:unfixedquarterly')->everyMinute();//this is unfixed date
            }elseif($notif->name == "Monthly"){
                $schedule->command('remind:daily3')->everyMinute();//this is fixed date
                $schedule->command('remind:unfixedmonthly')->everyMinute();//this is unfixed date
<<<<<<< HEAD
            }
        }
=======
            }elseif($notif->name == "SemiAnnually"){
                $schedule->command('remind:daily4')->everyMinute(); 
             }
        }

>>>>>>> 4c9b5ed5ae499732cea77abe7f0c0f106939be60
        

       
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
