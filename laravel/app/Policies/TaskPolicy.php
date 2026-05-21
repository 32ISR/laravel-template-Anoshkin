<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;

class TaskPolicy
{
    /**
     * Create a new policy instance.
     */
    public function viewAny(User $user)
    {
        return false;
    }

    public function view(User $user)
    {
        return false;
    }

    public function update(User $user, Task $task)
    {
        return $user->id === $task->user_id;
    }

    public function resotre()
    {
        return false;
    }

    public function forceDelete()
    {
        return false;
    }

    public function __construct()
    {
        //
    }
}
