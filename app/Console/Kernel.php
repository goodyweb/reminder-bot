<?php

namespace App\Console;
use App\Console\Commands;
use DB;
use App\Models\FixedDate;
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

        $fixeddates = FixedDate::all();

        foreach($fixeddates as $fixeddate){
            if($fixeddate->frequency == "Annually"){
                $schedule->command('remind:daily1')->everyMinute();
            }elseif($fixeddate->frequency == "Quarterly"){
                $schedule->command('remind:daily2')->everyMinute();
            }else{
                $schedule->command('remind:daily3')->everyMinute();
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
