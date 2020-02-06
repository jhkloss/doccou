<?php

namespace App\Http\Controllers\Task;

use App\Course;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Course\CourseController;
use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * @param Request $request
     * @return false|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     */
    public function add(Request $request)
    {
        $courseID = $request->post('courseID');

        if(CourseController::canEdit($courseID))
        {
            $Task = new Task();
            $Task->name = 'New Task';
            $Task->course_id = $courseID;

            $Task->save();

            return view('task.task-entry-small')->with('task', $Task);
        }
        return json_encode(false);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit(Request $request)
    {
        $taskID = $request->post('taskID');

        $Task = Task::find($taskID);

        $Task->name = $request->post('name');

        $Task->description = $request->post('description');

        $Task->save();

        return redirect()->route('viewCourse', $Task->course_id);
    }

    /**
     * @param Request $request
     * @param $taskID
     * @return \Illuminate\Http\RedirectResponse
     */
    public function uploadDockerfile(Request $request, $taskID)
    {
        $path = $request->file('dockerfile')->store('dockerfiles');

        if($path)
        {
            $Task = Task::find($taskID);

            if($Task)
            {

                if($Task->dockerfile && Storage::exists($Task->dockerfile))
                {
                    Storage::delete($Task->dockerfile);
                }

                $Task->dockerfile = $path;
                $Task->save();
            }

            return redirect()->route('viewTask', $Task->id);
        }
    }

    /**
     * @param $taskID
     * @param $imageTag
     * @param $imageID
     */
    static function saveImage($taskID, $imageTag, $imageID)
    {
        $Task = Task::find($taskID);

        if($Task)
        {
            $Task->imageTag = $imageTag;
            $Task->imageId = $imageID;
            $Task->save();
        }
    }

    /**
     * @param $taskID
     * @return bool
     */
    static function hasImage($taskID)
    {
        $task = Task::find($taskID);
        if($task->imageId)
        {
            return true;
        }
        return false;
    }

    /**
     * @param $taskID
     * @return bool
     */
    static function canEdit($taskID)
    {
        $courseID = Task::find($taskID)->course_id;

        if($courseID)
        {
            if(CourseController::canEdit($courseID))
            {
                return true;
            }
        }
        return false;
    }

    /**
     * @return Task[]|\Illuminate\Database\Eloquent\Collection
     */
    static function getAll()
    {
        return Task::all();
    }

    /**
     * @param $taskID
     * @return mixed
     */
    static function get($taskID)
    {
        return Task::find($taskID);
    }

    /**
     * @param $courseID
     * @return mixed
     */
    static function getAllForCourse($courseID)
    {
        return Course::find($courseID)->tasks;
    }
}
