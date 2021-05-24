<?php 
    session_start();
    if (!isset($_SESSION['IDUsuario'])) {
        header("location: index.php");
        exit();
    } 
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesquisas</title>

    <link rel="stylesheet" href="css/TelaInicial.css">
</head>
<body>
    <button class="contaConfig" onclick="window.location.href='http://127.0.0.1:5500/TelaUsuario/telaInicio.html'">Configurações da conta</button>
    <div id="div1">
        
        <h2> Olá, seja bem vindo! </h2>
        
        
        <div id="div2">
            <h3>Suas pesquisas recentes:</h3>
            <p>Selecione as pesquisas que você deseja consultar</p>

            <div id="divList">
                <form id="formList">
                    <p><input name="op" type="radio"> Pesquisa1</p>
                    <p><input name="op" type="radio"> Pesquisa2</p>
                    <p><input name="op" type="radio"> Pesquisa3</p>
                    <p><input name="op" type="radio"> Pesquisa4</p>
                    <p><input name="op" type="radio"> Pesquisa5</p>
                </form>
                <button class="bList">Editar pesquisa</button>
                <button class="bList">Consultar o gráfico</button>
                <button id="bExcluir">Excluir pesquisa</button>
            </div>
        </div>

        <div id="criarPesq">
            <h3>Nova pesquisa</h3>
            <p>Clique no botão abaixo para realizar uma nova pesquisa:</p>
            <button class="bList" onclick="window.location.href='http://127.0.0.1:5500/TelaPesquisa/inicio.php'">Criar pesquisa</button>
        </div>
    </div>
</body>
</html>