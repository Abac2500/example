<?php

namespace App\Observers;

use App\Models\Task;
use App\Notifications\TaskNew;

class TaskObserver
{
    /**
     * Handle the Task "created" event.
     *
     * @param Task $task
     * @return void
     */
    public function created(Task $task): void
    {
        if ($task->user->id !== auth()->user()->getAuthIdentifier()) {
            $task->user->notify(new TaskNew(auth()->user(), $task));
        }
    }
}
