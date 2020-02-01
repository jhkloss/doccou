<?php

namespace App\Composers;

use App\Http\Controllers\Docker\DockerController;
use App\Http\Controllers\Task\TaskController;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;

class TaskDetailComposer
{
    private $id;
    private $hasDockerimage;

    public function __construct()
    {
        $this->id = $this->id = Route::current()->parameter('id');
        $this->hasDockerimage = TaskController::hasImage($this->id);
    }

    public function compose(View $view)
    {
        return $view
            ->with('dockerfile', DockerController::getDockerfile($this->id))
            ->with('hasDockerimage', $this->hasDockerimage);
    }
}
