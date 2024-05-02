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
            // dd(auth()->user()->is_admin);
            $user_role=auth()->user()->is_admin;
            switch($user_role){
                case 1:
                    return redirect()->route('admin.home');
                    break;
                case 2:
                    return redirect()->route('superieur.home');
                    break;
                case 3:
                    return redirect()->route('chefservice.home');
                    break;
                case 4:
                    return redirect()->route('employe.home');
                    break;
                case 5:
                    return redirect()->route('stagiaire.home');
                    break;
                default:
                   
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
