<?php

namespace App\Http\Controllers\User;

use App\Course;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Course\CourseController;
use App\Task;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
    public function __construct()
    {
    }

    public function getUsersJSON(Request $request)
    {
        $users = [];
        $users['results'] = [];

        $searchterm = $request->post('search');
        $courseID = $request->post('courseID');

        if($searchterm)
        {
            $usersDB = User::where('name', 'LIKE', '%' . $searchterm . '%')->get();
        }
        else
        {
            $usersDB = User::all('id', 'name');
        }

        //dump($usersDB);

        foreach ($usersDB as $user)
        {
            if(!CourseController::isPartOfCourse($user->id, $courseID))
            {
                $item = [];

                $item['id'] = $user->id;
                $item['text'] = $user->name;

                $users['results'][] = $item;
            }
        }

        return json_encode($users);
    }

    static function getUserCourses()
    {
        return User::find(Auth::id())->courses->sortByDesc('updated_at')->all();
    }

    static function getUserTasks()
    {
        $tasks = [];
        $courses = UserController::getUserCourses();

        foreach ($courses as $course)
        {
            $tasks = array_merge($tasks, Course::find($course->id)->tasks->sortByDesc('updated_at')->all());
        }

        return $tasks;
    }

    static function  getUserContainers()
    {
        return User::find(Auth::id())->containers()->get();
    }

}
