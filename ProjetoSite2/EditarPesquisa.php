<?php 
    header('Content-Type: text/html; charset=utf-8');
    session_start();
    if (!isset($_SESSION['IDUsuario'])) {
        header("location: /login.php");
        exit();
    }
require_once 'usuarios.php';    
$u = new Usuario;
$sessao = $_SESSION['IDUsuario'];
?>

<?php
$user = "root"; 
$password = ""; 
$database = "bancodedados"; 
$hostname = "localhost"; 
 
$con = mysqli_connect($hostname, $user, $password) or die ('Erro na conexão');
 
mysqli_select_db($con, $database) or die ("Erro na conexão do banco");

$query = mysqli_query($con, "SELECT * FROM pesquisa WHERE NomePesquisa = '$_SESSION[pesquisa]'");
$reg = mysqli_fetch_array($query);
?> 
 

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edite a pesquisa</title>

    <link rel="stylesheet" href="CriarPesquisa.css">
</head>
<body>
    <button id="voltar" onclick="window.location.href='http://localhost/ProjetoSite2/Projeto/TelaInicial.php'">Voltar</button>
    <div>
        <form action="" method="POST">
            <h2>Editar pesquisa <?php ?></h2>
            
            <!--Nome da pesquisa-->
            <label for="">Nome da pesquisa</label>
            <?php echo utf8_encode("<input type='text' name='nomePesquisa' value='$reg[NomePesquisa]' placeholder='Digite um nome para sua pesquisa' maxlength='30'>")?>
            
            <!--Palavra-chave-->
            <label for="">Palavra-chave</label>
            <?php echo utf8_encode("<input type='text' name='palavraChave' value='$reg[palavraChave]' placeholder='Digite a palavra que deseja pesquisar' maxlength='20'>")?>
            
            <!--Datas da pesquisa-->
            <label for="">Data-inicio</label>
            <?php echo "<input type='date' name='dataInicio' value='$reg[TempoInicioPesquisa]'min='2021-01-01' max='2021-12-31'>"?>

            <label for="">Data-fim</label>
            <?php echo "<input type='date' name='dataFim' value='$reg[TempoFimPesquisa]'min='2021-01-01' max='2021-12-31'>"?>
            
            <!--Descrição da pesquisa-->
            <label for="">Descrição</label>
            <?php echo utf8_encode("<input id='desc' type='text' name='descricao' value='$reg[Descricao]' placeholder='Dê os detalhes da sua pesquisa' maxlength=100>")?>
            
            <!--Botão de confirmar a pesquisa-->
            <input type="submit" name="EditarPesquisa" value="ALTERAR" id="btnPesquisar">
        </form>
    </div>
</body>
</html>

<?php 
    if (isset($_POST['EditarPesquisa'])) {
        $NomePesquisa = addslashes($_POST['nomePesquisa']);
        $PalavraChave = addslashes($_POST['palavraChave']);
        $DataInicio = addslashes($_POST['dataInicio']);
        $DataFim = addslashes($_POST['dataFim']);
        $Descricao = addslashes($_POST['descricao']);
        if (!empty($NomePesquisa) && !empty($PalavraChave) && !empty($DataInicio) && !empty($DataFim) && !empty($Descricao)) {
            $u->conectar("bancodedados", "localhost", "root", "");
            $u->EditarPesquisa($NomePesquisa, $PalavraChave, $DataInicio, $DataFim, $Descricao, $reg['IDPesquisa'])
                ?>
                <script>
                window.alert("Pesquisa editada com sucesso!");
                </script>
                <?php    
            
        } else {
            ?> 
            <script>
            window.alert("Nenhum dos campos pode estar em branco, por favor, preencha-os!");
            </script>
            <?php
        }
    }
?>