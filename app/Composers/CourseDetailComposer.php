<?php

namespace App\Composers;

use App\Http\Controllers\Course\CourseController;
use App\Http\Controllers\Task\TaskController;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;

class CourseDetailComposer
{
    private $id;
    private $course;
    private $creator;
    private $tasks;
    private $canEdit;

    public function __construct()
    {
        // Dependencies automatically resolved by service container...
        $this->id = Route::current()->parameter('id');
        $this->course = CourseController::get($this->id);
        $this->creator = CourseController::getCreator($this->id);
        $this->tasks = TaskController::getAllForCourse($this->id);
    }

    public function compose(View $view)
    {
        return $view
            ->with('course', $this->course)
            ->with('creator', $this->creator)
            ->with('tasks', $this->tasks);
    }
}
