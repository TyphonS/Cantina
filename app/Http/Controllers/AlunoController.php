<?php

namespace App\Http\Controllers;

use App\Models\Cantina;
use App\Models\Responsavel;
use App\Models\Aluno;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlunoController extends Controller
{
    function check(Request $request){
        $input = $request->all();
        $request->validate([
            'emailaluno'=>'required|email',
            'passwordaluno'=>'required|min:5|max:30'
        ]);
        $id_cantina = Session::get('data.id');
        $dataA = Aluno::where('id_cantina',$id_cantina)->where('email',$input['emailaluno'])->where('status','ATIVO')->get();

        foreach ($dataA as $dataresa){
            if($dataresa->email === $input['emailaluno']){
            // echo($data);
            Session::put('dataA',[ 'nome' => $dataresa->nome,'turma'=>$dataresa->turma,'turno'=>$dataresa->turno,'tel'=>$dataresa->tel,'email'=>$dataresa->email,'password'=>$dataresa->password,'id_responsavel'=>$dataresa->id_responsavel,'id'=>$dataresa->id,'saldo'=>$dataresa->saldo,'status'=>$dataresa->status]);
            }
        }
        //$creds = $request->only('emailadm','password');
        $emailaluno = Session::get('dataA.email');
        $status_aluno = Session::get('dataA.status');
        //$passwordcantina = Session::get('data.password');
//
        if( $input['emailaluno'] === $emailaluno && $status_aluno==='ATIVO'){

           // $dataCantina = Cantina::where('emailadm',$emailadm)->where('password',$passwordcantina)->get();

            
                if(Auth::guard('aluno')->attempt(array('email'=>$input['emailaluno'],'password'=>$input['passwordaluno']))){
                    return redirect()->route('aluno.painel');
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
        Auth::guard('aluno')->logout();
        return redirect()->route('aluno.cantinasu');
    }
}
