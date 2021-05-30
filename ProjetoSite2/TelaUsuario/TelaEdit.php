<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configurações da conta</title>

    <link rel="stylesheet" href="style.css">
</head>
<body>
    <button id="bVoltar" onclick="window.location.href='TelaInicio.php'">Voltar</button>
    <form>
        <div id="divPrincipal">
            <h2>Edite apenas os dados que deseja alterar</h2>
            <span>
                <h3>Nome: </h3>
                <input type="text" placeholder="Digite o seu nome">
            </span>

            <span>
                <h3>Sobrenome: </h3>
                <input type="text" placeholder="Digite o seu sobrenome">
            </span>

            <span>
                <h3>E-Mail: </h3>
                <input id="em" type="text" placeholder="Digite o seu E-Mail">
            </span>

            <span>
                <h3>Senha: </h3>
                <input type="password" placeholder="Digite a sua nova senha">
            </span>

            <span>
                <h3>Confirme a senha: </h3>
                <input type="password" placeholder="Confirme sua nova senha">
            </span>
            <div>
                <button class="botoes" onclick="window.location.href='http://127.0.0.1:5500/TelaUsuario/telaInicio.html'"> Salvar alterações</button>
            </div>
        </div>
    </form>
</body>
</html>