<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Setting;
use App\Models\Applicant;
use App\Models\Candidate;

class applicantMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!session('isAdmin')){
            if(session('candidate_id') == null){
                return redirect()->route('home');
            }
            // else{
            //     $app = Candidate::where('id',session('candidate_id'))->get()->first();
            //     if($app->stage <= 3){
            //         return redirect()->route('applicant.application-form');
            //     }
            // }
        }
        return $next($request);
    }
}
