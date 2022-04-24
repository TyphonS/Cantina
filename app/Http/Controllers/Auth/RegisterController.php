<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Cantina;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class RegisterController extends Controller
{
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

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:cantinas'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
   /* protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'role'=> 2,
            'password' => Hash::make($data['password']),
        ]);
    }*/

    function register(Request $request){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:cantinas'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'cnpj' => ['required'],
            'tel'=> ['required'],
            'endereco' => ['required', 'string', 'max:255'],
            'emailadm' => ['required', 'string', 'email', 'max:255', 'unique:cantinas'],
            'sobrenos' => ['required', 'string', 'max:255'],
            
        ]);

        $cantina = new Cantina();
        $cantina->name = $request->name;
        $cantina->email = $request->email;
        $cantina->password = Hash::make($request->password);
        $cantina->cnpj = $request->cnpj;
        $cantina->tel = $request->tel;
        $cantina->endereco = $request->endereco;
        $cantina->emailadm = $request->emailadm;
        $cantina->sobrenos = $request->sobrenos;

        $listCantina = Cantina::get();

        if($cantina->save()){
            Auth::logout();
            //return view('/cantina',['listacantina' => $listCantina]);
        }else{
            return redirect()->back()->with('error','Não foi possivel cadastrar');
        }
    }
}
