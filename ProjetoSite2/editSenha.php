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
$query = mysqli_query($con, "SELECT Senha FROM usuario WHERE IDUsuario = $sessao");
$reg = mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edite seu nome de usuário</title>
</head>

<link rel="stylesheet" href="edit.css">
<body>
    <a href="http://localhost/ProjetoSite2/Projeto/TelaUsuario.php">Voltar para as configurações</a>
    <div>
        <form action="" method="POST">
            <h2>Edite seus dados</h2>
            <label for="">Nova senha: </label>
            <?php
            echo "<input name='senha' type='password' placeholder='Digite sua nova senha'><p>";
            ?>
            <label for="">Confirmar senha: </label>
            <?php
            echo "<input name='confsenha' type='password' placeholder='Confirme a nova senha'<p>";
            ?>
            <input id="in" name="alterar" type="submit" value="Alterar">

            <?php 
                if (isset($_POST['alterar'])) {
                    if ($_POST['senha'] == "") {
                        ?>
                        <script>
                            window.alert("Por favor, insira uma senha válida.");
                        </script>
                        <?php
                    } else if ($_POST['senha'] != $_POST['confsenha']) {
                        ?>
                        <script>
                            window.alert("Senha e confirmar senha não correspondem.");
                        </script>
                        <?php
                    } else {
                        $u->conectar("bancodedados", "localhost", "root", "");
                        $senha = addslashes($_POST['senha']);
                        $u->AlterarSenha($senha);
                            ?>
                            <script>
                            window.alert("Senha alterada com sucesso!");
                            </script>
                            <?php
                        
                    }
                }
            ?>
        </form>
    </div>
</body>
</html>