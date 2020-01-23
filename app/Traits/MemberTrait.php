<?php

namespace App\Traits;

use App\Course;
use Illuminate\Http\Request;

trait MemberTrait
{
    static function getCourseMembers($courseID)
    {
        return Course::find($courseID)->members;
    }

    static function addMember(Request $request, int $courseID)
    {
        $userID = $request->post('userID');
        Course::find($courseID)->members()->attach($userID);
    }

    static function removeMember(Request $request, int $courseID)
    {
        $userID = $request->post('userID');
        Course::find($courseID)->members()->detach($userID);
    }
}
