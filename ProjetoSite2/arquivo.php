<?php
require_once 'usuarios.php';
session_start();

$u = new Usuario;
if (!isset($_SESSION['IDUsuario'])) {
  header("location: /login.php");
  exit();
}
$sessao = $_SESSION['IDUsuario'];
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


$coleta = mysqli_query($con, "SELECT IDColeta, Dia, qtd FROM coleta WHERE fk_pesquisa_IDPesquisa = 43");

while ($reg = mysqli_fetch_array($coleta)) {
    $data = $reg['Dia'];
    $dataa = date('d/m/Y', strtotime($data));
    echo "'$dataa'", "<p>";
}
?>