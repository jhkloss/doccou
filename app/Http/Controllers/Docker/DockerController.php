<?php

namespace App\Http\Controllers\Docker;

use App\Container;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Task\TaskController;
use App\Services\DockerService;
use App\Services\MessageService;
use App\Task;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use PharData;

class DockerController extends Controller
{
    private $dockerService;
    private $messageService;

    /**
     * Create a new controller instance.
     *
     * @param DockerService $dockerService
     * @param MessageService $messageService
     */
    public function __construct(DockerService $dockerService, MessageService $messageService)
    {
        $this->dockerService = $dockerService;
        $this->messageService = $messageService;
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

    /**
     * @param $taskID
     * @return string
     */
    static function getDFTarArchive($taskID)
    {
        $task = Task::find($taskID);
        $path = storage_path('app') . '/tmp/Dockerfile_' . uniqid() . '.tar';

        $tar = new PharData($path);
        $tar->addFile(Storage::disk('local')->path($task->dockerfile), 'Dockerfile');

        return $path;
    }

    /**
     * @param $taskID
     * @return string|string[]s
     */
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
                if($response !== false)
                {
                    $id = preg_replace( "/\r|\n/", "", $response['id']);
                    TaskController::saveImage($taskID, $response['tag'], $id);
                    $message = 'Successfully created the Image ' . $response['tag'];
                    return $this->messageService->successMessage($message);
                }
            }
        }

        $message = 'Operation not successful - Please try again.';
        return $this->messageService->errorMessage($message);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function createContainer(Request $request)
    {
        $taskID = $request->post('taskID');
        $task = Task::find($taskID);
        return $this->dockerService->createContainer($task->imageTag);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createCourseContainers(Request $request)
    {
        $taskID = $request->post('taskID');
        $task = Task::find($taskID);

        $courseMembers = $task->course->members->all();

        if($task && $courseMembers)
        {
            foreach ($courseMembers as $member)
            {
                // Check if there is already a container for this user and delete it if needed
                $currentContainer = $this->hasContainer($task->id, $member->id);

                // Delete the old container if found
                if($currentContainer !== false)
                {
                    $this->deleteContainer($currentContainer);
                }

                // Try to create a container
                $response = $this->dockerService->createContainer($task->imageTag);

                // If Container creation was successful, cerate a DB entry
                if($response && $response['response'] !== false)
                {
                    $container = new Container();
                    $container->user_id = $member->id;
                    $container->task_id = $taskID;
                    $container->handle = $response['name'];
                    $container->save();
                }
                else
                {
                    $message = 'Could not create containers. Error: ' . var_dump($response);
                    return $this->messageService->errorMessage($message);
                }
            }
        }

        $message = 'Successfully created containers for all course members.';
        return $this->messageService->successMessage($message);
    }

    /**
     * @param string $taskID
     * @return bool|mixed|string
     */
    public function getImageInfo(string $taskID)
    {
        $task = Task::find($taskID);
        if($task && $task->imageId)
        {
            return $this->dockerService->getImageInfo($task->imageId);
        }

        return '';
    }

    /**
     * @param $taskID
     * @param $memberID
     * @return object|bool
     */
    private function getContainerForTaskMember(int $taskID, int $memberID)
    {
        $container = Container::where('task_id', $taskID)->where('user_id', $memberID)->first();
        if(!empty($container))
        {
            return $container;
        }
        return false;
    }

    /**
     * @param $taskID
     * @return bool|mixed|string
     */
    public function getContainerInfo(int $taskID)
    {
       $container = $this->getContainerForTaskMember($taskID, Auth::id());
       if($container !== false)
       {
           return $this->dockerService->getContainerInfo($container->handle);
       }
       return '';
    }

    /**
     * @param $taskID
     * @param $userID
     * @return Container|bool
     */
    private function hasContainer(int $taskID, int $userID)
    {
        $container = $this->getContainerForTaskMember($taskID, $userID);
        if($container !== false)
        {
            return $container;
        }
        return false;
    }

    /**
     * @param Container $container
     */
    private function deleteContainer(Container $container)
    {
        $this->dockerService->deleteContainer($container->handle);
        Container::destroy($container->id);
    }

    /**
     * @param $taskID
     * @return string
     */
    public function getTaskContainers($taskID)
    {
        $html = '';

        $containers = Container::all()->where('task_id', $taskID);

        if($containers)
        {
            foreach ($containers as $container)
            {
                $member = User::find($container->user_id);

                $html .= view('container/container-li')
                    ->with('container', $container)
                    ->with('member', $member);
            }
        }

        return $html;
    }
}
