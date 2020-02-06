<?php

namespace App\Composers;

use App\Http\Controllers\Task\TaskController;
use App\Task;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class TaskOverviewComposer
{
    private $tasks;

    public function __construct()
    {
        $this->tasks = Task::where('user_id', Auth::id())->paginate(10);
    }

    public function compose(View $view)
    {
        return $view->with('tasks', $this->tasks);
    }
}
