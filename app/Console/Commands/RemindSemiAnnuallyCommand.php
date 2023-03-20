<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

<<<<<<<< HEAD:app/Console/Commands/RemindAnnuallyCommand.php
class RemindAnnuallyCommand extends Command
========
class RemindSemiAnnuallyCommand extends Command
>>>>>>>> 4c9b5ed5ae499732cea77abe7f0c0f106939be60:app/Console/Commands/RemindSemiAnnuallyCommand.php
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
<<<<<<<< HEAD:app/Console/Commands/RemindAnnuallyCommand.php
    protected $signature = 'remind:daily1';
========
    protected $signature = 'remind:daily4';
>>>>>>>> 4c9b5ed5ae499732cea77abe7f0c0f106939be60:app/Console/Commands/RemindSemiAnnuallyCommand.php

    /**
     * The console command description.
     *
     * @var string
     */
<<<<<<<< HEAD:app/Console/Commands/RemindAnnuallyCommand.php
    protected $description = 'Remind me everyday with annually';
========
    protected $description = 'Remind me everyday';
>>>>>>>> 4c9b5ed5ae499732cea77abe7f0c0f106939be60:app/Console/Commands/RemindSemiAnnuallyCommand.php

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
<<<<<<<< HEAD:app/Console/Commands/RemindAnnuallyCommand.php
        return app()->call('App\Http\Controllers\ReminderController@fixDateNotifyAnnually');
========
        return app()->call('App\Http\Controllers\ReminderController@fixDateNotifySemiAnnually');
>>>>>>>> 4c9b5ed5ae499732cea77abe7f0c0f106939be60:app/Console/Commands/RemindSemiAnnuallyCommand.php
    }
}
