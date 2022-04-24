<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cantina;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    function index(){
        return view('dashboards.admins.index');
    }

    function profile(){
        return view('dashboards.admins.profile');
    }
    
    function settings(){
        return view('dashboards.admins.settings');
    }
    function logout(){
        Auth::logout();
        return redirect('/')->with('success','Cantina criada com sucesso');
    }
    function register(Request $request){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:cantinas'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'cnpj' => ['required','max:18','min:18'],
            'tel'=> ['required','max:14'],
            'endereco' => ['required', 'string', 'max:255'],
            'emailadm' => ['required', 'string', 'email', 'max:255', 'unique:cantinas'],
            'sobrenos' => ['required', 'string', 'max:255'],
            
        ],[
            'cnpj.min' => 'O CNPJ deve possuir 18 dígitos',
            'tel.max'=> 'O tel deve possuir 14 digitos'
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

        if($cantina->save()){
            //session()->flash('success','Cantina criada com sucesso');
            return redirect('/logout');
            
        }else{
            return redirect()->back()->with('fail','Não foi possivel cadastrar cantina');
        }
    }
    
}
