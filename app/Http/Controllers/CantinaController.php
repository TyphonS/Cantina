<?php

namespace App\Http\Controllers;

use App\Models\Cantina;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CantinaController extends Controller
{
    /* Função responsável por trazer as informações da cantina digitada na página inicial */
    public function inicio(Request $request){
       
        $nome = $request->cantinanome;

        $data = Cantina::join('responsavels as r','cantinas.id','=','r.id_cantina')
                       ->join('alunos as a','cantinas.id','=','a.id_cantina')
                       ->select('cantinas.*')->where('cantinas.name','=',$nome)->get();

        $data3 = Cantina::where('name',$nome)->get();

        if(count($data) != 0){
           Session::put('data',[ 'name' => $nome,'tel'=>$data[0]->tel,'sobrenos'=>$data[0]->sobrenos,'endereco'=>$data[0]->endereco,'emailadm'=>$data[0]->emailadm,'password'=>$data[0]->password,'id'=>$data[0]->id]);
           return view('cantinahome',[
               'data' => $data
            ]);
        }elseif(count($data) == 0 && count($data3) != 0){
            $data2 = Cantina::join('responsavels as r','cantinas.id','=','r.id_cantina')
                              ->select('cantinas.*')->where('cantinas.name','=',$nome)->get();
                              
             if(count($data2) !=0 ){

             }else{
                 $data2 = $data3;
             }                 
  
            Session::put('data',[ 'name' => $nome,'tel'=>$data2[0]->tel,'sobrenos'=>$data2[0]->sobrenos,'endereco'=>$data2[0]->endereco,'emailadm'=>$data2[0]->emailadm,'password'=>$data2[0]->password,'id'=>$data2[0]->id]);
            return view('cantinahome',[
                'data' => $data2
            ]);
           
        }else{
            return redirect()->back()->with("falha","Cantina não encontrada");
            
        }

    }
    public function check(Request $request){
        $input = $request->all();
        $request->validate([
            'emailcantina'=>'required|email',
            'passwordcantina'=>'required|min:5|max:30'
        ]);

        $emailadm = Session::get('data.emailadm');
        $passwordcantina = Session::get('data.password');

        if( $input['emailcantina'] === $emailadm){
                if(Auth::guard('cantina')->attempt(array('emailadm'=>$input['emailcantina'],'password'=>$input['passwordcantina']))){
                    return redirect()->route('cantina.logistica');
                }else{
                    return redirect()->back()->with('falha','E-mail ou senha incorretas');
                    
                }         
        }else{
            return redirect()->back()->with('falha','E-mail ou senha incorretas');          
       }
           
    }

    function sair(){
        Auth::guard('cantina')->logout();
        return redirect()->route('cantina.cantinasu');
    }
}
