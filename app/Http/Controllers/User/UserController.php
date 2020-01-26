<?php

namespace App\Http\Controllers\User;

use App\Course;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Course\CourseController;
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

        $searchterm = $request->post('term');
        $courseID = $request->post('courseID');

        if($searchterm)
        {
            $usersDB = DB::table('users')
                ->where('name', 'like', '%' . $searchterm . '%')
                ->get();
        }
        else
        {
            $usersDB = User::all('id', 'name');
        }

        foreach ( $usersDB as $user)
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
        return User::find(Auth::id())->courses;
    }

    static function getUserTasks()
    {
        $tasks = [];
        $courses = UserController::getUserCourses();

        foreach ($courses as $course)
        {
            $tasks = array_merge($tasks, Course::find($course->id)->tasks->all());
        }

        return $tasks;
    }
}
