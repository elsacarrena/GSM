<?php



namespace App\Http\Controllers\Auth;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Notifications\RegisteredUser;

use Illuminate\Auth\Events\Registered;
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

    public function confirm($id, $token) {
        $user = User::where('id', $id)->where('confirmation_token', $token)->first();

        if ($user) {
            $user->update(['confirmation_token' => null]);
             $this->guard()->login($user);
             return redirect($this->redirectPath())->with('Votre compte à été bien confirmé');
            return redirect('/login')->with('success', 'Votre compte est activé. Vous pouvez à présent vous connecter.');
        } else {
            return redirect('/login')->with('error', 'Ce lien ne semble plus valide.');
        }
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));
        $user->notify(new RegisteredUser());

        return redirect('/login')->with('success', 'Votre compte a été bien créé, vous devez le confirmer avec le mail que vous recevrez');

        // if ($response = $this->registered($request, $user)) {
        //     return $response;
        // }

        // return $request->wantsJson()
        //             ? new JsonResponse([], 201)
        //             : redirect($this->redirectPath());
    }




    // public function register(Request $request)
    // {
    //     $this->validator($request->all())->validate();

    //     $user = $this->create($request->all());
    //     //$user->notify(new RegisteredUser());

    //     if($user){
    //         return redirect()->route('login')->with('success','Votre compte a été bien créé, vous devez le confirmer avec le mail que vous recevrez');
    //     } else {
    //         return redirect()->route('register')->with('error', 'Veuillez réessayer.');
    //     }
    // }

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

