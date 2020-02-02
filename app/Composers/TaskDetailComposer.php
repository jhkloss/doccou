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
    private $dockerfile;
    private $dockerController;
    private $imageInfo;

    public function __construct(DockerController $dockerController)
    {
        $this->dockerController = $dockerController;

        $this->id = Route::current()->parameter('id');

        $this->hasDockerimage = TaskController::hasImage($this->id);

        $this->dockerfile = DockerController::getDockerfile($this->id);

        $this->imageInfo = $dockerController->getImageInfo($this->id);
    }

    public function compose(View $view)
    {
        return $view
            ->with('dockerfile', $this->dockerfile)
            ->with('hasDockerimage', $this->hasDockerimage)
            ->with('imageInfo', $this->imageInfo);
    }
}
