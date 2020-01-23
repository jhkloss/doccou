<?php

namespace App\Composers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;

class CourseEditComposer
{
    private $id;
    private $course;

    public function __construct()
    {
        // Dependencies automatically resolved by service container...
        $this->id = Route::current()->parameter('id');
        $this->course = DB::table('course')->where('id', $this->id)->first();
    }

    public function compose(View $view)
    {
        $view->with('course', $this->course);
    }
}
