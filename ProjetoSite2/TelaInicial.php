<?php 
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
$ListaQuery = mysqli_query($con, "SELECT IDPesquisa, NomePesquisa FROM pesquisa WHERE fk_Usuario_IDUsuario = $sessao ORDER BY NomePesquisa ASC");
$linhas = mysqli_num_rows($ListaQuery);
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesquisas</title>

    <link rel="stylesheet" href="TelaInicial.css">
</head>
<body>
    <div id="config">
        <button class="contaConfig" onclick="window.location.href='http://localhost/ProjetoSite2/Projeto/TelaUsuario.php'">Configurações da conta</button>
        <p id="pzin">ou</p>
        <form method="POST" id="formList">
        <input id="desl" name="deslogar" type="submit" value="Deslogar"></a> </form>
    </div>
    <div id="div1">
        
    <?php
            while ($reg = mysqli_fetch_array($query))
            echo utf8_encode("<h3 id='usuario'>Seja bem vindo, $reg[Nome]</h3> <p>");
        ?>
        
        <div id="div2">
            <h3>Suas pesquisas recentes:</h3>
            <h4>Selecione as pesquisas que você deseja consultar</h4>

            <div id="divList">
                <form method="POST" id="formList">
                <div class='vertical-menu'>  
                <?php 
                if (isset($_POST['deslogar']) == true) {
                    header("location: login.php");
                    exit();
                }
        ?> 
                <?php
                    while($reg = mysqli_fetch_assoc($ListaQuery))
                        echo utf8_encode("<a id='pesquisa'><input name='op' type='radio' value='$reg[NomePesquisa]'>$reg[NomePesquisa]</a>");
                    
                ?>
                </div> 
                <?php
                        if (isset($_POST['excluir'])) {
                            if(isset($_POST['op']) == true) {
                                $u->conectar("bancodedados", "localhost", "root", "");
                                if ($u->msgErro == "") {
                                    if ($u->ApagarPesquisa($_POST['op'])) {
                                        ?>
                                        <script>
                                window.alert("Pesquisa excluída com sucesso!");
                                </script>
                                        <?php 
                                    }
                                } else {
                                ?>
                                <div id="msg-erro"> 
                                <?php echo "Erro: ".$u->msgErro; ?> 
                                </div>
                                <?php
                                }
                            } else {
                                ?>
                                <script>
                                window.alert("Selecione uma pesquisa para excluir!");
                                </script>
                                <?php
                            }
                        }
                        if (isset($_POST['consultar'])) {
                            if(isset($_POST['op']) == true) {
                                $pesquisa = $_POST['op'];
                                $idpesquisa = $reg['IDPesquisa'];
                                $_SESSION['pesquisa'] = $pesquisa;
                                header("location: TelaConsulta.php");
                            } else {
                                ?>
                                <script>
                                window.alert("Selecione uma pesquisa para consultar!");
                                </script>
                                <?php    
                            }
                        }
                        if (isset($_POST['alterar'])) {
                            if (isset($_POST['op']) == true) {
                                $pesquisa = $_POST['op'];
                                $idpesquisa = $reg['IDPesquisa'];
                                $_SESSION['pesquisa'] = $pesquisa;
                                header("location: EditarPesquisa.php");
                            } else {
                                ?>
                                <script>
                                window.alert("Selecione uma pesquisa para editar!");
                                </script>
                                <?php
                            }
                        } 
                    ?>
        
               
                
                
                <button class="bList" name="consultar">Consultar o gráfico</button>
                <button class = "bList" name="exportar">Exportar dados</button>
                <button class="bList" name="alterar">Alterar pesquisa</button>
                <button id="bExcluir"class="bList" name="excluir">Excluir pesquisa</button>
                </form>
                
                <?php
                
                ?>
                
                
                
            </div>
        </div>

        <div id="criarPesq">
            <h3>Nova pesquisa</h3>
            <h4>Clique no botão abaixo para realizar uma nova pesquisa:</h4>
            <div id='botaoCriaPesquisa'>
            <button class="bList" onclick="window.location.href='http://localhost/ProjetoSite2/Projeto/CriarPesquisa.php'">Criar pesquisa</button>
            </div>
        </div>
    </div>
</body>
</html>