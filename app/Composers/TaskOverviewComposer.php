<?php

namespace App\Composers;

use App\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class TaskOverviewComposer
{
    private $tasks = [];

    public function __construct()
    {
        $courses = User::find(Auth::id())->courses;

        foreach ($courses as $course)
        {
            foreach ($course->tasks as $task)
            {
                $this->tasks[] = $task;
            }
        }
    }

    public function compose(View $view)
    {
        return $view->with('tasks', $this->tasks);
    }
}
