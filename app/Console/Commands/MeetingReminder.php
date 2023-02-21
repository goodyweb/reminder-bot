<?php

namespace App\Console\Commands;

use Carbon\Carbon;

use Illuminate\Console\Command;

class MeetingReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:meeting-reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remind customer & experts just before their meeting';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $bookings = Booking::where('call_start_time', '<=', Carbon::now()->add(15, 'minute')->toDateTimeString())
                            ->where('call_start_time', '>', Carbon::now()->toDateTimeString())
                            ->where('notified', 0)
                            ->get();

        foreach ($bookings as $booking){
            $booking->expert->user->notify(new MeetingReminderNotification());
            $booking->customer->user->notify(new MeetingReminderNotification());
            $booking->notified = 1;
            $booking->save();
    }
}
}
