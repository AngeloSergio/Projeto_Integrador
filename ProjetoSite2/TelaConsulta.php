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
$query = mysqli_query($con, "SELECT IDPesquisa, NomePesquisa, palavraChave, TempoInicioPesquisa, TempoFimPesquisa, Descricao FROM pesquisa WHERE NomePesquisa = '$_SESSION[pesquisa]'");
$reg = mysqli_fetch_array($query);
$palavrachave = $reg['palavraChave'];
$coleta = mysqli_query($con, "SELECT IDColeta, Dia, qtd FROM coleta WHERE fk_pesquisa_IDPesquisa = '$reg[IDPesquisa]'");

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
        
        <h2><?=$reg['NomePesquisa']?></h2>
        
        <p></p>
        <div id="div2">
          
            <p><label for=''>Palavra chave:  <?php echo utf8_encode($reg['palavraChave'])?></label></p>
           <!--Colocar a variavel com o nome da pesquisa dentro deste label-->
          
            <p><label for=''>Data-inicio:  <?=date('d/m/Y', strtotime($reg['TempoInicioPesquisa']))?></label></p>
           <!--Se possivel inserir a data dentro deste label-->
            <p><label for=''>Data-fim:  <?=date('d/m/Y', strtotime($reg['TempoFimPesquisa']))?></label></p>
            <!--Se possivel inserir a data dentro deste label-->
            
            
            <p><label for=''>Descrição:  <?php echo utf8_encode($reg['Descricao'])?></label></p>
            <p></p>
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
                  ['Data', 'Frequência'],
                  <?php
                  while ($reg = mysqli_fetch_array($coleta)) {
                    $data = $reg['Dia'];
                    $dataa = date('d/m/Y', strtotime($data));
                    $qtd = $reg['qtd'];
                    ?>
                    [<?php echo "'$dataa'"?>, <?php echo $qtd?>],
                    <?php
                  } 
                    ?>
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