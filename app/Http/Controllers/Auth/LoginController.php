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
        $credentials['type'] = $request->type;
        $credentials['clg_id'] = (!empty($request->clg_id))?$request->clg_id:0;
        if(!empty($request->type))
        {
            if($request->type == 1)
            {
                if(!empty($request->clg_id))
                {
                    $model = 'Student'.$request->clg_id.'User';
                    $users = modelFn($model)::where('email',$request->email)->where('is_active',1);
                    if($users->exists())
                    {
                        $users = $users->first();
                        if (Auth::attempt($credentials)) {
                            session()->put('user',Auth::user());
                            $request->session()->regenerate();
                            return redirect()->intended('dashboard');
                        }
                        /* if(Hash::check($request->password, $users->password))
                        {
                            Auth::login($users,true);
                            session()->put('user',$users);
                            Log::alert(Auth::user());
                            return redirect()->route('dash-login');
                        } */
                    }
                }
            }else{

                if (Auth::attempt($credentials)) {
                    session()->put('user',Auth::user());
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
