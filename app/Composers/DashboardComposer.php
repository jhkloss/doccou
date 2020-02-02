<?php

namespace App\Composers;

use App\Http\Controllers\User\UserController;
use Illuminate\View\View;

class DashboardComposer
{
    private $courses;
    private $tasks;
    private $containers;

    public function __construct()
    {
        $this->courses = UserController::getUserCourses();
        $this->tasks = UserController::getUserTasks();
        $this->containers = UserController::getUserContainers();
    }

    public function compose(View $view)
    {
        return $view
            ->with('courses', $this->courses)
            ->with('tasks', $this->tasks)
            ->with('containers', $this->containers);
    }
}
