<?php

namespace App\Composers;

use App\Http\Controllers\Course\CourseController;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class CourseOverviewComposer
{
    private $courses;

    public function __construct()
    {
        // Dependencies automatically resolved by service container...
        $this->courses = DB::table('course')->orderBy('updated_at', 'desc')->paginate(10);

    }

    public function compose(View $view)
    {
        foreach ($this->courses as $course)
        {
            $course->canEdit = CourseController::canEdit($course->id);
        }

        $view->with('courses', $this->courses);
    }
}
