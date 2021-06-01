<?php 
    session_start();
    if (!isset($_SESSION['IDUsuario'])) {
        header("location: /login.php");
        exit();
    }
$sessao = $_SESSION['IDUsuario']; 
?>
<?php 
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
$ListaQuery = mysqli_query($con, "SELECT NomePesquisa FROM pesquisa WHERE fk_Usuario_IDUsuario = $sessao");
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesquisas</title>

    <link rel="stylesheet" href="style.css">
</head>
<body>
    <button class="contaConfig" onclick="window.location.href='http://localhost/ProjetoSite2/Projeto/TelaUsuario/TelaInicio.php'">Configurações da conta</button>
    <div id="div1">
        
        <?php
            while ($reg = mysqli_fetch_array($query))
            echo "Seja bem vindo, $reg[Nome] <p>";
        ?>
        
        
        
        <div id="div2">
            <h3>Suas pesquisas recentes:</h3>
            <p>Selecione as pesquisas que você deseja consultar</p>

            <div id="divList">
                <form id="formList">
                   
                <?php 
                    while($reg = mysqli_fetch_assoc($ListaQuery))
                        echo "<p><input name='op' type='radio'> $reg[NomePesquisa]</p>";
                ?>
                

                    
                </form>
                <button class="bList">Editar pesquisa</button>
                <button class="bList">Consultar o gráfico</button>
                <button id="bExcluir">Excluir pesquisa</button>
            </div>
        </div>

        <div id="criarPesq">
            <h3>Nova pesquisa</h3>
            <p>Clique no botão abaixo para realizar uma nova pesquisa:</p>
            <button class="bList" onclick="window.location.href='http://localhost/ProjetoSite2/Projeto/TelaPesquisa/inicio.php'">Criar pesquisa</button>
        </div>
    </div>
</body>
</html>