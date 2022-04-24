<!DOCTYPE html>
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
    <title>@yield('title')</title>
</head>
<body>
    <header>
        <div class="content">
            <div class="topo">
              <div class="topo-interno">
                  <div class="logomarca">
                    <a href=""><img src="../../img/logo.PNG" width="100" height="100" alt=""></a>
                  </div>
                  <div class="menu">
                      <ul>
                          <!--<li><img src="../../img/document.png" width="35" height="35" alt=""></li> -->
                          <li>Cantina {{ Auth::guard('cantina')->user()->name}}</li>
                          <li>
                            <a href="{{route('cantina.sair')}}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><img src="../../img/logout.png" width="35" height="35" alt=""></a>
                            <form action="{{route('cantina.sair')}}" method="POST" class="d-none" id="logout-form">@csrf</form>
                          </li>
                      </ul>
                  </div>
              </div>
          </div>
        </div>
    </header>
    <section>
        @yield('content')
    </section>
    <script>
        function Filtro_Produto() {
          var input, filter, table, tr, td, i, txtValue;
          input = document.getElementById("myInput");
          filter = input.value.toUpperCase();
          table = document.getElementById("myTable");
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
        function Filtro_Responsavel() {
          var input, filter, table, tr, td, i, txtValue;
          input = document.getElementById("myInput_Resp");
          filter = input.value.toUpperCase();
          table = document.getElementById("myTable_Resp");
          tr = table.getElementsByTagName("tr");
          for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];
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

        $(document).on('click','.editbtn', function(){
            var produ_id = $(this).val();
            //alert(prod_id);
            

            $.ajax({
              type: "GET",
              url: "/cantina/edit/"+produ_id,
              success: function (response){
                //console.log(response);
                $('#recipient-qte-editar').val(response.produto.qte);
                $('#recipient-name-editar').val(response.produto.nome);
                if(response.produto.fornecedor === null){
                  document.getElementById("recipient-fornecedor-editar").style.display = "none";
                }else{
                  document.getElementById("recipient-fornecedor-editar").style.display = "block";
                  $('#recipient-fornecedor-editar').val(response.produto.fornecedor);
                }
                if(response.produto.ingredientes === null){
                  document.getElementById("recipient-ingredientes-editar").style.display = "none";
                }else{
                  document.getElementById("recipient-ingredientes-editar").style.display = "block";
                  $('#recipient-ingredientes-editar').val(response.produto.ingredientes);
                }
                
                $('#recipient-preco-editar').val(response.produto.preco);
                $('#upload-imagem-editar').val(response.produto.imagem);
                $('#prod_id').val(response.produto.id);
                $('#tipo_prod').val(response.produto.tipo);


                $('#editModal').modal('show');
              }
            });
        });
      });
    </script>
    <script>
      $(document).ready(function(){
        $(document).on('click','.editresp', function(){
            var resp_id = $(this).val();
            //alert(prod_id);

            $.ajax({
              type: "GET",
              url: "/cantina/editresp/"+resp_id,
              success: function (response){
                //console.log(response);
                $('#resp-cpf-editar').val(response.responsavel.cpf);
                $('#resp-name-editar').val(response.responsavel.nome);
                $('#resp-tel-editar').val(response.responsavel.tel);
                $('#resp-email-editar').val(response.responsavel.email);
                $('#resp_id').val(response.responsavel.id);
                $('#editar-responsavel').modal('show');
              }
            });
        });
      });
    </script>
    

    <!--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js" crossorigin="anonymous"></script>
    <script src="../../js/eventos.js"></script>
    <!--<script src="bootstrap/js/bootstrap.min.js"></script>-->

    <footer>
        <div class="card-footer col-md-12 foot">
            <p>Desenvolvido por ABC Cantina - Todos os direitos reservados &copy;.</p>
        </div> 
    </footer>
</body>
</html>