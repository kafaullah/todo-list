<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserReminderMail;
use Carbon\Carbon;
use App\ReminderJob;
use App\UserData;

class UserReminder implements ShouldQueue
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
        $reminderJobs = ReminderJob::whereDate('ending_date', '>=', Carbon::today()->toDateString())->get();

        if ($mailIds) {
            if ($reminderJobs) {
                foreach ($reminderJobs as $reminderJob) {
                    if ($reminderJob->execution_type == 'hourly') {
                        // echo "if hourly";
                        if ($reminderJob->executed_time == '') {
                            Mail::to($mailIds)->send(new UserReminderMail());
                            $jobReminder = ReminderJob::find($reminderJob->id);
                            if($jobReminder) {
                                $jobReminder->executed_time = date("Y-m-d h", strtotime ("+1 hour"));
                                $jobReminder->save();
                            }
                        } else if ($reminderJob->executed_time == date("Y-m-d h")) {
                            Mail::to($mailIds)->send(new UserReminderMail());
                            // ReminderJob::where('id', $reminderJob->id)->update(array('execution_type' => date("Y-m-d h", strtotime ("+1 hour"))));
                            
                            $jobReminder = ReminderJob::find($reminderJob->id);
                            if($jobReminder) {
                                $jobReminder->executed_time = date("Y-m-d h", strtotime ("+1 hour"));
                                $jobReminder->save();
                            }
                        }
                    } else if ($reminderJob->execution_type == 'daily') {
                        if ($reminderJob->executed_time == '') {
                            Mail::to($mailIds)->send(new UserReminderMail());
                            $jobReminder = ReminderJob::find($reminderJob->id);
                            if($jobReminder) {
                                $jobReminder->executed_time = Carbon::now()->today()->addDays(1);
                                $jobReminder->save();
                            }
                        } else if ($reminderJob->executed_time == Carbon::now()->today()) {
                            Mail::to($mailIds)->send(new UserReminderMail());
                            $jobReminder = ReminderJob::find($reminderJob->id);
                            if($jobReminder) {
                                $jobReminder->executed_time = Carbon::now()->today()->addDays(1);
                                $jobReminder->save();
                            }
                        }
                    } else if ($reminderJob->execution_type == 'weekly') {
                        if ($reminderJob->executed_time == '') {
                            Mail::to($mailIds)->send(new UserReminderMail());
                            $jobReminder = ReminderJob::find($reminderJob->id); 
                            if($jobReminder) {
                                $jobReminder->executed_time = Carbon::now()->today()->addWeek(1);
                                $jobReminder->save();
                            }
                        } else if ($reminderJob->executed_time == Carbon::now()->today()) {
                            Mail::to($mailIds)->send(new UserReminderMail());
                            $jobReminder = ReminderJob::find($reminderJob->id); 
                            if($jobReminder) {
                                $jobReminder->executed_time = Carbon::now()->today()->addWeek(1);
                                $jobReminder->save();
                            }
                        }
                    } else if ($reminderJob->execution_type == 'monthly') {
                        if ($reminderJob->executed_time == '') {
                            Mail::to($mailIds)->send(new UserReminderMail());
                            $jobReminder = ReminderJob::find($reminderJob->id);
                            if($jobReminder) {
                                $jobReminder->executed_time = Carbon::now()->today()->addMonth(1);
                                $jobReminder->save();
                            }
                        } else if ($reminderJob->executed_time == Carbon::now()->today()) {
                            Mail::to($mailIds)->send(new UserReminderMail());
                            $jobReminder = ReminderJob::find($reminderJob->id);
                            if($jobReminder) {
                                $jobReminder->executed_time = Carbon::now()->today()->addMonth(1);
                                $jobReminder->save();
                            }
                        }
                    } else if ($reminderJob->execution_type == 'yearly') {
                        if ($reminderJob->executed_time == '') {
                            Mail::to($mailIds)->send(new UserReminderMail());
                            $jobReminder = ReminderJob::find($reminderJob->id);
                            if($jobReminder) {
                                $jobReminder->executed_time = Carbon::now()->today()->addYear(1);
                                $jobReminder->save();
                            }
                        } else if ($reminderJob->executed_time == Carbon::now()->today()) {
                            Mail::to($mailIds)->send(new UserReminderMail());
                            $jobReminder = ReminderJob::find($reminderJob->id);
                            if($jobReminder) {
                                $jobReminder->executed_time = Carbon::now()->today()->addYear(1);
                                $jobReminder->save();
                            }
                        }
                    }
                }
            }
        }
    }
}
