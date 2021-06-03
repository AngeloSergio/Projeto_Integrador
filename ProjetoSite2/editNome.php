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
$query = mysqli_query($con, "SELECT Nome FROM usuario WHERE IDUsuario = $sessao");
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
            <label for="">Novo nome: </label>
            <?php
            echo "<input name='nome' type='text' placeholder='Digite seu novo nome' value='$reg[Nome]'>";
            ?>
            <input id="in" name="alterar" type="submit" value="Alterar">

            <?php 
                if (isset($_POST['alterar'])) {
                    if ($_POST['nome'] == "") {
                        ?>
                        <script>
                            window.alert("Por favor, insira um nome válido.");
                        </script>
                        <?php
                    } else {
                        $u->conectar("bancodedados", "localhost", "root", "");
                        $nome = addslashes($_POST['nome']);
                        if ($u->AlterarNome($nome) == true) {
                            ?>
                            <script>
                            window.alert("Nome alterado com sucesso!");
                            </script>
                            <?php
                        }
                    }
                }
            ?>
        </form>
    </div>
</body>
</html>