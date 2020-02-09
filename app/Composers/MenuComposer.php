<?php

namespace App\Composers;

use App\Http\Controllers\Course\CourseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class MenuComposer
{
    private $courseController;
    private $recentCourses;

    public function __construct(CourseController $courseController)
    {
        $this->courseController = $courseController;
        if(Auth::check())
        {
            $this->recentCourses = $this->courseController->getRecent(3);
        }
    }

    public function compose(View $view)
    {
        return $view
            ->with('recentCourses', $this->recentCourses);
    }
}
