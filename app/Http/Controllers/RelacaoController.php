<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\Cantina;
use App\Models\Consumo;
use App\Models\Deposito;
use App\Models\HistoricoConsumo;
use App\Models\HistoricoDeposito;
use App\Models\Produto;
use App\Models\Produtoblo;
use App\Models\Responsavel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Session;

class RelacaoController extends Controller
{
    public function index(){
        $id_cantina = Session::get('data.id');
        $produtos = Produto::where('id_cantina',$id_cantina)->get();
        //$aluno = Aluno::where('id_cantina',$id_cantina)->get();
        $alun = Aluno::join('responsavels as r','alunos.id_responsavel','=','r.id')
                       ->select('alunos.*','r.nome as r_nome','r.password as r_senha')->where('alunos.id_cantina','=',$id_cantina)->where('alunos.status','=','ATIVO')->get();                      
        $responsavel = Responsavel::where('id_cantina',$id_cantina)->where('status','ATIVO')->get();
        return view('dashboards.cantina.logistica',compact('produtos','responsavel','alun'));
        
    }

    public function indexResp(){
        $id_resp = Session::get('dataR.id');
        $id_cantina = Session::get('data.id');
        $dependentes = Aluno::where('id_responsavel',$id_resp)->where('status','ATIVO')->get();
        $produtos = Produto::where('id_cantina',$id_cantina)->where('bloqueado',0)->get();
        $consumo = Consumo::join('alunos as al','consumos.id_aluno','=','al.id')
                            ->select('consumos.*','al.nome as al_nome')->where('consumos.id_responsavel',$id_resp)->get();
         $deposito = Deposito::join('alunos as al','depositos.id_aluno','=','al.id')
                                ->select('depositos.*','al.nome as al_nome')->where('depositos.id_responsavel',$id_resp)->get();                   
        
        //$prod_aluno = Produtoblo::join('produtos as p','produtoblos.id_produto','=','p.id')
        //                         ->select('p.id as p_id','p.nome as p_nome','produtoblos.*')->where('p.id','=',4)->get();
        $prod_aluno = Produtoblo::where('statusblo','BLOQUEADO')->get();
        if(count($prod_aluno) != 0){
           // $prod_aluno = $produtos;
           $prod_aluno = Produto::whereNotIn('produtos.id',function($q){
               $q->selectRaw("produtoblos.id from produtoblos");
           })->get();
           //join('produtoblos as p','=','produtos.id')->select('produtos.id as p_id','produtos.nome as p_nome')->whereNotIn('p.id','=',$produtos[0]->id)->get();
        }else{
            $prod_aluno = Produtoblo::join('produtos as p','produtoblos.id_produto','=','p.id')
            ->select('p.id as p_id','p.nome as p_nome','produtoblos.*')->whereNotIn('produtoblos.id_produto','p.id')->get();
        }
        //$aluno = Aluno::where('id_cantina',$id_cantina)->get();
        //$alun = Aluno::join('responsavels as r','alunos.id_responsavel','=','r.id')
                      // ->select('alunos.*','r.nome as r_nome','r.password as r_senha')->where('alunos.id_cantina','=',$id_cantina)->get();                      
        //$responsavel = Responsavel::where('id_cantina',$id_cantina)->where('status','ATIVO')->get();
        return view('dashboards.responsavel.painelresponsavel',compact('dependentes','produtos','prod_aluno','consumo','deposito'));
    }
    public function indexAlu(){
        $id_alu= Session::get('dataA.id');
        $id_cantina = Session::get('data.id');

        $produtosAluno = Produto::where('id_cantina',$id_cantina)->where('bloqueado',0)->get();

        return view('dashboards.aluno.alunopainel',compact('produtosAluno'));
    }

  
    public function cadastrar(Request $request){
        $input= $request->all();
        $id_cantina = Session::get('data.id');

        if($input['namecomida'] !=  ""){

            $request->validate([
                'qtecomida' => ['required', 'integer'],
                'namecomida' => ['required', 'string'],
                'ingredientescomida' => ['required', 'string'],
                'precocomida' => ['required']
            ]);
            if($request->file('imagemcomida') != null){
                $name_foto_comida = $request->file('imagemcomida')->getClientOriginalName();
                $request->file('imagemcomida')->storeAs('public/img/',$name_foto_comida);
            }else{
                $name_foto_comida = 'semimagem.png';  
            }
            

            $prod = new Produto();
            $prod->nome = $request->namecomida;
            $prod->preco = $request->precocomida;
            $prod->tipo = "Comida";
            $prod->qte = $request->qtecomida;
            $prod->imagem = $name_foto_comida;
            $prod->ingredientes = $request->ingredientescomida;
            $prod->fornecedor = null;
            $prod->bloqueado = 1;
            $prod->id_cantina = $id_cantina;

            if($prod->save()){
                //echo('oiii');
                session()->flash('success','Produto cadastrado com sucesso');
                return redirect()->back();
            }

        }elseif($input['namebebida'] != ""){

            $request->validate([
                'qtebebida' => ['required', 'integer'],
                'namebebida' => ['required', 'string'],
                'fornecedorbebida' => ['required', 'string'],
                'precobebida' => ['required'],
                
            ]);
            if($request->file('imagembebida') != null){
                $name_foto_bebida = $request->file('imagembebida')->getClientOriginalName();
                $request->file('imagembebida')->storeAs('public/img/',$name_foto_bebida);
            }else{
                $name_foto_bebida = 'semimagem.png';
            }
            

            $prod = new Produto();
            $prod->nome = $request->namebebida;
            $prod->preco = $request->precobebida;
            $prod->tipo = "Bebida";
            $prod->qte = $request->qtebebida;
            $prod->imagem = $name_foto_bebida;
            $prod->ingredientes = null;
            $prod->fornecedor = $request->fornecedorbebida;
            $prod->bloqueado = 1;
            $prod->id_cantina = $id_cantina;

            if($prod->save()){
                //echo('oiii');
                session()->flash('success','Produto cadastrado com sucesso');
                return redirect()->back();
            }
        }
    }


    function cadastrarAlu(Request $request){
        $input= $request->all();
        $id_cantina = Session::get('data.id');
        $id_resp = Session::get('dataR.id');

            $request->validate([
                'turmaaluno' => ['required', 'string'],
                'turnoaluno' => ['required', 'string'],
                'nomealuno' => ['required', 'string'],
                'telaluno' => ['required','string'],
                'email' => ['required','email','unique:alunos'],
                'passwordaluno' => ['required'],

            ]);

            if($request->file('imagemaluno') != null){
                $name_foto_aluno= $request->file('imagemaluno')->getClientOriginalName();
                $request->file('imagemaluno')->storeAs('public/img/',$name_foto_aluno);
            }else{
                $name_foto_aluno = 'avatar.png';
            }

            
            $alu = new Aluno();
            $alu->nome = $request->nomealuno;
            $alu->turma = $request->turmaaluno;
            $alu->turno = $request->turnoaluno;
            $alu->tel = $request->telaluno;
            $alu->email = $request->email;
            $alu->password = Hash::make($request->passwordaluno);
            $alu->id_cantina = $id_cantina;
            $alu->id_responsavel = $id_resp;
            $alu->saldo = 0;
            $alu->status = 'ATIVO';
            $alu->imagem = $name_foto_aluno;

            if($alu->save()){
                //echo('oiii');
                session()->flash('success','Dependente cadastrado com sucesso');
                return redirect()->back();
            }
    }

    function excluir($id){

        $foto_del = Produto::find($id);
        if($foto_del->imagem == 'semimagem.png'){

        }else{
            Storage::delete('public/img/'.$foto_del->imagem);
        }
        
        Produto::find($id)->delete();
        
        session()->flash('success','Produto excluído com sucesso');
        return redirect()->back();
    }


    function editar($id){
        
        $prodedit = Produto::find($id);
        return response()->json([
            'status'=>200,
            'produto'=>$prodedit,
        ]);
        
    }

    function carrinho($id,$aluno){
        $prodinfo = Produto::find($id);
        
        return response()->json([
            'status'=>200,
            'produto'=>$prodinfo,
            'aluno'=>$aluno,
        ]);
    }

    function colocar(Request $request){
        $ola = $request->input('produtocart');
        $id_alun = $request->input('carrinho_aluno');
       

        if($ola != null){
            foreach($ola as $ol){
                if($request->input($ol)){
                    $quantidade_pedida = $request->input($ol);
                    $ku = Produto::find($ol);
                    $alu = Aluno::find($id_alun);

                    if($quantidade_pedida[0] > $ku->qte){
                        session()->flash('fail','O produto '.$ku->nome.' possui apenas '.$ku->qte.' unidades em estoque!');
                        return redirect()->back();
                    }else{
                        $historico = new Consumo();
                        $historico->produto_id = $ol;
                        $historico->nome = $ku->nome;
                        $historico->qte = $quantidade_pedida[0];
                        $historico->preco = ($quantidade_pedida[0] * $ku->preco);
                        $historico->dataP = date('Y-m-d');
                        $historico->id_aluno = $id_alun;
                        $historico->id_responsavel = $alu->id_responsavel;
                        

                        $novo_qte = ($ku->qte - $quantidade_pedida[0]);
                        $ku->qte = $novo_qte;
                        

                        $preco_total= ($quantidade_pedida[0] * $ku->preco);
                        $saldo =  $alu->saldo; 
                        $novo_saldo = ($saldo - $preco_total);

                        if($novo_saldo<0){
                            session()->flash('fail','Saldo insuficiente');
                            return redirect()->back();
                        }else{
                            
                            $alu->saldo = $novo_saldo;
                            if($historico->save()){
                                $alu->save();
                                $ku->save();
                            }
                            

                            
                        }

                        
                        
                    }
                    /*echo("Produto: ".$ku->nome);
                    echo("Qte: ".$ku->qte);
                    echo("Qte pedida: ".$quantidade_pedida[0]); */
                }
                
            }
            session()->flash('success','Compra realizada com sucesso');
            return redirect()->back();
        }else{
            session()->flash('fail','Compra realizada com sucesso');
            return redirect()->back();
        }
       
        
        /*
        for($i=0;$i<$ka;$i++){
            echo($ola[$i]);
        } */
    }

   /* function editaracao2(Request $request, $id){
        $input = $request->all();
        $request->validate([
            'qteeditar' => ['required', 'integer'],
            'nomeeditar' => ['required', 'string'],
            'precoeditar' => ['required'],
        ]);
        
        if($input['fornecedorbebidaeditar'] != ""){
            $request->validate([
                'fornecedorbebidaeditar' => ['required', 'string'],
            ]);
        }elseif($input['ingredienteeditar'] != ""){
            $request->validate([
                'ingredienteeditar' => ['required', 'string'],
            ]);

            $qte = $request->qteeditar;
            $nome = $request->nomeeditar;
            $preco = $request->precoeditar;
            $ingrediente = $request->ingredienteeditar;

            Produto::find($id)->update(['nome'=> $nome,'preco'=>$preco,'qte'=>$qte,'ingredientes'=>$ingrediente]);

            session()->flash('success','Produto editado com sucesso');
            return redirect()->back();

        }
    } */

    function editaracao(Request $request){
        $prod_id = $request->input('prod_id');

        $prod = Produto::find($prod_id);

        if($request->file('imagem-editar') != null){
            $name_foto = $request->file('imagem-editar')->getClientOriginalName();
            $request->file('imagem-editar')->storeAs('public/img/',$name_foto);
            $prod->imagem = $name_foto;
        }else{
            
        }
        
        
        $prod->nome = $request->input('nomeeditar');
        $prod->preco = $request->input('precoeditar');
        $prod->tipo = $request->input('tipo_prod');
        $prod->qte = $request->input('qteeditar');
        $prod->ingredientes = $request->input('ingredienteeditar');
        $prod->fornecedor = $request->input('fornecedorbebidaeditar');
        $prod->update();

        session()->flash('success','Produto editado com sucesso');
        return redirect()->back();
    }

    function done($id){
        $t = Produto::find($id);
        if($t){
            $t->bloqueado = 1 - $t->bloqueado;
            $t->save();
        }
        
        
        
        return redirect()->back();
    }

    function cadastrarResp(Request $request){
        $id_cantina = Session::get('data.id');

            $request->validate([
                'cpfresp' => ['required', 'string'],
                'nomeresp' => ['required', 'string'],
                'telresp' => ['required', 'string'],
                'email' => ['required','email','unique:responsavels'],
                'passwordresp' => ['required'],
            ]);
            
            $resp = new Responsavel();
            $resp->cpf = $request->cpfresp;
            $resp->nome = $request->nomeresp;
            $resp->tel = $request->telresp;
            $resp->email = $request->email;
            $resp->password = Hash::make($request->passwordresp);
            $resp->status= "ATIVO";
            $resp->id_cantina = $id_cantina;

            if($resp->save()){
                //echo('oiii');
                session()->flash('success','Responsável cadastrado com sucesso');
                return redirect()->back();
            }
        }

        function excluirResp($id){

            $r = Responsavel::find($id);
            if($r){
                $r->status = 'INATIVO';
                $r->save();
            }

            session()->flash('success','Produto excluído com sucesso');
            return redirect()->back();
        }

        function excluirAluno($id){
            $p = Aluno::find($id);
            if($p){
                $p->status = 'INATIVO';
                $p->save();
            }

            session()->flash('success','Dependente excluído com sucesso');
            return redirect()->back();
        }

        function editarResp($id){
            
            $respedit = Responsavel::find($id);

            return response()->json([
                'status'=>200,
                'responsavel'=>$respedit,
            ]);
        }

        function testando($id){

            $prod_al = Produtoblo::where('id_aluno',$id)->get();

            $alun = Produto::join('produtoblos as blo','produtos.id','=','blo.id_produto')
                       ->select('produtos.*','blo.id_aluno as blo_idaluno','blo.statusblo as blo_status')
                       ->where('blo.id_aluno','=',$id)->where('produtos.bloqueado',0)->get();
            
            $alun2 = Produto::select('id','nome')->whereNotIn('id',DB::table('produtoblos')->select('id_produto')->where('id_aluno','=',$id))->get();
            $alun3 = Produto::with('produtoblos')->get();
            $alun4 = Produto::join('produtoblos as blo','produtos.id','=','blo.id_produto')
                                ->select('produtos.*','blo.id_aluno as blo_idaluno','blo.statusblo as blo_status')
                                ->where('produtos.bloqueado',0)->where('blo.id_aluno',$id)->get();

            return response()->json([
                'status'=>200,
                'produtoal' =>$alun4,
            ]);
        }

        function bloquearpaluno(Request $request){
            $produto_aluno = $request->produto_doaluno;
            $id_doaluno = $request->id_doaluno;

            $prod_blo = Produtoblo::find($produto_aluno)->where('id_aluno',$id_doaluno)->get();
            
                $prod = new Produtoblo();
                $prod->id_aluno = $id_doaluno;
                $prod->id_produto = $produto_aluno;
                $prod->statusblo = 'BLOQUEADO';
                $prod->save();

                echo($prod->id_aluno);
                echo($prod->id_produto);
               /* if($prod->save()){
                    session()->flash('success','Produto bloqueado com sucesso');
                    return redirect()->back();
                }else{

                } */
                
            
        }

        function editarAluno($id){
            $aluedit = Aluno::find($id);

            return response()->json([
                'status'=>200,
                'aluno'=>$aluedit,
            ]);
        }

        function editaracaoresp(Request $request){
            $resp_id = $request->input('resp_id');
            $request->validate([
                'cpfeditarresp' => ['required', 'string'],
                'nomeeditarresp' => ['required', 'string'],
                'teleditarresp' => ['required', 'string'],
                'emaileditarresp' => ['required','email'],
            ]);
            $resp = Responsavel::find($resp_id);

            $resp->cpf = $request->input('cpfeditarresp');
            $resp->nome = $request->input('nomeeditarresp');
            $resp->tel = $request->input('teleditarresp');
            $resp->email = $request->input('emaileditarresp');
            if($request->input('senhaeditarresp') != ""){
                $resp->password = Hash::make($request->input('senhaeditarresp'));
            }
            $resp->update();

            session()->flash('success','Responsável editado com sucesso');
            return redirect()->back();
        }
        
        function editaracaoaluno(Request $request){
            $alu_id = $request->input('alu_id');
            
            $request->validate([
                'turmaalunoedit' => ['string'],
                'turnoalunoedit' => ['string'],
                'nomealunoedit' => ['string'],
                'email' => ['email'],

            ]);
            $resp = Aluno::find($alu_id);
            
            if($request->file('imagemalunoeditar') != null){
                $name_foto_alunoe = $request->file('imagemalunoeditar')->getClientOriginalName();
                $request->file('imagemalunoeditar')->storeAs('public/img/',$name_foto_alunoe);
                $resp->imagem = $name_foto_alunoe;
            }else{
                
            }

            
            

            $resp->turma = $request->input('turmaalunoedit');
            $resp->turno = $request->input('turnoalunoedit');
            $resp->nome = $request->input('nomealunoedit');
            $resp->tel = $request->input('telalunoedit');
            $resp->email = $request->input('email');
            
            if($request->input('passwordalunoedit') != ""){
                $resp->password = Hash::make($request->input('passwordalunoedit'));
            }
            $resp->update();

            session()->flash('success','Dependente editado com sucesso');
            return redirect()->back();
        }

        function depositar($id){
            $aluno = Aluno::find($id);

            return response()->json([
                'status'=> 200,
                'aluno'=>$aluno,
            ]);
        }

        function depositaracao(Request $request){
            $request->validate([
                'deposito' => ['required']
            ]);

            $alu_dep = Aluno::find($request->input('deposito_alu_id'));
            $deposito = $request->input('deposito');
            $id_responsavel = $request->input('resp_deposito_id');
            

            if($alu_dep){
                $alu_dep->saldo = ($alu_dep->saldo + $request->input('deposito'));
                $alu_dep->save();

                $dep = new Deposito();
                $dep->deposito = $deposito;
                $dep->saldo = $alu_dep->saldo;
                $dep->id_responsavel = $id_responsavel;
                $dep->id_aluno = $alu_dep->id;
                $dep->dataD = date('Y-m-d H:i:s');
                $dep->save();

            }

            session()->flash('success','Depósito enviado com sucesso');
            return redirect()->back();
        }

        function exportar($id){
            $depos = Deposito::join('alunos as al','depositos.id_aluno','=','al.id')
                                ->select('depositos.*','al.nome as al_nome')->where('depositos.id_responsavel',$id)->get();

         //$depos = Deposito::where('id_responsavel',$id)->get();
            $arquivo = 'depositos.xls';

            $html ='';
            $html .= '<table border="1">';
            $html .= '<tr class="header">';
            $html .= '<th scope="col">Nome</th>';
            $html .= '<th scope="col">Data</th>';
            $html .= '<th scope="col">Deposito</th>';
            $html .= '<th scope="col">Saldo</th>';
            $html .= '</tr>';

            foreach($depos as $deposito){
                $html .= '<tr>';
                $html .= '<td>'.$deposito->al_nome.'</td>';
                $html .= '<td>'.$deposito->dataD.'</td>';
                $html .= '<td>'.$deposito->deposito.'</td>';
                $html .= '<td>'.$deposito->saldo.'</td>';
                $html .= '</tr>';
            }

            $html .= '</table>'; 

            
            header("Expires:0");
            header("Last-Modified: " . gmdate("D,d M YH:i:s") . "GMT");
            header("Cache-Control: no-cache, must-revalidate");
            header('Content-Transfer-Encoding: binary');
            header("Pragma: public");
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header("Content-Disposition: attachement; filename=\"{$arquivo}\"");
            header("Content-Description: PHP Generated Data");

            echo $html;

        }
}
