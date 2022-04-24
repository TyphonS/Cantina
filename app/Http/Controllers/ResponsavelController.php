<?php

namespace App\Http\Controllers;

use App\Models\Cantina;
use App\Models\Responsavel;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResponsavelController extends Controller
{
    function check(Request $request){
        $input = $request->all();
        $request->validate([
            'emailresponsavel'=>'required|email',
            'passwordresponsavel'=>'required|min:5|max:30'
        ]);
        $id_cantina = Session::get('data.id');
        $dataR = Responsavel::where('id_cantina',$id_cantina)->where('email',$input['emailresponsavel'])->get();

        foreach ($dataR as $datares){
            if($datares->email === $input['emailresponsavel']){
            // echo($data);
            Session::put('dataR',[ 'nome' => $datares->nome,'tel'=>$datares->tel,'cpf'=>$datares->cpf,'email'=>$datares->email,'password'=>$datares->password,'status'=>$datares->status,'id'=>$datares->id]);
            }
        }
        //$creds = $request->only('emailadm','password');
        $emailadm = Session::get('dataR.email');
        //$passwordcantina = Session::get('data.password');
//
        if( $input['emailresponsavel'] === $emailadm){

           // $dataCantina = Cantina::where('emailadm',$emailadm)->where('password',$passwordcantina)->get();

            
                if(Auth::guard('responsavel')->attempt(array('email'=>$input['emailresponsavel'],'password'=>$input['passwordresponsavel']))){
                    return redirect()->route('responsavel.painel');
                }else{
                    return redirect()->back()->with('falha','E-mail ou senha incorretas');
                    //echo($emailadm.$input['passwordresponsavel'].$input['emailresponsavel']);
                }
                
        }else{
            return redirect()->back()->with('falha','E-mail ou senha incorretas');
            //echo($emailadm.$input['passwordresponsavel'].$input['emailresponsavel']);
            //echo($emailadm);
           // echo($passwordcantina);
           // echo($input['emailcantina']);
           // echo($input['passwordcantina']);
       }
    }

    function sair(){
        Auth::guard('responsavel')->logout();
        return redirect()->route('responsavel.cantinasu');
    }
}
