<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultar pesquisa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div id="div1">
      <a href="">Voltar para o menu inicial</a>
        <h2>'nome_pesquisa'</h2>
        <p></p>
        <div id="div2">
            <p><label for="">Palavra chave: </label></p> <!--Colocar a variavel com o nome da pesquisa dentro deste label-->

            <p><label for="">Data-inicio: </label></p> <!--Se possivel inserir a data dentro deste label-->
            <p><label for="">Data-fim</label></p> <!--Se possivel inserir a data dentro deste label-->
            <button>Editar</button>

            <p><label for="">Descrição: </label></p>
            <p></p> <!--Inserir a descrição da pesquisa dentro do paragrafo-->
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