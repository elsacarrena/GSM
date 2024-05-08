<?php

namespace App\Http\Controllers\Auth;
use App\Models\User;
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

        $findUserByEmail= User::where('email',$request->email )->first();


        $etat_compte= $findUserByEmail->etat_compte;

        if($etat_compte==1){
            if(auth()->attempt(array('email'=>$input['email'], 'password'=>$input['password']))){
            // dd(auth()->user()->is_admin);
                //dd($etat_compte);

                $user_role=auth()->user()->is_admin;
                if(auth()->user()->first_login == 0){
                    auth()->user()->update([
                        'first_login' => 1,
                    ]);
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
                }elseif(auth()->user()->first_login == 1){
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
                }
            }
            else{
                return redirect()->route('login')->with('error', 'Renseignez le bon email ou mot de passe.');
            }
        }
        else{
            return redirect()->route('login')->with('error', "Votre compte n'est pas activé ou n'existe pas.Consultez vos mails");
        }
    }
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect()->route('login');
    }

}
