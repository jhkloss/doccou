<?php

namespace App\Composers;

use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class MainComposer
{
    protected $courses;


    public function __construct()
    {
        // Dependencies automatically resolved by service container...

    }

    public function compose(View $view)
    {

    }
}
