<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Http;

class remindCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:remind';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reminder';

   
    public function handle()
    {
        
        $tasks = Task::with('user')
                    ->where('reminder_at', '<=', now()->toDateTimeString())
                    ->get();
        
                foreach ($tasks as $task) {
                    $task->user->notify(new TaskReminderNotification($task));
                    $task->update(['reminder_at' => NULL]);
                }
        
                return 0;
    }
}
