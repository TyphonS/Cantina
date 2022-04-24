<!doctype html>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link href="https://fonts.googleapis.com/css?family=Lobster|Roboto+Slab&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../css/style-escola.css">   
    <link rel="shortcut icon" href="img/logo.ico" />    
    <script src="https://kit.fontawesome.com/684301185d.js"> </script>
    <link rel="stylesheet" href="../../css/app.css">
    <link rel="stylesheet" href="../../js/app.js">
    

    <title>Escola</title>
  </head>
  <body>
   <div id="teste">
      <div id="logomarca">
         <img src="../../img/logo.png" width= "150px">
      </div> 
      <div id="colegio">
         ABCantina's space
      </div>

   </div>
    <div class="content">
        <div class="container">
            <div class="row">
               <div class ="col-sm box">
                  <h1>ABCantina's space</h1>

                  <p id="descricao">
                     &emsp;&emsp;Software  veio com intuito de facilitar a administração das cantinas das escolas em época de pandemia, sendo mais seguro e não ocorrendo agloremeração, O software  consiste em uma conta para a Escola (Logistica), podendo adicionar produtos/remover/bloquear produtos, criar conta dos pais/responsáveis dos alunos. A conta dos Pais/responsáveis pode criar a conta de seu filho (aluno), podendo administrar quais comidas podem aparecer para seu filho, retirar extrato do consumo mensal (a partir da data que for gerado o extrato) e podendo recarregar um saldo diário ou mensal para o filho (aluno) para que o mesmo possa utilizar em consumo apenas no site da cantina. A conta de Pai/responsável recebe no e-mail cadastrado sobre o consumo diário de seu filho. A conta do Aluno, funciona mostrando o layout da cantina escolar com as comidas do dia, sucos e outros insumos, mostrando a conta do aluno com a opção de gerar o extrato de seus insumos mensais (a partir da data que for gerado o extrato).


                  </p>
               </div>
               
               <div class="col-sm" id="caneta" style="display: unset;">
                  <h1>Cadastro da Escola</h1> 
                        <div class = "container form-signin">
                           </div> <!-- /container -->
         
                  <div class = "container2">
                     <form class = "row" action="{{route('admin.register')}}" method="POST">
                        @if (Session::get('fail'))
                               <div class="alert alert-danger">
                                  {{Session::get('fail')}}
                               </div>
                           @endif
                           @if (Session::get('success'))
                               <div class="success success-danger">
                                  {{Session::get('success')}}
                               </div>
                           @endif
                           @csrf
                        <h4 class = "form-signin-heading"></h4>
                        <div class="col-sm-12">
                           <input onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="18" id="cnpj_cantina" type = "text" class = "form-control" name = "cnpj" placeholder = "CNPJ" required autofocus value="{{old('cnpj')}}">
                           <span class="text-danger">@error('cnpj'){{$message}}@enderror</span><br>
                        </div>
                        <div class="col-sm-5">
                           <input type = "text" class = "form-control" name = "name" placeholder = "NOME" required value="{{old('name')}}">
                           <span class="text-danger sp">@error('name'){{$message}}@enderror</span><br>
                        </div>
                        <div class="col-sm-7">
                           <input onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="14" id="tel_cantina" type = "text" class = "form-control" name = "tel" placeholder = "TELEFONE" value="{{old('tel')}}" required>
                           <span class="text-danger sp">@error('tel'){{$message}}@enderror</span><br>
                        </div>
                        <div class="col-sm-12">
                           <input type = "text" class = "form-control" name = "endereco" placeholder = "ENDEREÇO" value="{{old('endereco')}}" required>
                           <span class="text-danger sp">@error('endereco'){{$message}}@enderror</span><br>
                        </div>
                        <div class="col-sm-12">
                           <input type = "email" class = "form-control" name = "email" placeholder = "e-mail@escola.com" value="{{old('email')}}" required>
                           <span class="text-danger sp">@error('email'){{$message}}@enderror</span><br>
                        </div>
                        <div class="col-sm-12">
                           <input type = "email" class = "form-control" name = "emailadm" placeholder = "E-mail Administrador" value="{{old('emailadm')}}" required>
                           <span class="text-danger sp">@error('emailadm'){{$message}}@enderror</span><br>
                        </div>
                        <div class="col-sm-6">
                           <input type = "password" class = "form-control" name = "password" placeholder = "Senha Administrador" value="{{old('password')}}" required>
                           <span class="text-danger sp">@error('password'){{$message}}@enderror</span><br>
                        </div>
                        <div class="col-sm-6">
                            <input id="password-confirm" type="password" class="form-control" placeholder="Confirme sua senha" name="password_confirmation" required autocomplete="new-password">
                            <span class="text-danger sp">@error('password'){{$message}}@enderror</span><br>
                        </div>
                        <div class="col-sm-12">
                           <textarea name = "sobrenos" class = "form-control" cols = "20" rows = "8" maxlength="255" placeholder = "Sobre Nós" value="{{old('sobren')}}" required></textarea>
                           <span class="text-danger sp">@error('sobren'){{$message}}@enderror</span><br>
                        </div>
                        <div class="col-sm-12">
                           <button class = "btn btn-lg btn-primary btn-block" type = "submit">Cadastrar</button><br>
                        </div>
                     </form>
                     <div class="col-sm-13">
                        <a href="" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class = "btn btn-lg btn-danger btn-block" >Cancelar</a><br><br>
                        <form action="{{route('logout') }}" id="logout-form" method="post">@csrf</form> 
                     </div>
                  
                  </div> 
               </div>

        
        </div><br>
    </div>
 </div>

 <div class="card-footer col-md-12 foot">
   <p>Desenvolvido por ABC Cantina - Todos os direitos reservados &copy;.</p>
</div>  
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <script type="text/javascript" src="../../js/eventos.js"></script>
  </body>

</html>