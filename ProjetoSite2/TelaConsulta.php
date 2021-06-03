<?php
header('Content-Type: text/html; charset=utf-8');    

  require_once 'usuarios.php';
  session_start();
  
  $u = new Usuario;
  if (!isset($_SESSION['IDUsuario'])) {
    header("location: /login.php");
    exit();
  }
  $sessao = $_SESSION['IDUsuario'];

# Substitua abaixo os dados, de acordo com o banco criado
$user = "root"; 
$password = ""; 
$database = "bancodedados"; 
# O hostname deve ser sempre localhost 
$hostname = "localhost"; 
# Conecta com o servidor de banco de dados 
$con = mysqli_connect($hostname, $user, $password) or die ('Erro na conexão');
?>

<?php 
# Seleciona o banco de dados 
mysqli_select_db($con, $database) or die ("Erro na conexão do banco");
?>

<?php 
# Executa a query desejada $query = "SELECT codigo,nome,endereco FROM tabela"; 
$query = mysqli_query($con, "SELECT NomePesquisa, palavraChave, TempoInicioPesquisa, TempoFimPesquisa, Descricao FROM pesquisa WHERE NomePesquisa = '$_SESSION[pesquisa]'");
$reg = mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultar pesquisa</title>
    <link rel="stylesheet" href="TelaConsulta.css">
</head>
<body>
    <div id="div1">
      <a href="TelaInicial.php">Voltar para o menu inicial</a>
        
        
        <div id="np">
          <h2><?=$reg['NomePesquisa']?></h2>
          <button onclick="window.location.href='http://localhost:3000/editNomePesquisa.php'">Editar</button>
        </div>
        <p></p>
        <div id="div2">

                
            <p><label for=''>Palavra chave:  <?=$reg['palavraChave']?></label></p>
           <!--Colocar a variavel com o nome da pesquisa dentro deste label-->
           <br>
          
                
            <p><label for=''>Data-inicio:  <?=$reg['TempoInicioPesquisa']?></label></p>
           <!--Se possivel inserir a data dentro deste label-->
           <br>
                
            <p><label for=''>Data-fim:  <?=$reg['TempoFimPesquisa']?></label></p>
            <!--Se possivel inserir a data dentro deste label-->
            <button onclick="window.location.href='http://localhost:3000/editDataFim.php'">Editar</button>
            <br>
            
            <p><label for=''>Descrição:  <?=$reg['Descricao']?></label></p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis error magni praesentium saepe tempora repellendus necessitatibus fugiat labore cupiditate culpa esse, nulla earum, beatae temporibus vero dolor non minus consectetur!</p>
            <button onclick="window.location.href='http://localhost:3000/editDescricao.php'">Editar</button>
            <!--Inserir a descrição da pesquisa dentro do paragrafo-->
        </div>

      <!--AQUI FICA O GRÁFICO DA PESQUISA-->
      <div id="div3">
                <html>
          <head>
            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
            <script type="text/javascript">
              google.charts.load('current', {'packages':['corechart']});
              google.charts.setOnLoadCallback(drawChart);

              function drawChart() {
                var data = google.visualization.arrayToDataTable([
                  ['data', 'Adultto Ney'],
                  ['30/06/2021',  10],
                  ['31/06/2021',  23],
                  ['01/06/2021',  7],
                ]);

                var options = {
                  title: 'Quantidade e dias que a palavra mais apareceu',
                  curveType: 'function',
                  legend: { position: 'bottom' }
                };

                var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

                chart.draw(data, options);
              }
            </script>
          </head>
          <body>
            <div id="curve_chart" style="width: 750px; height: 500px"></div>
          </body>
        </html>
      </div>
    </div>
</body>
</html>