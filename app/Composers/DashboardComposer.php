<?php

namespace App\Composers;

use App\Http\Controllers\User\UserController;
use Illuminate\View\View;

class DashboardComposer
{
    private $courses;
    private $tasks;

    public function __construct()
    {
        $this->courses = UserController::getUserCourses();
        $this->tasks = UserController::getUserTasks();
    }

    public function compose(View $view)
    {
        return $view
            ->with('courses', $this->courses)
            ->with('tasks', $this->tasks);
    }
}
