<?php

namespace App\Http\Controllers\Task;

use App\Course;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Course\CourseController;
use App\Task;
use Illuminate\Http\Request;

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

    public function create(Request $request)
    {
    }

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

    public function edit(Request $request)
    {
        $taskID = $request->post('taskID');

        $Task = Task::find($taskID);

        $Task->name = $request->post('name');

        $Task->description = $request->post('description');

        $Task->save();

        return redirect()->route('viewCourse', $Task->course_id);
    }

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

    static function getAll()
    {
        return Task::all();
    }

    static function get($taskID)
    {
        return Task::find($taskID);
    }

    static function getAllForCourse($courseID)
    {
        return Course::find($courseID)->tasks;
    }

    static function getAllForUser($userID)
    {

    }
}
