<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Mail\UserReminderMail;
use App\UserData;
use App\ReminderJob;
use Carbon\Carbon;

class HourlyReminder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    // public $reminder;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
       $mailIds = UserData::select('email')->get();
       $reminderJobs = ReminderJob::whereDate('ending_date', '>=', Carbon::today()->toDateString())->where('name', '=', 'hourly')->get();

       if ($mailIds) {
            if ($reminderJobs) {
                foreach ($reminderJobs as $reminderJob) {
                    if ($reminderJob->executed_time == Carbon::now()->format('Y-m-d H')) {
                        Mail::to($mailIds)->send(new UserReminderMail());
                        $jobReminder = ReminderJob::find($reminderJob->id);
                        if($jobReminder) {
                            $jobReminder->executed_time = Carbon::now()->addHour(1)->format('Y-m-d H');
                            $jobReminder->save();
                        }
                    }
                }
            }
       }
    }
}
