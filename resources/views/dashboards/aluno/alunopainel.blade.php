<!DOCTYPE html>
<html lang="pt-br">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->  
    <link rel="stylesheet" href="../../css/cards.css">  
    <link rel="stylesheet" href="../../css/app.css">
    <link rel="stylesheet" href="../../js/app.js">
    
    <title>Aluno</title>
</head>
<body>
    <div class="topo">
        <div class="topo-interno">
            <div class="logomarca">
                <a href=""><img src="../../img/logo.PNG" width="100" height="100" alt=""></a>
              </div>
              <div class="menu">
                  <ul>
                    <li>Cantina: {{Session::get('data.name')}}</li>
                    <li>Bem vindo(a) {{ Auth::guard('aluno')->user()->nome}}</li>
                    <a href="{{route('aluno.sair')}}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><img src="../../img/logout.png" width="35" height="35" alt=""></a>
                        <form action="{{route('aluno.sair')}}" method="POST" class="d-none" id="logout-form">@csrf</form>
                  </ul>
              </div>
        </div>
    </div>
    <div class="conteudo">
        <div class="conteudo-interno">
            @if (Session::get('success'))
                  <div x-data="{show: true}" x-init="setTimeout(() => show = false, 4000)" x-show="show" class="alert alert-success " style="display: block; position: fixed; top: 0; left: 20%; right: 20%; width: 60%; padding-top: 10px;margin-top:15px; z-index: 9999">
                    {{Session::get('success')}}
                    <button onclick="$('.alert').alert('close')" type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  
                @endif
                @if (Session::get('fail'))
                  <div x-data="{show: true}" x-init="setTimeout(() => show = false, 4000)" x-show="show" class="alert alert-danger " style="display: block; position: fixed; top: 0; left: 20%; right: 20%; width: 60%; padding-top: 10px;margin-top:15px; z-index: 9999">
                    {{Session::get('fail')}}
                    <button onclick="$('.alert').alert('close')" type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  
                @endif
                
            <div class="cards">
                <div class="cards-conteudo">
                    
                    <div onclick="FiltroComida()" class="cards-img">
                        <img id="cards-food"src="../../img/food.png" width="80" height="80" alt="">
                    </div>

                    <div class="cards-nome">Comidas</div>
                </div>
                <div class="cards-conteudo">
                    <div class="cards-img" onclick="FiltroBebida()">
                        <img src="../../img/drink.png" width="80" height="80" alt="">
                    </div>
                    <div class="cards-nome">Bebidas</div>
                </div>
                <div class="cards-conteudo">
                    <div class="cards-img" onclick="FiltroTodos()">
                        <img src="../../img/todos.png" width="80" height="75" alt="">
                    </div>
                    <div class="cards-nome">Ver todos</div>
                </div>
            </div>
            <img src="{{asset('storage/img/'.Auth::guard('aluno')->user()->imagem)}}" width="100" height="100" style="border-radius: 50px;" alt="..." class="img-thumbnail">
            <label id="saldo"> Seu saldo R$ {{number_format(Auth::guard('aluno')->user()->saldo,2)}}</label> 

            

            <!--    MODAL CARRINHO -->
               
<button style="background: radial-gradient(#1fe4f5, #3fbafe);" type="button" class="btn btn-primary mod" >
    <img src="../../img/carrinho.png" width="40" height="30" alt="">
  </button>
<input type="button" class="btn btn-primary" style="width:40 !important;height:30 !important;background-color: red !important;color:white !important;" value=0 id="notificacao">
  
  <div class="modal fade" id="modal-carrinho" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Carrinho de Produtos</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{route('aluno.colocar')}}" novalidate>
                @csrf
            <table class="table" id="tablet">
                <tr class="header">
                    <th scope="col">Produto</th>
                    <th scope="col">Qte</th>
                    <th scope="col">Preço</th>
                </tr>
                <input type="hidden" id="aluno_id" name="carrinho_aluno" value="{{ Auth::guard('aluno')->user()->id}}">
                <input type="hidden" name="saldo_aluno" id="saldo_aluno" value="{{ Auth::guard('aluno')->user()->saldo}}">
                <input type="hidden" name="valor_total" id="valor_total" value=0>
     
            </table>
            <hr>
            <div class="row">
                <div class="col"></div>
                <div class="col"></div>
                <div class="col">
                    <div id="preco_total">

                    </div>
                </div>
                <div class="col"></div>
            </div>
            <div class="row" style="align-items: center;justify-content: center; padding: 10px;">
                <button style="width: 100%;" type="submit" id="botao-carrinho" class="btn btn-outline-success btn-lg" style="display: none;">Comprar</button><br>
            </div>
            
           

        </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            
          </div>
         
      </div>
    </div>
  </div>
            <!-- MODAL CARRINHO -->
            <div class="filtro">
                <div class="input-group fil">
                    <input type="text" id="myInput_Cardapio" class="form-control" onkeyup="FiltroCardapio()" placeholder="Pesquise no cardápio" aria-label="Username" aria-describedby="basic-addon1">
                    <span class="input-group-text btn-fil" id="basic-addon1"><img src="../../img/aaaaa.jpg.opdownload" width="18" alt=""></span>
                </div>
            </div>
            <div class="conteudo-cardapio">

<div class="main-container">
    
        
    
    <div class="cards" id="mycart">

        @foreach ($produtosAluno as $prod)
           
            <div class="card card-1" >
                
                <p class="card__icon"><img src="{{ asset('storage/img/'.$prod->imagem) }}" width="100" height="100" class="dp"/><i class="fas fa-bolt"></i></p>
                <p class="card__title" >{{$prod->nome}}</p>
                <p class="card_l" style="display: none !important;">{{$prod->tipo}}</p>
                @if ($prod->ingredientes != null)
                    <p class="card__exit" > Ingredientes: {{$prod->ingredientes}}<i class="fas fa-times"></i></p>     
                @elseif($prod->fornecedor != null)
                    <p class="card__exit"> Fornecedor: {{$prod->fornecedor}}<i class="fas fa-times"></i></p> 
                @endif
                <p class="card__apply">
                    R$ {{number_format($prod->preco,2)}}
                </p>
                <button type="button" class="btn btn-success cart" value="{{$prod->id}}">Adicionar ao carrinho</button>
            </div>
          
        @endforeach

    </div>
  </div>
  
  <script src="../../js/jquery-3.6.0.min.js"></script>
  <script>
        $(document).ready(function(){
            $(document).on('click','#ok', function(){
                var id = $(this).val();
                var preco = document.getElementById(id+"20").value;
                console.log(preco);
                var not = document.getElementById("notificacao").value;
                var total = document.getElementById("valor_total").value;
                var saldo_aluno = document.getElementById("saldo_aluno").value;
                var trHTML2 = ' ';
                $('#labelpreco').remove();

                console.log(id);
                not = (parseInt(not)-1);
                document.getElementById('notificacao').value = not;
                document.getElementById(id).innerHTML = "";
                total = (parseFloat(total) - parseFloat(preco)).toFixed(2);
                //saldo_aluno = parseFloat(saldo_aluno) + parseFloat(preco);

                trHTML2 += '<label id="labelpreco">x '+total+'</label>';

                $('#preco_total').append(trHTML2);
                document.getElementById("valor_total").value = total;
               // document.getElementById("saldo_aluno").value = saldo_aluno;
                var diferenca = (parseFloat(saldo_aluno) - parseFloat(total));
                
               

                if(parseInt(not) == 0){
                    $('#labelpreco').remove();
                    document.getElementById('botao-carrinho').style.display = "none";
                 }else{
                    document.getElementById('botao-carrinho').style.display = "block";
                     
               
                }
                
            });
          });
  </script>
  <script>
        $(document).ready(function(){
        $(document).on('click','.cart', function(){
            var prod_id = $(this).val();
            var aluno_id = $('#aluno_id').val();
            var numb = Math.random();
            //alert(prod_id);

            $.ajax({
              type: "GET",
              url: "/aluno/pegarproduto/"+prod_id+"/"+aluno_id,
              success: function (response){
                var trHTML = ' ';
                var trHTML2 = ' ';
                var trHTML3 = ' ';
                var not = document.getElementById("notificacao").value;
                var total = document.getElementById("valor_total").value;
                var saldo_aluno = document.getElementById("saldo_aluno").value;
                
                

                preco = parseFloat(response.produto.preco);
                total = (parseFloat(total) + parseFloat(preco)).toFixed(2);
                var diferenca = (parseFloat(saldo_aluno) - parseFloat(total));
                

                if(parseFloat(diferenca) >= 0){
                    $('#labelpreco').remove();

                    trHTML= '<tr id="'+numb+'"><td><input type="text" class="form-control" value="'+response.produto.nome+'" readonly></input><input type="hidden" class="form-control"  name="produtocart[]" value="'+response.produto.id+'" readonly></input></td><td><input type="number" name="'+response.produto.id+'[]" class="form-control" value="1" min="1" ></input></td><td ><input class="form-control" type="number" name="precocart[]" value="'+response.produto.preco+'" readonly></input></td><td><button style="margin-right: 10px !important;margin-left: 10px !important;" type="button" value="'+numb+'" id="ok" class="btn btn-danger" >Remover</button></td><input type="hidden" id="'+numb+'20" value="'+response.produto.preco+'"></input></tr>' 
/*
                trHTML += '<input type="text" class="form-control" disabled value="'+response.produto.nome+'"></input><br>';
                trHTML2 +='<input type="number"  class="form-control"  disabled value="'+response.produto.preco+'"></input><br>';   
                trHTML3 +='<input type="number"  class="form-control" value="1" min="1" ></input><br>';     
*/          
                trHTML2 += '<label id="labelpreco">x '+total+'</label>';
                not = (parseInt(not)+1);
                document.getElementById("valor_total").value = total;
                
                console.log(response.aluno);
                console.log(numb);
            /* $('#prodaqui').append(trHTML);
                $('#precoaqui').append(trHTML2);*/
                $('#tablet').append(trHTML);
                $('#preco_total').append(trHTML2);
                document.getElementById('notificacao').value = not;
                
                console.log(total);
                console.log(diferenca);
                    
              
                    document.getElementById('botao-carrinho').style.display = "block";

                }else{
                    document.getElementById('botao-carrinho').style.display = "none";
                    bootbox.alert('Saldo insuficiente');
                }
                

               
                  
               
              }
            });

        });
      });
  </script>
  <script>
    $(document).ready(function(){
        $(document).on('click','.mod', function(){

            var not = document.getElementById("notificacao").value;
            
            if(parseInt(not) == 0){
                document.getElementById('botao-carrinho').style.display = "none";
            }else{
                document.getElementById('botao-carrinho').style.display = "block";
            }

            $('#modal-carrinho').modal('show');
            
        });
      });
</script>
<script type="text/javascript">
    function FiltroCardapio(){
        var input, filter, table, tr, td, i, txtValue;
          input = document.getElementById("myInput_Cardapio");
          filter = input.value.toUpperCase();
          table = document.getElementById("mycart");
          tr = table.getElementsByTagName("div");
          for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("p")[1];
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
<script type="text/javascript">
    function FiltroComida(){
        var input, filter, table, tr, td, i, txtValue;
          
          filter = "Comida";
          table = document.getElementById("mycart");
          tr = table.getElementsByTagName("div");
          for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("p")[2];
            if (td) {
              txtValue = td.textContent || td.innerText;
              if (txtValue.indexOf(filter) > -1) {
                tr[i].style.display = "";
              } else {
                tr[i].style.display = "none";
              }
            }       
          }
    }
</script>
<script type="text/javascript">
    function FiltroBebida(){
        var input, filter, table, tr, td, i, txtValue;
          
          filter = "Bebida";
          table = document.getElementById("mycart");
          tr = table.getElementsByTagName("div");
          for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("p")[2];
            if (td) {
              txtValue = td.textContent || td.innerText;
              if (txtValue.indexOf(filter) > -1) {
                tr[i].style.display = "";
              } else {
                tr[i].style.display = "none";
              }
            }       
          }
    }
</script>
<script type="text/javascript">
    function FiltroTodos(){
        var input, filter, table, tr, td, i, txtValue;
          
          table = document.getElementById("mycart");
          tr = table.getElementsByTagName("div");
          for (i = 0; i < tr.length; i++) {
           
                tr[i].style.display = "";
              
                 
          }
    }
</script>
            </div>
        </div>
    </div>
    <div class="footer">
        <div class="footer-interno">
            <p>Desenvolvido por ABC Cantina - Todos os direitos reservados &copy;.</p>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js" crossorigin="anonymous"></script>
</body>
</html>