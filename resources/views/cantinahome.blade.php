<!doctype html>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link href="https://fonts.googleapis.com/css?family=Lobster|Roboto+Slab&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../css/style.css">    
    <link rel="shortcut icon" href="img/Lubritec.ico" />    
    <script src="https://kit.fontawesome.com/684301185d.js"> </script>
    <link rel="stylesheet" href="../../css/app.css">
    <link rel="stylesheet" href="../../js/app.js">
    <script type="text/javascript"> 
     function muda() {
        var opcaoValor = document.getElementById("seletor").options[document.getElementById("seletor").selectedIndex].value;
        if( opcaoValor === "1"){
            document.getElementById("caneta2").style.display="none";
            document.getElementById("caneta").style.display="block";
            document.getElementById("caneta3").style.display="none";
            document.getElementById("caneta4").style.display="none";   
        }if(opcaoValor === "2"){
            document.getElementById("caneta2").style.display="none";
            document.getElementById("caneta").style.display="none";
            document.getElementById("caneta3").style.display="block";
            document.getElementById("caneta4").style.display="none"; 
        }if(opcaoValor === "3"){
            document.getElementById("caneta2").style.display="none";
            document.getElementById("caneta").style.display="none";
            document.getElementById("caneta3").style.display="none";
            document.getElementById("caneta4").style.display="block"; 
        }
        
    } </script>
    <title>Cantina</title>
  </head>
  <body>
   <div id="teste">
      <div id="logomarca">
         <img src="../../img/test4.png" width= "300">
      </div> 
      <div id="colegio">
        
      </div>

   </div>
    <div class="content">

        <div class="container">
            <div class="row">
                
            <div class ="col-sm box">
          <!--  <h1>Cantina $data[0]->name</h1> -->
                <h1>Cantina: @if(Session::get('data')) {{Session::get('data.name')}} @endif</h1>
                  

            <p id="descricao">
               <!-- &emsp;&emsp;$data[0]->sobrenos--> &emsp;&emsp;@if(Session::get('data')) {{Session::get('data.sobrenos')}} @endif<br>

                <!--&emsp;&emsp;Endereço: $data[0]->endereco -->&emsp;&emsp; Endereço: @if(Session::get('data')) {{Session::get('data.endereco')}} @endif<br>

               <!-- &emsp;&emsp;Telefone: $data[0]->tel-->&emsp;&emsp; Telefone: @if(Session::get('data')) {{Session::get('data.tel')}} @endif
            </p>
            </div>
            <div class = "col-sm" id="caneta2">
                <h1>Escolha o tipo de usuario</h1>
                <select name="seletor" id="seletor" class="form-control" onchange="muda()">
                    <option value="" selected>Selecione seu usuário</option>
                    <option value="1">Logistica</option>
                    <option value="2">Responsavel</option>
                    <option value="3">Aluno</option>
                </select>
            </div>
            @if (Session::get('falha'))
            <div class="alert alert-danger " style="display: block; position: fixed; top: 0; left: 20%; right: 20%; width: 60%; padding-top: 10px;margin-top:15px; z-index: 9999">
               {{Session::get('falha')}}
            </div>
            @endif
            <div class="col-sm" id="caneta">
                <h1>Login Logistica</h1> 
               
                     <div class = "container form-signin">
                        </div> <!-- /container -->
                        
                        <div class = "container box-x" >
                  
                           <form class = "form-signin was-validated" action="{{route('cantina.check')}}" method="POST" >
                            @csrf
                              <h4 class = "form-signin-heading"></h4>
                              <input type = "email" class = "form-control" name = "emailcantina" placeholder = "E-mail administrador" value="{{old('email')}}" required autofocus></br>
                              <input type = "password" class = "form-control" name = "passwordcantina" placeholder = "Senha" value="{{old('password')}}" minlength="8" required></br>
                              <button class = "btn btn-lg btn-primary btn-block" type = "submit" name = "login">Entrar</button>
                              <div class="invalid-feedback">
                                 Por favor preencha os dados!
                               </div>
                           </form>
                           
                           <p><br /> <span style="font-size: medium;"><a class="btn btn-primary" onclick="history.go(0)" >Voltar</a></span></p>
                     
                     </div> 
            </div>
            <div class="col-sm" id="caneta3" style= "display:none">
                <h1>Login Responsaveis</h1> 
                     <div class = "container form-signin">
                        </div> <!-- /container -->
      
                  <div class = "container box-x" >
               
                     <form class = "form-signin was-validated" action="{{route('responsavel.check')}}" method="POST">
                        @csrf
                        <h4 class = "form-signin-heading"></h4>
                        <input type = "email" class = "form-control" name = "emailresponsavel" placeholder = "E-mail responsável" value="{{old('email')}}" required autofocus></br>
                        <input type = "password" class = "form-control" name = "passwordresponsavel" placeholder = "Senha" minlength="8" value="{{old('password')}}" required></br>
                        <button class = "btn btn-lg btn-primary btn-block" type = "submit" name = "login">Entrar</button>
                        <div class="invalid-feedback">
                           Por favor preencha os dados!
                         </div>
                     </form>
                     
                     <p><br /> <span style="font-size: medium;"><a class="btn btn-primary" onclick="history.go(0)">Voltar</a></span></p>
                  
                  </div> 
            </div>
            <div class="col-sm" id="caneta4" style= "display:none">
                <h1>Login Aluno</h1> 
                     <div class = "container form-signin">

                      </div>
      
                     <div class = "container box-x" >
                  
                        <form class = "form-signin was-validated" method="POST" action="{{route('aluno.check')}}">
                           @csrf
                           <h4 class = "form-signin-heading"></h4>
                           <input type = "email" class = "form-control" name = "emailaluno" placeholder = "Usuário" value="{{old('email')}}" required autofocus></br>
                           <input type = "password" class = "form-control" name = "passwordaluno" placeholder = "Senha" value="{{old('password')}}"  minlength="8" required></br>
                           <button class = "btn btn-lg btn-primary btn-block" type = "submit" name = "login">Entrar</button>
                           <div class="invalid-feedback">
                              Por favor preencha os dados!
                            </div>
                        </form>
                        
                        <p><br /> <span style="font-size: medium;"><a class="btn btn-primary" onclick="history.go(0)">Voltar</a></span></p>
                     
                     </div> 
            </div>
        
        </div>
    </div>
 </div>

    <div class="card-footer col-md-12">
      <p>Desenvolvido por ABC Cantina - Todos os direitos reservados &copy;.</p>
    </div>    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  </body>
</html>