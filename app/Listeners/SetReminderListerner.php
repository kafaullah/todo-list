<?php

namespace App\Listeners;

use App\Events\SetReminder;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Jobs\UserReminder;
use App\ReminderJob;
use App\Reminder;
use Carbon\Carbon;

class SetReminderListerner
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  SetReminder  $event
     * @return void
     */
    public function handle(SetReminder $event)
    {
        $reminder = Reminder::find($event->todo->reminder_id);
        $reminderQue = new ReminderJob();
        $reminderQue->name = 'reminderQue';
        $reminderQue->starting_date = $event->todo->start_date;
        $reminderQue->ending_date = $event->todo->end_date;
        $reminderQue->execution_type = $reminder->name;

        if ($reminder->name == 'hourly') {
            $reminderQue->executed_time = Carbon::now()->format('Y-m-d H');
        } else {
            $reminderQue->executed_time = Carbon::now()->today();
        }
        
        $reminderQue->save();
        // UserReminder::dispatch();
    }
}
