<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\TaskCreated;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
class TaskCreateNotify implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public $task; 

    public function __construct($task)
    {
        $this->task = $task;
    }

    /**
     * Execute the job.
     */

    public function handle(): void
    {   
        $user = User::find($this->task->user_id);
         Mail::to($user)->send(new TaskCreated($this->task));
    }
}
