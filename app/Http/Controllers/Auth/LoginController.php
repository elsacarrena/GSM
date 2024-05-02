<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');

    }
    protected function credentials(Request $request){
        return array_merge(
         $request->only($this->username(),'password'),
         ['confirmation_token' => null],
        );
    }

    public function login(Request $request){
        $input = $request->all();
        $this->validate($request,[
            'email' => 'required|email',
            'password' =>'required',
        ]);
        if(auth()->attempt(array('email'=>$input['email'], 'password'=>$input['password']))){
            if(auth()->user()->is_admin==1){
                return redirect()->route('admin.home');
            }else{
                return redirect()->route('home');
            }
        }else{
            return redirect()->route('login')->with('error', 'Renseignez le bon email ou mot de passe.');
        }
        if(auth()->attempt(array('email'=>$input['email'], 'password'=>$input['password']))){
            if(auth()->user()->superieur==2){
                return redirect()->route('superieur.home');
            }else{
                return redirect()->route('home');
            }
        }else{
            return redirect()->route('login')->with('error', 'Renseignez le bon email ou mot de passe.');
        }
        if(auth()->attempt(array('email'=>$input['email'], 'password'=>$input['password']))){
            if(auth()->user()->chefservice==3){
                return redirect()->route('chefservice.home');
            }else{
                return redirect()->route('home');
            }
        }else{
            return redirect()->route('login')->with('error', 'Renseignez le bon email ou mot de passe.');
        }
        if(auth()->attempt(array('email'=>$input['email'], 'password'=>$input['password']))){
            if(auth()->user()->employe==4){
                return redirect()->route('employe.home');
            }else{
                return redirect()->route('home');
            }
        }else{
            return redirect()->route('login')->with('error', 'Renseignez le bon email ou mot de passe.');
        }
        if(auth()->attempt(array('email'=>$input['email'], 'password'=>$input['password']))){
            if(auth()->user()->stagiaire==5){
                return redirect()->route('stagiaire.home');
            }else{
                return redirect()->route('home');
            }
        }else{
            return redirect()->route('login')->with('error', 'Renseignez le bon email ou mot de passe.');
        }

    }
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect()->route('login');
    }

}
