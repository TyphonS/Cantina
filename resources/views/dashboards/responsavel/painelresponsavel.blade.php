<!doctype html>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../../css/style-config.css">    
    <link rel="stylesheet" href="../../css/cards.css">  
    <link rel="stylesheet" href="../../css/logistica.css"> 
    <link rel="stylesheet" href="../../css/app.css">
    <link rel="stylesheet" href="../../js/app.js">
    <script type="text/javascript"> 
     function muda() {
        var opcaoValor = document.getElementById("seletor").options[document.getElementById("seletor").selectedIndex].value;
        if( opcaoValor === "1"||opcaoValor === "2"||opcaoValor === "3"){
            document.getElementById("caneta2").style.display="none";
            document.getElementById("caneta").style.display="block";   
        }
        
    }
    function Tipo(){
      var Valor_select = document.getElementById("Prod-tipo").options[document.getElementById("Prod-tipo").selectedIndex].value;
      if( Valor_select === "1"){
            document.getElementById("Prod-bebida").style.display="none";
            document.getElementById("Prod-comida").style.display="block";
        }else if(Valor_select === "2"){
            document.getElementById("Prod-comida").style.display="none";
            document.getElementById("Prod-bebida").style.display="block";
        }else if(Valor_select === "0"){
            document.getElementById("Prod-comida").style.display="none";
            document.getElementById("Prod-bebida").style.display="none";
        }
    }
    
    
    </script>
    <title>Cantina</title>
  </head>
  <body>
    <div class="content">
        <div class="topo">
          <div class="topo-interno">
              <div class="logomarca">
                <a href=""><img src="../../img/logo.PNG" width="100" height="100" alt=""></a>
              </div>
              <div class="menu">
                  <ul>
                    <li>Cantina: {{Session::get('data.name')}}</li>
                    <li>Bem vindo(a) {{ Auth::guard('responsavel')->user()->nome}}</li>
                    <a href="{{route('responsavel.sair')}}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><img src="../../img/logout.png" width="35" height="35" alt=""></a>
                        <form action="{{route('responsavel.sair')}}" method="POST" class="d-none" id="logout-form">@csrf</form>
                  </ul>
              </div>
          </div>
        </div>
        <div class="container">
            <div id="log-conteudo">
                @if (Session::get('success'))
                  <div x-data="{show: true}" x-init="setTimeout(() => show = false, 4000)" x-show="show" class="alert alert-success " style="display: block; position: fixed; top: 0; left: 20%; right: 20%; width: 60%; padding-top: 10px;margin-top:15px; z-index: 9999">
                    {{Session::get('success')}}
                    <button onclick="$('.alert').alert('close')" type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  
                @endif
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                      <button class="nav-link active bestilo" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true"><img src="../../img/alunos.png" width="100"><br>Meus<br>Dependentes</button>
                    </li>
                    <li class="nav-item" role="presentation">
                      <button class="nav-link bestilo" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false"><img src="../../img/block.png" width="100"><br>Bloquear<br>Produtos</button>
                    </li>
                    <li class="nav-item" role="presentation">
                      <button class="nav-link bestilo" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false"><img src="../../img/produtos2.png" width="100"><br>Histórico de<br>Consumo</button>
                    </li>
                    <li class="nav-item" role="presentation">
                      <button class="nav-link bestilo" id="pills-contact2-tab" data-bs-toggle="pill" data-bs-target="#pills-contact2" type="button" role="tab" aria-controls="pills-contact2" aria-selected="false"><img src="../../img/excel.png" width="100"><br>Extrato<br>Depósitos</button>
                    </li>
                  </ul>
                  <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        <div id="prod-content">
                            <div id="prod-item">
                                <!-- MODAL CADASTRAR DEPENDENTE-->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalCadastrar" data-bs-whatever="@mdo">Cadastrar</button>
                                
                                <div class="modal fade" id="exampleModalCadastrar" tabindex="-1" aria-labelledby="exampleModalLabelCadastrar" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabelCadastrar">Cadastrar Dependente</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body">
                                        <form method="POST" action="{{route('responsavel.cadastraraluno')}}" enctype="multipart/form-data">
                                          @csrf
                                          <div class="mb-1">
                                            <div class="row">
                                              <div class="col-sm-6">
                                                <input type="text" class="form-control" id="recipient-turma" name="turmaaluno" placeholder="Turma" required> <br>
                                              </div>
                                              <div class="col-sm-6">
                                                <input type="text" class="form-control" id="recipient-turno" name="turnoaluno" placeholder="Turno" required> <br>
                                              </div>
                                            </div>
                                            <input pattern="[A-Za-z].{2,}" title="Não é Permitido caractere especial no começo!" type="text" class="form-control" id="recipient-nome" name="nomealuno" placeholder="Nome" required> <br>
                                            <input onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="14" type="tel" class="form-control" id="tel_cantina" name="telaluno" placeholder="Telefone" > <br>
                                            <input type="email" class="form-control" id="recipient-email" name="email" placeholder="E-mail" > <br>
                                            <div class="col-sm">
                                              <label for="upload_imagem">Selecione uma imagem:</label>
                                              <input type="file" class="form-control hidden" name="imagemaluno" />
                                            </div>
                                          </div>
                                          <div class="mb-3">
                                            <label for="message-text" class="col-form-label">Acesso:</label>
                                            <input type="password" class="form-control" id="recipient-senha" name="passwordaluno" placeholder="Senha" required>
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                            <button type="submit" class="btn btn-primary">Cadastrar</button>
                                          </div>
                                        </form>
                                      </div>
                                      
                                    </div>
                                  </div>
                                </div>
                                <!--MODAL CADASTRAR DEPENDENTE-->
                            
                            <input type="text" id="myInput" onkeyup="Filtro_Produto()" placeholder="Pesquisar por nome" title="Type in a name">
                            <table id="myTable">
                                <tr class="header">
                                  <th scope="col">Imagem</th>
                                  <th scope="col">Matricula</th>
                                  <th scope="col">Nome</th>
                                  <th scope="col">Saldo</th>
                                  <th scope="col">Ação</th>
                                </tr>
                                @foreach($dependentes as $depen)

                                <tr>
                                    <td><img src="{{ asset('storage/img/'.$depen->imagem) }}" width="150" height="150" class="img-thumbnail" alt="..."></td>
                                    <td>{{$depen->id}} </td>
                                    <td>{{$depen->nome}}</td>
                                    <td>{{number_format($depen->saldo,2)}}</td>
                                    <td>
                                      <a href="{{ route('responsavel.delaluno',['id'=>$depen->id]) }}" onclick="return(confirm('Tem certeza que deseja excluir?'))"><img src="../../img/excluir.png" width="40" height="40" alt=""></a>
                                      
                                        <!-- MODAL EDITAR DEPENDENTE-->
                                        <button type="button" class="btn btn-primary bcor editalu" value="{{$depen->id}}"><img src="../img/editar.png" width="40" height="40" alt=""></button>
                                        
                                        <div class="modal fade" id="editar-aluno" tabindex="-1" aria-labelledby="editar-prod-label" aria-hidden="true">
                                          <div class="modal-dialog">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <h5 class="modal-title" id="editar-prod-label">Editar Dependente</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                              </div>
                                              <div class="modal-body">
                                                <form method="POST" action="{{route('responsavel.editaraluno')}}" enctype="multipart/form-data">
                                                  @csrf
                                                  @method('PUT')
                                                  <input type="hidden" name="alu_id" id="alu_id">
                                                  <div class="mb-1">
                                                    <div class="row">
                                                      <div class="col-sm-6">
                                                        <input type="text" class="form-control" id="recipient-turma-ed" name="turmaalunoedit" placeholder="Turma" required> <br>
                                                      </div>
                                                      <div class="col-sm-6">
                                                        <input type="text" class="form-control" id="recipient-turno-ed" name="turnoalunoedit" placeholder="Turno" required> <br>
                                                      </div>
                                                    </div>
                                                    <input pattern="[A-Za-z].{2,}" title="Não é Permitido caractere especial no começo!" type="text" class="form-control" id="recipient-nome-ed" name="nomealunoedit" placeholder="Nome" required> <br>
                                                    <input onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="14" type="tel" class="form-control" id="resp-tel-editar" name="telalunoedit" placeholder="Telefone" > <br>
                                                    <input type="email" class="form-control" id="recipient-email-ed" name="email" placeholder="E-mail" >
                                                    <div class="col-sm">
                                                      <label for="upload_imagem">Selecione uma imagem:</label>
                                                      <input type="file" class="form-control hidden" name="imagemalunoeditar" />
                                                    </div>
                                                  </div>
                                                  <div class="mb-3">
                                                    <label for="message-text" class="col-form-label">Acesso:</label>
                                                    <input type="text" class="form-control" id="recipient-senha-ed" name="passwordalunoedit" placeholder="Senha" >
                                                  </div>
                                                  <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                    <button type="submit" class="btn btn-primary">Editar</button>
                                                  </div>
                                                </form>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                        <!-- MODAL EDITAR DEPENDENTE-->

                                       <!-- MODAL DEPOSITAR -->
                                       <button type="button" class="btn btn-primary bcor depoaluno" value="{{$depen->id}}" ><img src="../../img/depositar.png" width="50" height="50" alt=""></button>

                                       <div class="modal fade" id="editar-dep" tabindex="-1" aria-labelledby="editar-ed-label" aria-hidden="true">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title" id="editar-ed-label">Depositar</h5>
                                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                              <form method="POST" action="{{route('responsavel.deposito')}}">
                                                @csrf
                                                <input type="hidden" name="deposito_alu_id" id="deposito_alu_id">
                                                <input type="hidden" name="saldo_alu_id" id="saldo_alu_id">
                                                <input type="hidden" name="resp_deposito_id" id="resp_deposito_id" value="{{Auth::guard('responsavel')->user()->id}}">
                                                <div class="mb-1">
                                                  <div class="row">
                                                    <div class="col-sm-4">
                                                      <input type="number" class="form-control" id="deposito-aluno" min="0" step="0.01" name="deposito" placeholder="Valor" required> <br>
                                                    </div>
                                                    <div class="col-sm-4">
                                                      <img src="../img/money.png" width="40" height="40" alt="">
                                                    </div>
                                                  </div>
                                                </div>
                                                <div class="modal-footer">
                                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                  <button type="submit" class="btn btn-primary">Depositar</button>
                                                </div>
                                              </form>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <!-- MODAL DEPOSITAR -->
                                    </td>
                                  </tr>
                                  @endforeach
                              </table>
                            </div>
                        </div>
                        
                    </div>
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <div id="prod-content">
                            <div id="prod-item">
                              <div class="row linhar"  >
                                <div class="col-sm-6">
                                  <select name="seletor" id="seletor" class="form-control" >
                                    <option value="" selected>Selecione o aluno</option>
                                    @foreach($dependentes as $depen)
                                      <option value="{{$depen->id}}">{{$depen->nome}}</option>
                                    @endforeach  
                                  </select>
                                </div>
                                <div class="col-sm-6">
                                  <input type="text" id="myInput_Resp" onkeyup="Filtro_Responsavel()" placeholder="Pesquisar por código" title="Type in a name">
                                </div>
                              </div>
                              <!--
                              <table id="myTable_Resp">
                                <tr class="header">
                                  <th scope="col">Imagem</th>
                                  <th scope="col">Produto</th>
                                  <th scope="col">Cód</th>
                                  <th scope="col">Preço</th>
                                  <th scope="col">Status</th>
                                  <th scope="col">Ação</th>
                                </tr>
                                @foreach($produtos as $prod)
                                <tr>
                                    <td><img src="" width="130" height="100" class="img-thumbnail" alt="..."></td>
                                    <td>{{$prod->nome}}</td>
                                    <td>{{$prod->id}}</td>
                                    <td>{{number_format($prod->preco,2)}}</td>
                                    <td>N/A</td>
                                    <td><button type="button" class="btn btn-danger">Bloquear</button></td>
                                </tr>
                              @endforeach 
                              </table>
                            -->
                            </div>
                              

                        </div>
                    </div>
 <!---- dsfgsrfgfsngerhj -->
 

 <div class="modal fade" id="testando-modal" tabindex="-1" aria-labelledby="editar-ed-label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" id="nomeal">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
        <label> Produtos Bloqueados:</label>
        <table class="table" id="myTable_teste">
          <tr class="header table-light">
            <!--<th scope="col">Imagem</th> -->
            <th scope="col">Cód</th>
            <th scope="col">Produto</th>
            <th scope="col">Status</th>
            <th scope="col">Ação</th>
          </tr>
          
        </table>
        <br><br>
        <label> Produtos Desbloqueados:</label>
          <table id="myTable_Resp">
            <tr class="header">
              <th scope="col">Imagem</th>
              <th scope="col">Produto</th>
              <th scope="col">Cód</th>
              <th scope="col">Preço</th>
              <th scope="col">Ação</th>
            </tr>
            
          @foreach($produtos as $prod)
         
            <form method="POST" id="aluno-form" action="{{route('responsavel.bloquearpaluno')}}">
              @csrf
            <tr>
                <td><img src="" width="130" height="100" class="img-thumbnail" alt="..."></td>
                <td>{{$prod->nome}}</td>
                <td>{{$prod->id}}</td>
                <td>{{number_format($prod->preco,2)}}</td>
                <input type="hidden"id="id_doaluno40" name="id_doaluno">
                <input type="hidden" name="produto_doaluno">
                <td id="testandoprod" style="display: none !important;">{{$prod->id}}</td>
                <td>
                  <button id="testandobloqueio2" type="submit" class="btn btn-danger">Bloquear</button>
                </td>
            </tr>
            </form>
            @endforeach 
            
          </table>
      </div>
    </div>
  </div>
</div>






 <!-- sdfnhfghbfdjuhbg -->



                    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                        <div id="prod-content">
                            <div id="prod-item">
                              <div class="row" style="margin-right: 0px !important;">
                                <div class="col-sm-4">
                                  <select name="seletor" id="seletorConsumo" class="form-control" >
                                    <option value="" selected>Selecione o aluno</option>
                                    @foreach($dependentes as $depen)
                                      <option value="{{$depen->nome}}">{{$depen->nome}}</option>
                                    @endforeach  
                                  </select>
                                </div>
                                <div class="col-sm-8">
                                  Periodo Inicial: <input type="date" max="{{date('Y-m-d');}}" id="data-ini"> Periodo Final <input type="date"  max="{{date('Y-m-d');}}" id="data-fim"> <button onclick="FiltroConsumo()">Buscar</button>
                                </div>
                              </div><br>
                              <label for=""> Produtos Consumidos: </label>
                            <table id="myTable_Consumo">
                                <tr class="header">
                                  <th scope="col">Dependente</th>
                                  <th scope="col">Data</th>
                                  <th scope="col">Produto</th>
                                  <th scope="col">Qte</th>
                                  <th>Valor</th>
                                </tr>
                                @foreach ( $consumo as $consu )
                                    
                                <tr>
                                  <td>{{$consu->al_nome}}</td>
                                  <td>{{$consu->dataP}}</td>
                                  <td>{{$consu->nome}}</td>
                                  <td>{{$consu->qte}}</td>
                                  <td>{{number_format($consu->preco,2)}}</td>
                                </tr>

                                @endforeach
                              </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-contact2" role="tabpanel" aria-labelledby="pills-contact2-tab">
                      <div id="prod-content">
                          <div id="prod-item">
                              <div class="row" style="margin-right: 0px !important;">
                                <div class="col-sm-8">
                                  <select name="seletor" id="seletorDebito" class="form-control" >
                                    <option value="" selected>Selecione o aluno</option>
                                    @foreach($dependentes as $depen)
                                      <option value="{{$depen->nome}}">{{$depen->nome}}</option>
                                    @endforeach  
                                  </select>
                                </div>
                                <div class="col-sm-3">
                                  <a href="{{ route('responsavel.exportar',['id'=>Auth::guard('responsavel')->user()->id]) }}" type="button" class="btn btn-success">Exportar para Excel</a>
                                </div>
                              </div>
                                <br>
                              
                            <label for=""> Historico de depósitos: </label>
                          <table id="myTable_Deposito">
                              <tr class="header">
                                <th scope="col">Nome</th>
                                <th scope="col">Data</th>
                                <th scope="col">Depósito R$:</th>
                                <th scope="col">Saldo R$:</th>
                              </tr>
                              @foreach ( $deposito as $dep)
                                  
                              <tr>
                                <td>{{$dep->al_nome}}</td>
                                <td>{{$dep->dataD}}</td>
                                <td>{{number_format($dep->deposito,2)}}</td>
                                <td>{{number_format($dep->saldo,2)}}</td>
                              </tr>

                              @endforeach
                            </table>
                          </div>
                      </div>
                  </div>
                  </div>
        </div>
    </div>
 </div>
 

    <div class="card-footer col-md-12 foot">
      <p>Desenvolvido por ABC Cantina - Todos os direitos reservados &copy;.</p>
    </div>    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script>
        function Filtro_Produto() {
          var input, filter, table, tr, td, i, txtValue;
          input = document.getElementById("myInput");
          filter = input.value.toUpperCase();
          table = document.getElementById("myTable");
          tr = table.getElementsByTagName("tr");
          for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[2];
            if (td) {
              txtValue = td.textContent || td.innerText;
              if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
              } else {
                tr[i].style.display = "none";
              }
            }       
          }
        }
        function Filtro_Responsavel() {
          var input, filter, table, tr, td, i, txtValue;
          input = document.getElementById("myInput_Resp");
          filter = input.value.toUpperCase();
          table = document.getElementById("myTable_Resp");
          tr = table.getElementsByTagName("tr");
          for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[1];
            if (td) {
              txtValue = td.textContent || td.innerText;
              if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
              } else {
                tr[i].style.display = "none";
              }
            }       
          }
        }
        function Filtro_Aluno() {
          var input, filter, table, tr, td, i, txtValue;
          input = document.getElementById("myInput_Aluno");
          filter = input.value.toUpperCase();
          table = document.getElementById("myTable_Aluno");
          tr = table.getElementsByTagName("tr");
          for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[1];
            if (td) {
              txtValue = td.textContent || td.innerText;
              if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
              } else {
                tr[i].style.display = "none";
              }
            }       
          }
        }
        </script>
        <script src="../../js/jquery-3.6.0.min.js"></script>

        <script>
          $(document).ready(function(){
            $('#seletorDebito').change(function(){
                var aluno_nome = $(this).val();
                console.log(aluno_nome);
                var input, filter, table, tr, td, i, txtValue;

                
                filter = aluno_nome;
                table = document.getElementById("myTable_Deposito");
                tr = table.getElementsByTagName("tr");
                for (i = 0; i < tr.length; i++) {
                  td = tr[i].getElementsByTagName("td")[0];
                  if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.indexOf(filter) > -1) {
                      tr[i].style.display = "";
                    } else {
                      tr[i].style.display = "none";
                    }
                  }       
                }


            });
          });
        </script>
        <script>
          function FiltroConsumo(){
           // var id_alu = $('#seletorConsumo').find(":selected").val();
            var data_ini  = document.getElementById('data-ini').value;
            var data_fim = document.getElementById('data-fim').value;
            var aluno =  $('#seletorConsumo').find(":selected").text();
            var ident = $('#seletorConsumo').find(":selected").val();

            if(moment(data_ini).isAfter(data_fim)){
              alert("Informe um período correto!");
            }else{
              var filter, table, tr, td, i, txtValue;
              
              filter = aluno;
              table = document.getElementById("myTable_Consumo");
              tr = table.getElementsByTagName("tr");
              for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                td2 =tr[i].getElementsByTagName("td")[1];
                if (td && td2) {
                  txtValue = td.textContent || td.innerText;
                  txtValue2 = td2.textContent || td2.innerText;
                  if (txtValue.indexOf(filter) > -1 && moment(txtValue2).isSameOrAfter(data_ini) && moment(txtValue2).isSameOrBefore(data_fim)) {
                    tr[i].style.display = "";
                  } else {
                    tr[i].style.display = "none";
                    if(ident === ""){
                      tr[i].style.display = "";
                    }
                  }
                }       
              }
            }
                

            
          }
        </script>
        <script>
          $(document).ready(function(){
            $(document).on('click','.editalu', function(){
                var alu_id = $(this).val();
                //alert(prod_id);
    
                $.ajax({
                  type: "GET",
                  url: "/responsavel/editalu/"+alu_id,
                  success: function (response){
                    //console.log(response);
                    $('#recipient-turma-ed').val(response.aluno.turma);
                    $('#recipient-turno-ed').val(response.aluno.turno);
                    $('#recipient-nome-ed').val(response.aluno.nome);
                    $('#resp-tel-editar').val(response.aluno.tel);
                    $('#recipient-email-ed').val(response.aluno.email);
                    $('#recipient-senha-ed').val(response.aluno.senha);
                    $('#alu_id').val(response.aluno.id);

                    $('#editar-aluno').modal('show');
                  }
                });
            });
          });
        </script>
        <script>
          $(document).ready(function(){
            $(document).on('click','.depoaluno', function(){
                var alu_id = $(this).val();
                //alert(prod_id);
    
                $.ajax({
                  type: "GET",
                  url: "/responsavel/depositar/"+alu_id,
                  success: function (response){
                    //console.log(response);
                    $('#deposito_alu_id').val(response.aluno.id);
                    $('#saldo_alu_id').val(response.aluno.saldo);
                    $('#editar-dep').modal('show');
                  }
                });
            });
          });
        </script>
        <script>
          $(document).ready(function(){
            $('#seletor').change(function(){
                var aluno_id = $(this).val();
                console.log(aluno_id);
                var option = $('#seletor').find(":selected").text();

                //var aluno2_id = $('#seletor').val();
                document.getElementById('id_doaluno40').value = aluno_id;
                var prod = $('#testandoprod').text();
                document.getElementsByName('produto_doaluno').value = prod;

                $('#id_doaluno').val(aluno_id);
                 $('#nomeal').html('');
                //alert(prod_id);
                $.ajax({
                  type: "GET",
                  url: "/responsavel/testando/"+aluno_id,
                  success: function (response){
                   $(".iti").remove();
                    var trHTML = ' ';
                    //console.log(hjj);
                  //  $.each(response, function (i, response) {
                      for(var f=0;f<response.produtoal.length;f++){  
                        //console.log(response.produtoal[f]['id_aluno']);
                        trHTML += '<tr><td class="iti table-danger">'+ response.produtoal[f]['id'] +'</td><td class="iti table-danger">' + response.produtoal[f]['nome'] +'</td><td class="iti table-danger">' + response.produtoal[f]['blo_status']  +'</td><td class="iti table-danger"><button style="margin-right: 10px !important;margin-left: 10px !important;" type="button" class="btn btn-primary">Desbloquear</button></td></tr>'  ;
                      }
                      //console.log(response.produtoal[2]);
                      //window.location.reload()
                   // });
                      $('#nomeal').append('<h5>'+option+'</h5>');
                      $('#myTable_teste').append(trHTML);
                      $('#testando-modal').modal('show');
                    
                  }
                });

                
               
            });
          });
        </script>
        
        
    <script src='http://momentjs.com/downloads/moment.min.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>
    <script src="../../js/eventos.js" type="text/javascript"></script>
    <!--<script src="bootstrap/js/bootstrap.min.js"></script>-->
  </body>
</html>