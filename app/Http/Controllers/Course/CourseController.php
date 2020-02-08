<?php

namespace App\Http\Controllers\Course;

use App\Course;
use App\Http\Controllers\Controller;
use App\Http\Controllers\User\UserController;
use App\Traits\MemberTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    use MemberTrait;

    private $currentUserID;

    // TODO: Auf Course Model umbauen

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        if(Auth::check())
        {
            $this->currentUserID = Auth::id();
        }
    }

    /**
     * Creates a new Course
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(Request $request)
    {
        $success = DB::table('course')->insert([
            'name' => $request->post('name'),
            'description' => $request->post('description'),
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
            'creator_id' => Auth::id(),
        ]);

        if($success)
        {
            return redirect()->route('courses');
        }

        return redirect()->route('createCourse');
    }

    /**
     * Updates a course.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit(Request $request)
    {
        $id = $request->post('id');

        // Only continue if user is the course creator
        if($id && $this->middleware('checkEditCourse', ['id' => $id]))
        {
             $success = DB::table('course')->where('id', $id)->update([
                'name' => $request->post('name'),
                'description' => $request->post('description'),
                'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
            ]);
             return redirect()->route('courses');
        }
    }

    /**
     * Get the course-data for the course specified by the given courseID.
     * @param $courseID
     * @return array|\Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|object|null
     */
    static function get($courseID)
    {
        $query = DB::table('course')->where('id', $courseID);

        if($query->count() == 1)
        {
            return $query->first();
        }

        return [];
    }

    /**
     * Get the course-data for the course specified by the given courseID.
     * @param $courseID
     * @return array|\Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|object|null
     */
    static function getCreator($courseID)
    {
        $userID = null;

        $query = DB::table('course')->where('id', $courseID);

        if($query->count() == 1)
        {
            $userID = $query->value('creator_id');
        }

        if($userID != null)
        {
            $query = DB::table('users')->where('id', $userID);

            if($query->count() == 1)
            {
                return $query->first();
            }
        }

        return [];
    }

    /**
     * @param $courseID
     * @return bool
     */
    static function canEdit($courseID)
    {
        if($courseID)
        {
            $creatorID = DB::table('course')->where('id', $courseID)->value('creator_id');

            if($creatorID == Auth::id())
            {
                return true;
            }
        }
        return false;
    }

    /**
     * @param int $amount
     * @return
     */
    public function getRecent(int $amount)
    {
        return array_slice(UserController::getUserCourses(), 0, $amount );
    }
}
