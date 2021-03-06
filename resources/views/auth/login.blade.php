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

    <title>ABC cantina's  space</title>
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
                  <h1>Login</h1> 
                        <div class = "container form-signin">
                           </div> <!-- /container -->
         
                  <div class = "container2">
                     <form method="post" action="{{ route('cantinasu')}}" >
                        @csrf
                        <div class="mb-3">
                           @if (Session::get('falha'))
                           <div class="alert alert-danger">
                              {{Session::get('falha')}}
                           </div>
                           @endif

                           @if (Session::get('success'))
                           <div class="alert alert-success">
                              {{Session::get('success')}}
                           </div>
                           @endif
                          
                          <input type="text" name="cantinanome" placeholder="Informe o nome da cantina" class="form-control" id="cantinanome" >
                        </div>
                        <button type="submit" class="btn btn-primary">Acessar</button><br><br>
                      </form>

                     <form class = "form-signin row" action = "{{route('login')}}" method="POST">
                        @csrf
                        <h4 class = "form-signin-heading"></h4>
                        <div class="col-sm-12">
                           @if (Session::get('fail'))
                           <div class="alert alert-danger">
                              {{Session::get('fail')}}
                           </div>
                       @endif
                           <input type = "text" class = "form-control" name = "email" placeholder = "E-mail" required autofocus minlegth = "14" value="{{old('email')}}">
                           <span class="text-danger sp">@error('email'){{$message}}@enderror</span><br>
                        </div>
                        <div class="col-sm-12">
                           <input type = "password" class = "form-control" name = "password" placeholder = "Senha" value="{{old('password')}}" required>
                           <span class="text-danger sp">@error('password'){{$message}}@enderror</span><br>
                        </div>
                        <div class="col-sm-12">
                           <button class = "btn btn-lg btn-primary btn-block" type = "submit" name = "login">Entrar</button><br><br>
                        </div>
                     </form>
            
            
                  </div> 
               </div>

        
        </div><br>
    </div>
 </div>

 <div class="card-footer col-md-12 foot">
   <p>Desenvolvido por ABC Cantina - Todos os direitos reservados &copy;.</p>
</div>  

  </body>
</html>