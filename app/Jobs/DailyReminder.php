<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Mail\UserReminderMail;
use App\UserData;
use Carbon\Carbon;


class DailyReminder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

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
        $reminderJobs = ReminderJob::whereDate('ending_date', '>=', Carbon::today()->toDateString())->where('name', '=', 'daily')->get();

       if ($mailIds) {
            if ($reminderJobs) {
                foreach ($reminderJobs as $reminderJob) {
                    if ($reminderJob->executed_time == Carbon::now()->today()) {
                        Mail::to($mailIds)->send(new UserReminderMail());
                        $jobReminder = ReminderJob::find($reminderJob->id);
                        if($jobReminder) {
                            $jobReminder->executed_time = Carbon::now()->today()->addDays(1);
                            $jobReminder->save();
                        }
                    }
                }
            }
       }
    }
}
