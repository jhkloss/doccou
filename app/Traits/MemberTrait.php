<?php

namespace App\Traits;

use App\Course;
use App\Http\Controllers\Course\CourseController;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

trait MemberTrait
{
    static function getCourseMembers($courseID)
    {
        return Course::find($courseID)->members;
    }

    static function addMember(Request $request, int $courseID)
    {
        $userIDs = [];
        $html = '';

        $users = json_decode($request->post('users'));

        if($users)
        {
            foreach ($users as $user)
            {
                $userIDs[] = $user->id;

                $member = User::find($user->id);
                $html .= view('member.member-entry')
                    ->with('member', $member)
                    ->with('canEdit', CourseController::canEdit($courseID));
            }

            Course::find($courseID)->members()->attach($userIDs);

            return $html;
        }

        return '';
    }

    static function removeMember(Request $request, int $courseID)
    {
        $userID = $request->post('userID');
        Course::find($courseID)->members()->detach($userID);
    }

    static function isPartOfCourse($userID, $courseID)
    {
        return DB::table('course_user')
            ->where('course_id', $courseID)
            ->where('user_id', $userID)
            ->exists();
    }
}
