<?php

namespace App\Http\Controllers\Chart;

use App\Container;
use App\Course;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Course\CourseController;
use App\Http\Controllers\Docker\DockerController;
use App\Http\Controllers\Task\TaskController;
use App\Task;
use App\User;

class ChartController extends Controller
{
    private $courseController;
    private $dockerController;
    private $taskController;

    public function __construct(CourseController $courseController, DockerController $dockerController, TaskController $taskController)
    {
        $this->courseController = $courseController;
        $this->dockerController = $dockerController;
        $this->taskController = $taskController;
    }

    public function generalChart()
    {
        $data = [];

        $data[] = User::all()->count();
        $data[] = Course::all()->count();
        $data[] = Task::all()->count();
        $data[] = Container::all()->count();

        return json_encode($data);
    }

}
