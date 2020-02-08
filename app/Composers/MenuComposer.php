<?php

namespace App\Composers;

use App\Http\Controllers\Course\CourseController;
use App\Http\Controllers\Docker\DockerController;
use App\Http\Controllers\Task\TaskController;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;

class MenuComposer
{
    private $courseController;
    private $recentCourses;

    public function __construct(CourseController $courseController)
    {
        $this->courseController = $courseController;
        $this->recentCourses = $this->courseController->getRecent(3);
    }

    public function compose(View $view)
    {
        return $view
            ->with('recentCourses', $this->recentCourses);
    }
}
