
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configurações da conta</title>

    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div id="divPrincipal">
        <h2>Aqui ficam os dados da sua conta</h2>
        <span>
            <h3>Nome: </h3>
            <!--Utilizar comando em PHP pra exibir a varivel do banco-->
            <strong>nome_do_usuário</strong>
        </span>

        <span>
            <h3>Sobrenome: </h3>
            <strong>sobrenome_do_usuário</strong>
        </span>

        <span>
            <h3>E-Mail: </h3>
            <strong>email_do_usuário</strong>
        </span>

        <span>
            <h3>Senha: </h3>
            <strong>senha_do_usuário</strong>
        </span>
        <button class="botoes" onclick="window.location.href='http://localhost/ProjetoSite2/Projeto/TelaInicial/inicio.php'">Voltar para o inicio </button>
    </div>
</body>
</html>