<?php
    $principal = $_REQUEST['valor_inicial'];
    $meses = $_REQUEST['meses'];
    $taxa = $_REQUEST['taxa_de_juros'];
    $Valor_parcela = Calcular_parcelas($principal, $meses, $taxa);
    $Valor_juros = Calcular_juros($Valor_parcela, $principal, $meses);
    $valor_total = $Valor_parcela * $meses;
?>
<!Doctype html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Calculadora de Juros Compostos</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
        <!-- <link rel="stylesheet" href="calculadoras.css"> -->
    </head>
    <script type="text/javascript">
        function info(){
          var confirmado = confirm('Para uma melhor experiência, todos os campos devem estar preenchidos corretamente.');
          if(confirmado){
            alert('Entendido!');
          }else{
            alert('Preciso de Ajudar');
          }
        }
    </script>
    <body>
        <div class="container">
            <form class="w-100" method="post" id="formCalc" action="">
                <label for="basic-url">Valor Financiado:</label>
                <div class="input-group mb-3 rounded-0">
                    <div class="input-group-prepend">
                        <span class="input-group-text rounded-0 bg-warning"><strong>R$</strong></span>
                    </div>
                    <input class="form-control border border-warning border-top-0 border-right-0 border-left-0" type="number" step="0.01" id="valor_inicial" name="valor_inicial" min="0.00" max="9999999999.00" required>
                </div>
                <label for="basic-url">Valor da Prestação:</label>
                <div class="input-group mb-3 rounded-0">
                    <div class="input-group-prepend">
                        <span class="input-group-text rounded-0 bg-warning"><strong>R$</strong></span>
                    </div>
                    <input class="form-control currency border border-warning border-top-0 border-right-0 border-left-0" type="number" step="0.01" id="valor_mensal" name="valor_mensal" min="0.00" max="9999999999.00" required>
                </div>
                <label for="basic-url">Nº de Meses:</label>
                <div class="input-group mb-3 rounded-0">
                    <div class="input-group-prepend">
                        <span class="input-group-text rounded-0 bg-warning"><strong>&#x1F550</strong></span>
                    </div>
                    <input class="form-control currency border border-warning border-top-0 border-right-0 border-left-0" type="number" id="meses" name="meses" min="1" placeholder="Meses" required>
                </div>
                <label for="basic-url">Taxa de Juros Mensal:</label>
                <div class="input-group mb-3 rounded-0">
                    <div class="input-group-prepend">
                        <span class="input-group-text rounded-0 bg-warning"><strong>%</strong></span>
                    </div>
                    <input class="form-control currency border border-warning border-top-0 border-right-0 border-left-0" type="number" step="0.01" id="taxa_de_juros" name="taxa_de_juros" min="0.01" max="9999999999.00" required>
                </div>
                <div class="form-group">
                    <button class="btn btn-warning" type="submit" value="Calcular" onclick="info()" name="button" id="button">Calcular</button>
                </div>
            </form>

            <div class="row d-flex justify-content-center">
                <div class="card" style="width: 15rem;">
                    <div class="card-body">
                        <h5 class="card-title">Valor Financiado: </h5>
                        <p class="card-text" id="inicial"><strong>R$ </strong><?=$principal?></p>
                    </div>
                </div>
                <div class="card" style="width: 15rem;">
                    <div class="card-body">
                        <h5 class="card-title">Valor da Prestação: </h5>
                        <p class="card-text" id="mensal"><strong>R$ </strong><br><small id="juros"><?=$Valor_parcela?></small></p>
                    </div>
                </div>
                <div class="card" style="width: 15rem;">
                    <div class="card-body">
                        <h5 class="card-title">Nº de Meses: </h5>
                        <p class="card-text" id="duracao"><strong>Meses: </strong><?=$meses?></p>
                    </div>
                </div>
                <div class="card" style="width: 15rem;">
                    <div class="card-body">
                        <h5 class="card-title">Juros Pagos: </h5>
                        <p class="card-text" id="juros_recebidos"><strong>R$ </strong><?=$Valor_juros;?></p>
                    </div>
                </div>
                <div class="card" style="width: 15rem;">
                    <div class="card-body">
                        <h5 class="card-title">Valor Total c/ Juros: </h5>
                        <p class="card-text" id="a_receber"><strong>R$ </strong><?=$valor_total;?></p>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>