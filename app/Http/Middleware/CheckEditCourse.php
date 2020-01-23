<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckEditCourse
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param int $id
     * @param bool $returnBool
     * @return mixed
     */
    public function handle(Request $request, Closure $next, int $id = 0, bool $returnBool = false)
    {
        if($id === 0)
        {
            $courseID = $request->route('id');
        }
        else
        {
            $courseID = $id;
        }

        if($courseID)
        {
            $creatorID = DB::table('course')->where('id', $courseID)->value('creator_id');

            if($creatorID == Auth::id())
            {
                if($returnBool)
                {
                    return true;
                }
                return $next($request);
            }
        }
        if($returnBool)
        {
           return false;
        }
        return redirect()->route('main');
    }
}
