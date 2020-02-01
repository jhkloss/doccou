<?php

namespace App\Http\Controllers\Docker;

use App\Container;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Task\TaskController;
use App\Services\DockerService;
use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PharData;

class DockerController extends Controller
{
    private $dockerService;

    /**
     * Create a new controller instance.
     *
     * @param DockerService $dockerService
     */
    public function __construct(DockerService $dockerService)
    {
        $this->dockerService = $dockerService;
    }

    /**
     * @param $taskID
     * @return string
     */
    static function getDockerfile($taskID)
    {
        $Task = Task::find($taskID);
        if($Task)
        {
            if(Storage::exists($Task->dockerfile))
            {
                return Storage::get($Task->dockerfile);
            }
        }

        return '';
    }

    /**
     * Copies the dockerfile for the given task to a public accessible directory and returns it's path.
     * @param $taskID
     * @return string
     */
    static function getPublicDFPath($taskID)
    {
        $task = Task::find($taskID);

        if($task)
        {
            $handle = 'Dockerfile_' . uniqid();
            $publicPath = 'public/' . $handle;

            Storage::copy($task->dockerfile, $publicPath);

            if(Storage::exists($publicPath))
            {
                return asset('storage/' . $handle);
            }
        }

        return '';
    }

    static function getDFTarArchive($taskID)
    {
        $task = Task::find($taskID);
        $path = storage_path('app') . '/tmp/Dockerfile_' . uniqid() . '.tar';

        $tar = new PharData($path);
        $tar->addFile(Storage::disk('local')->path($task->dockerfile), 'Dockerfile');

        return $path;
    }

    static function getDFName($taskID)
    {
        $task = Task::find($taskID);
        return pathinfo(Storage::disk('local')->path($task->dockerfile),PATHINFO_FILENAME);
    }

    /**
     * Returns all containers from the docker host as array.
     */
    public function getContainers()
    {
        return $this->dockerService->listContainers();
    }

    /**
     * @param Request $request
     * @return string
     */
    public function buildImage(Request $request)
    {
        $taskID = $request->post('taskID');

        if($taskID)
        {
            $dockerfileArchive = self::getDFTarArchive($taskID);

            if($dockerfileArchive)
            {
                $response = $this->dockerService->createImage($dockerfileArchive);
                if($response['response'] !== false)
                {
                    TaskController::saveImage($taskID, $response['tag']);
                    return 'Successfully created the Image ' . $response['tag'];
                }
            }
        }

        return 'There has been an error. Message: ' . var_dump($response);
    }

    public function createContainer(Request $request)
    {
        $taskID = $request->post('taskID');
        $task = Task::find($taskID);
        $response = $this->dockerService->createContainer($task->dockerimage);
    }

    public function createCourseContainers(Request $request)
    {
        $taskID = $request->post('taskID');
        $task = Task::find($taskID);

        $courseMembers = $task->course->members;

        if($task && $courseMembers)
        {
            foreach ($courseMembers as $member)
            {
                $response = $this->dockerService->createContainer($task->dockerimage);

                if($response && $response['response'] !== false)
                {
                    $container = new Container();
                    $container->user_id = $member->id;
                    $container->handle = $response['name'];
                    $container->save();
                }
            }
        }
    }
}
