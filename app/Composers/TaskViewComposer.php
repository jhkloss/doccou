<?php

namespace App\Composers;

use App\Http\Controllers\Docker\DockerController;
use App\Http\Controllers\Task\TaskController;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;

class TaskViewComposer
{
    private $id;
    private $dockerController;
    private $containerInfo;

    public function __construct(DockerController $dockerController)
    {
        $this->dockerController = $dockerController;

        $this->id = Route::current()->parameter('id');

        $this->containerInfo = $this->dockerController->getContainerInfo($this->id);
    }

    public function compose(View $view)
    {
        return $view
            ->with('containerInfo', $this->containerInfo);
    }
}
