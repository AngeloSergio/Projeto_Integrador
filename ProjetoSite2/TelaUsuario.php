<?php 
    session_start();
    if (!isset($_SESSION['IDUsuario'])) {
        header("location: /login.php");
        exit();
    }
require_once 'usuarios.php';    
$u = new Usuario;
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
$query = mysqli_query($con, "SELECT Nome, Email, Senha FROM usuario WHERE IDUsuario = $sessao");
$reg = mysqli_fetch_array($query); 
?>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configurações da conta</title>

    <link rel="stylesheet" href="TelaUsuario.css">
</head>
<body>
    <form method="POST">
    <div id="divPrincipal">
        <h2>Aqui ficam os dados da sua conta</h2>
        <span>
            <h3>Nome: </h3>
            <!--Utilizar comando em PHP pra exibir a variável do banco-->
            <strong>
                <?php echo utf8_encode($reg['Nome']);?>
            </strong>
            <?php
                if (isset($_POST['editarNome'])) {
                    $nome = $reg['Nome'];
                    $_SESSION['Nome'] = $nome;
                    header("location: editNome.php");
                } 
                
                        ?>
            <button name="editarNome" onclick="window.location.href='http://localhost:3000/editNome.php'">Editar</button>
            
        </span>

        <span>
            <h3>E-Mail: </h3>
            <strong>
               <?php echo utf8_encode($reg['Email']);?>
            </strong>
            <?php
                if (isset($_POST['editarEmail'])) {
                    $email = $reg['Email'];
                    $_SESSION['Email'] = $email;
                    header("location: editEmail.php");
                } 
                
                        ?>
            <button name="editarEmail">Editar</button>
        </span>

        <span>
            <h3>Senha: </h3>
            <strong>
                Sua senha
            </strong>
            <?php
                if (isset($_POST['editarSenha'])) {
                    $senha = $reg['Senha'];
                    $_SESSION['Senha'] = $senha;
                    header("location: editSenha.php");
                } 
            ?>
            <button name="editarSenha">Editar</button>
        </span>
        <button name="voltar" class="botoes">Voltar para o inicio </button>
        <?php 
            if (isset($_POST['voltar'])) {
                header("location: http://localhost/ProjetoSite2/Projeto/TelaInicial.php");
            }
        ?>
    </div>
    </form>
</body>
</html>