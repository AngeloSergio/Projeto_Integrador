<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crie uma pesquisa</title>

    <link rel="stylesheet" href="style.css">
</head>
<body>
    <button id="voltar" onclick="window.location.href='http://127.0.0.1:5500/TelaInicial/inicio.html'">Voltar</button>
    <div>
        <form action="" method="POST">
            <h2>Criar pesquisa</h2>
            <!--Nome da pesquisa-->
            <label for="">Nome da pesquisa</label>
            <input type="text" name="nomePesquisa" placeholder="Digite um nome para sua pesquisa" maxlength="30">
            <!--Palavra-chave-->
            <label for="">Palavra-chave</label>
            <input type="text" name="palavraChave" placeholder="Digite a palavra que deseja pesquisar" maxlength="20">
            <!--Datas da pesquisa-->
            <label for="">Data-inicio</label>
            <input type="date" name="dataInicio">

            <label for="">Data-fim</label>
            <input type="date" name="dataFim">
            <!--Descrição da pesquisa-->
            <label for="">Descrição</label>
            <input id="desc" type="text" name="descricao" placeholder="Dê os detalhes da sua pesquisa" maxlength="100">
            <!--Botão de confirmar a pesquisa-->
            <input type="submit" value="PESQUISAR" id="btnPesquisar">
        </form>
    </div>
</body>
</html>