<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use DB;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);
        $credentials['is_active'] = 1;
        /* $users = DB::table('users')->where('email',$request->email)->first();
        dump(Hash::check($request->password, $users->password),$request->password,$credentials,Auth::attempt($credentials));
        dd($users); */
        if(!empty($request->type))
        {
            if($request->type == 1)
            {
                if(!empty($request->clg_id))
                {
                    $model = 'Student'.$request->clg_id.'User';
                    if($request->clg_id == 85)
                    {
                        $model = 'StudentUser';
                    }
                    $users = modelFn($model)::where('email',$request->email)->where('is_active',1);
                    if($users->exists())
                    {
                        $users = $users->first();
                        if(Hash::check($request->password, $users->password))
                        {
                            Auth::login($users);
                            session()->put('user',$users);
                            Log::alert($users);
                            return redirect()->intended('dashboard');
                        }
                    }
                }
            }else{
                if (Auth::attempt($credentials)) {
                    $request->session()->regenerate();
                    return redirect()->intended('dashboard');
                }
            }
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
}
