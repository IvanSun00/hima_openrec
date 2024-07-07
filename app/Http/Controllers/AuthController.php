<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Candidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{

    function loginView(){
        $data['error'] = session('error');
        $data['title'] = "Login Page";
        return view('main.login',$data);
    }
    
    function loginRedirect(){
        return Socialite::driver('google')->redirect();
    }

    function loginProcess(){
        try{
            $user = Socialite::driver('google')->user();
            $email = $user->email;
            $name = $user->name;
            // check apakah john.petra.ac.id
            if(str_ends_with($email, 'john.petra.ac.id')){
                session()->put('nrp', substr($email, 0, 9));
                session()->put('name', $name);
                session()->put('email', $email);

                // check apakah candidate
                $candidate = Candidate::where('email',strtolower($email))->first();
                if($candidate){
                    session()->put('candidate_id',$candidate->id);
                }

                // check apakah admin
                $admin = Admin::where('email',strtolower($email))->with('department')->first();
                if($admin){
                    session()->put('admin_id',$admin->id);
                    session()->put('department_id',$admin->department->id);
                    session()->put('role',$admin->department->slug);
                    session()->put('isAdmin',true);
                    return redirect()->intended(route('admin.dashboard'));
                }else{
                    session()->put('isAdmin',false);
                    return redirect()->intended(route('candidate.dashboard'));
                }
            }else{
                return redirect()->route('login')->with('error', 'Please Use Your @john.petra.ac.id email');
            }
            
        }catch(\Exception $e){
            // add error to log
            Log::error('Google Login Process Error: ' . $e->getMessage());
            return redirect()->route('login')->with('error', 'Something went wrong');

        }
    }

    public function loginPaksa($nrp,$secret,Request $request){
        if (parse_url(url()->current(), PHP_URL_HOST) == 'himainfra.petra.ac.id' && env('APP_ENV') == 'production') {
            abort(404);
        }
        if($secret != env('SECRET_LOGIN')){
            abort(404);
        }
        $nrp = strtolower($nrp);
        $email = $nrp."@john.petra.ac.id";
        $request->session()->put('email', $nrp."@john.petra.ac.id");
        $request->session()->put('nrp',$nrp);
        $request->session()->put('name', $nrp);

        // check apakah candidate
        $candidate = Candidate::where('email',strtolower($email))->first();
        if($candidate){
            session()->put('candidate_id',$candidate->id);
            session()->put('name', $candidate->name);
        }

        // check apakah admin
        $admin = Admin::where('email',strtolower($email))->with('department')->first();
        if($admin){
            session()->put('admin_id',$admin->id);
            session()->put('department_id',$admin->department->id);
            session()->put('role',$admin->department->slug);
            session()->put('isAdmin',true);
            session()->put('name', $admin->name);
            return redirect()->intended(route('admin.dashboard'));
        }else{
            session()->put('isAdmin',false);
            return redirect()->intended(route('candidate.dashboard'));
        }
    }

    function logout(Request $request) {
        $request->session()->flush();
        return redirect()->route('login');
    }

    
}
