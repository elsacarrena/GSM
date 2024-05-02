<?php

//namespace App\Http\Controllers\Auth;

//use App\Models\User;
//use Illuminate\Support\Str;
//use Illuminate\Http\Request;
//use App\Http\Controllers\Controller;
//use Illuminate\Support\Facades\Hash;
//use Illuminate\Support\Facades\Validator;
//use Illuminate\Foundation\Auth\RegistersUsers; -->

//class RegisterController extends Controller
//{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    //use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    //protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('guest');
    // }

    // public function registrer(Request $request)
    // {
    //     protected function validator(array $data){

    //         return Validator::make($data, [
    //             'name' => ['required', 'string', 'max:255'],
    //             'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
    //              'password' => ['required', 'string', 'min:8', 'confirmed'],
    //          ]);
    //     }


    //     protected function create(array $data){

    //     return User::create([
    //          'name' => $data['name'],
    //          'email' => $data['email'],
    //         'password' => Hash::make($data['password']),
    //          'confirmation_token'=>Str::random(60),
    //     ]);
    // }
    //         return view('auth/login')->with( 'success','Votre compte a été bien créé, vous devez le confirmer avec le mail que vous recevrez');
    //     }
    //     else{
    //     return redirect()->route('register')->with('erreur', 'Veuillez réessayer.');
    //     }
    // }


//





namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Notifications\RegisteredUser;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function confirm($id, $token){
        $user = User::where('id',$id)->where('confirmation_token', $token)->first();
        if($user){
            $user->update(['confirmation_token' => null]);
            $this->guard()->login($user);
            return redirect()->route('login')->with('error','Ce lien ne semble plus valide');

        }else{
            return redirect($this->redirectPath())->with('success','Votre compte a été bien confirmé');

        }
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $user = $this->create($request->all());
        //$user->notify(new RegisteredUser());

        if($user){
            return redirect()->route('login')->with('success','Votre compte a été bien créé, vous devez le confirmer avec le mail que vous recevrez');
        } else {
            return redirect()->route('register')->with('error', 'Veuillez réessayer.');
        }
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'confirmation_token' => Str::random(60),
        ]);
    }
}

