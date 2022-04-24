@extends('layouts.logistica')

@section('title','Logistica')

@section('content')
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
              <button class="nav-link active bestilo" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true"><img src="../../img/produtos.png" width="100"><br>Produtos</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link bestilo" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false"><img src="../../img/responsaveis.png" width="100"><br>Responsáveis</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link bestilo" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false"><img src="../../img/alunos.png" width="100"><br>Alunos</button>
            </li>
          </ul>
          <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                <div id="prod-content">
                    <div id="prod-item">
                        <!-- MODAL CADASTRAR PRODUTO-->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Cadastrar</button>
                        
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Cadastrar Produto</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                <form method="POST" action="{{route('cantina.cadastrarproduto')}}" enctype="multipart/form-data" novalidate>
                                  @csrf
                                  <div class="mb-3">
                                    <select name="seletor" id="Prod-tipo" class="form-control" onchange="Tipo()" required>
                                      <option value="0" selected>Selecione o tipo do produto</option>
                                      <option value="1">Comida</option>
                                      <option value="2">Bebida</option>
                                  </select>
                                  </div>
                                  <div class="mb-3" id="Prod-comida">
                                    <label for="message-text" class="col-form-label" style="padding-left: 100px;">Comida:</label>
                                    <div class="row "> 
                                      <div class="col-sm-3">
                                        <input type="number" class="form-control" id="recipient-qte-c" placeholder="Qte" name="qtecomida" min="0" required> 
                                      </div>
                                      <div class="col-sm-9">
                                        <input type="text" class="form-control" id="recipient-name-c" placeholder="Nome" name="namecomida" required> <br>
                                      </div>
                                      <div class="col">
                                        <textarea cols="20" class="form-control" id="recipient-ingredientes-c" placeholder="Informe os ingredientes" name="ingredientescomida" required></textarea><br>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-sm-4">
                                        <input type="number" class="form-control" id="recipient-preco" placeholder="Preço: R$" min="0" step="0.01" name="precocomida" required> 
                                      </div>
                                      <div class="col-sm-8">
                                        <input type="file" class="form-control hidden" id="upload_imagem-c" name="imagemcomida" >
                                        <label for="upload_imagem">Selecione uma imagem</label>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="mb-3" id="Prod-bebida">
                                    <label for="message-text" class="col-form-label" style="padding-left: 100px;">Bebida:</label>
                                    <div class="row "> 
                                      <div class="col-sm-3">
                                        <input type="number" class="form-control" id="recipient-qte-b" placeholder="Qte" name="qtebebida" min="0" required> 
                                      </div>
                                      <div class="col-sm-9">
                                        <input type="text" class="form-control" id="recipient-name-b" placeholder="Nome" name="namebebida" required> <br>
                                      </div>
                                      <div class="col">
                                        <input type="text" class="form-control" id="recipient-fornecedor-b" placeholder="Fornecedor" name="fornecedorbebida" required> <br>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-sm-4">
                                        <input type="number" class="form-control" id="recipient-preco-b" placeholder="Preço: R$" step="0.01"  min="0" name="precobebida" required> 
                                      </div>
                                      <div class="col-sm-8">
                                        <input type="file" class="form-control hidden" id="upload_imagem-b" name="imagembebida" required>
                                        <label for="upload_imagem">Selecione uma imagem</label>
                                      </div>
                                    </div>
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
                        <!--MODAL CADASTRAR PRODUTO-->
                    
                    <input type="text" id="myInput" onkeyup="Filtro_Produto()" placeholder="Pesquisar por nome" title="Type in a name">
                    <table id="myTable" >
                        <tr class="header">
                          <th scope="col">Imagem</th>
                          <th scope="col">Produto</th>
                          <th scope="col">Cod</th>
                          <th scope="col">Qte</th>
                          <th scope="col">Tipo</th>
                          <th scope="col">Preço R$</th>
                          <th scope="col">Ação</th>
                        </tr>
                        @foreach ($produtos as $produto)
                        <tr>
                            <td><img src="{{ asset('storage/img/'.$produto->imagem) }}" width="130" height="100" class="img-thumbnail" alt="..."></td>
                              
                                <td>{{$produto->nome}}</td>
                                <td>{{$produto->id}}</td>
                                <td>{{$produto->qte}}</td>
                                <td>{{$produto->tipo}}</td>
                                <td>{{number_format($produto->preco,2)}}</td>
                                
                            <td>
                              <a href="{{ route('cantina.del',['id'=>$produto->id]) }}" onclick="return(confirm('Tem certeza que deseja excluir?'))"><img src="../../img/excluir.png" width="40" height="40" alt=""></a>
                              
                                <!-- MODAL EDITAR PRODUTO-->
                                <button type="button" class="btn btn-primary bcor editbtn" value="{{$produto->id}}" ><img src="../img/editar.png" width="40" height="40" alt=""></button>
                                
                                <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editar-prod-label" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="editar-prod-label">Editar Produto</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body">
                                        <form method="POST" action="{{ route('cantina.editarprod')}}" enctype="multipart/form-data" novalidate>
                                          @csrf
                                          @method('PUT')
                                          <input type="hidden" name="prod_id" id="prod_id">
                                          <input type="hidden" name="tipo_prod" id="tipo_prod">
                                          <div class="mb-3" >
                                            <div class="row "> 
                                              <div class="col-sm-4">
                                                <label for="message-text" class="col-form-label" >Qte:</label>
                                                <input type="number" class="form-control" id="recipient-qte-editar" min="0" placeholder="Qte" name="qteeditar" required> 
                                              </div>
                                              <div class="col-sm-8">
                                                <label for="message-text" class="col-form-label" >Nome:</label>
                                                <input type="text" class="form-control" id="recipient-name-editar" placeholder="Nome" name="nomeeditar"  required> <br>
                                              </div>
                                              <div class="col-sm-12">
                                                <input type="text" class="form-control" id="recipient-fornecedor-editar" placeholder="Fornecedor" name="fornecedorbebidaeditar" value="" > <br>
                                              </div>
                                              <div class="col-sm-12">
                                                <textarea cols="20" class="form-control" id="recipient-ingredientes-editar" placeholder="Informe os ingredientes" name="ingredienteeditar" ></textarea><br>
                                              </div>  
                                          </div>
                                            <div class="row">
                                              <div class="col-sm-4">
                                                <label for="message-text" class="col-form-label" >Preço R$:</label>
                                                <input type="number" class="form-control" id="recipient-preco-editar" placeholder="Preço: R$" step="0.01" name="precoeditar" required> 
                                              </div>
                                              <div class="col-sm-8">
                                                <label for="upload_imagem">Selecione uma imagem</label>
                                                <input type="file" class="form-control hidden" name="imagem-editar" id="upload_imagem-editar" >
                                                
                                              </div>
                                            </div>
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
                                <!-- MODAL EDITAR PRODUTO-->

                                
                              
                                @if ($produto->bloqueado === 0)
                                  <a href="{{ route('cantina.done',['id'=>$produto->id]) }}"><img src="../img/bloquear.png" id="desbloqueado" width="40" height="40" alt=""></a>
                                @else
                                  <a href="{{ route('cantina.done',['id'=>$produto->id]) }}"><img src="../img/bloqueado.png" id="bloqueado" width="40" height="40" alt=""></a>
                                @endif
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
                        <!-- MODAL CADASTRAR RESPONSAVEL -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalCadastrar" data-bs-whatever="@mdo">Cadastrar</button>
                        
                        <div class="modal fade" id="exampleModalCadastrar" tabindex="-1" aria-labelledby="exampleModalLabelCadastrar" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabelCadastrar">Cadastrar Responsável</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                <form method="POST" action="{{ route('cantina.cadastrarresponsavel') }}" novalidate>
                                  @csrf
                                  <div class="mb-1">
                                    <input type="text" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="14" class="form-control" id="cpf-responsavel" name="cpfresp" placeholder="CPF" required> <br>
                                    <input pattern="[A-Za-z].{2,}" title="Não é Permitido caractere especial no começo!" type="text" class="form-control" id="recipient-name" name="nomeresp" placeholder="Nome" required> <br>
                                    <input onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="14" type="tel" class="form-control" id="tel_cantina" name="telresp" placeholder="Telefone" required> <br>
                                    <input type="email" class="form-control" id="recipient-email" name="email" placeholder="E-mail" required>
                                  </div>
                                  <div class="mb-3">
                                    <label for="message-text" class="col-form-label">Acesso:</label>
                                    <input type="password" class="form-control" id="recipient-senha" name="passwordresp" placeholder="Senha" required>
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
                        <!-- MODAL CADASTRAR RESPONSAVEL-->
                    
                    <input type="text" id="myInput_Resp" onkeyup="Filtro_Responsavel()" placeholder="Pesquisar Por CPF" title="Type in a name">
                    <table id="myTable_Resp">
                        <tr class="header">
                          <th scope="col">CPF</th>
                          <th scope="col">Nome</th>
                          <th scope="col">Contato</th>
                          <th scope="col">Email</th>
                          <th scope="col">Ação</th>
                        </tr>
                        @foreach ($responsavel as $resp)
                        <tr>
                          <td>{{ $resp->cpf}}</td>
                          <td>{{$resp->nome}}</td>
                          <td>{{$resp->tel}}</td>
                          <td>{{$resp->email}}</td>
                          <td>
                              <a href="{{ route('cantina.delresp',['id'=>$resp->id]) }}" onclick="return(confirm('Tem certeza que deseja excluir?'))"><img src="../../img/excluir.png" width="40" height="40" alt=""></a>
                              
                                <!-- MODAL EDITAR RESPONSAVEL-->
                                <button type="button" class="btn btn-primary bcor editresp" value="{{$resp->id}}"><img src="../img/editar.png" width="40" height="40" alt=""></button>
                                
                                <div class="modal fade" id="editar-responsavel" tabindex="-1" aria-labelledby="editar-responsavel-label" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="editar-responsavel-label">Editar Responsavel</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body">
                                        <form action="{{route('cantina.editarresp')}}" method="POST" novalidate>
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="resp_id" id="resp_id">
                                        <div class="mb-1">
                                          <label for="message-text" class="col-form-label" >Cpf:</label>
                                          <input onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="14"  type="text" class="form-control" id="resp-cpf-editar" name="cpfeditarresp" placeholder="CPF" > <br>
                                          <label for="message-text" class="col-form-label" >Nome:</label>
                                          <input pattern="[A-Za-z].{2,}" title="Não é Permitido caractere especial no começo!" type="text" class="form-control" id="resp-name-editar" name="nomeeditarresp" placeholder="Nome" > <br>
                                          <label for="message-text" class="col-form-label" >Tel:</label>
                                          <input onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="14" type="tel" class="form-control" id="resp-tel-editar" name="teleditarresp" placeholder="Telefone" > <br>
                                          <label for="message-text" class="col-form-label" >E-mail:</label>
                                          <input type="email" class="form-control" id="resp-email-editar" name="emaileditarresp" placeholder="E-mail" >
                                        </div>
                                        <div class="mb-3">
                                          <label for="message-text" class="col-form-label">Acesso:</label>
                                          <input type="text" class="form-control" id="resp-senha-editar" name="senhaeditarresp" placeholder="Senha" >
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
                                <!-- MODAL EDITAR RESPONSAVEL-->

                          </td>
                        </tr>
                        @endforeach
                      </table>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                <div id="prod-content">
                    <div id="prod-item">

                    
                    <input type="text" id="myInput_Aluno" onkeyup="Filtro_Aluno()" placeholder="Pesquisar por nome" title="Type in a name">
                    <table id="myTable_Aluno">
                      
                        <tr class="header">
                          <th scope="col">Matricula</th>
                          <th scope="col">Nome</th>
                          <th scope="col">Saldo R$</th>
                          <th scope="col">Responsável</th>
                        </tr>
                        @foreach ($alun as $alu)
                        <tr>
                          <td>{{$alu->id}}</td>
                          <td>{{$alu->nome}}</td>
                          <td>{{number_format($alu->saldo,2)}}</td>
                          <td>{{$alu->r_nome}}</td>
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
@endsection