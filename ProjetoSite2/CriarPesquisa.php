<?php header('Content-Type: text/html; charset=utf-8') ?> 
 

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crie uma pesquisa</title>

    <link rel="stylesheet" href="CriarPesquisa.css">
</head>
<body>
    <button id="voltar" onclick="window.location.href='http://localhost/ProjetoSite2/Projeto/TelaInicial.php'">Voltar</button>
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
            <input type="date" name="dataInicio" min="2021-01-01" max="2021-12-31">

            <label for="">Data-fim</label>
            <input type="date" name="dataFim" min="2021-01-01" max="2021-12-31">
            <!--Descrição da pesquisa-->
            <label for="">Descrição</label>
            <input id="desc" type="text" name="descricao" placeholder="Dê os detalhes da sua pesquisa" maxlength="100">
            <!--Botão de confirmar a pesquisa-->
            <input type="submit" name="CriarPesquisa" value="CRIAR PESQUISA" id="btnPesquisar">
        </form>
    </div>

    <?php 
        require_once 'usuarios.php';
        $u = new Usuario;
        
        session_start();
        if (!isset($_SESSION['IDUsuario'])) {
            header("location: /login.php");
            exit();
        }
        $sessao = $_SESSION['IDUsuario'];
    ?>
    <?php
    //verificar se clicou no botão 
    if (isset($_POST['CriarPesquisa'])) {
        $NomePesquisa = addslashes($_POST['nomePesquisa']);
        $palavraChave = addslashes($_POST['palavraChave']);
        $TempoInicioPesquisa = addslashes(date('Ymd',strtotime($_POST['dataInicio'])));
        $TempoFimPesquisa = addslashes(date('Ymd',strtotime($_POST['dataFim'])));
        $descricao = addslashes($_POST['descricao']);
        if(!empty($NomePesquisa) && !empty($palavraChave) && !empty($TempoInicioPesquisa) && !empty($TempoFimPesquisa) && !empty($descricao)) {
            $u->conectar("bancodedados", "localhost", "root", "");
            if ($u->msgErro == "") {
                if ($u->CadastrarPesquisa($NomePesquisa, $palavraChave, $TempoInicioPesquisa, $TempoFimPesquisa, $descricao, $sessao)) {
                    ?>
                        <div id="msg-sucesso"> 
                        Pesquisa criada com sucesso!
                        </div>
                    <?php
                } else {
                    ?>
                        <div class="msg-erro"> 
                        Nome de pesquisa ou palavra chave já cadastrado(s)! 
                        </div>
                    <?php
                } 
            } else {
            ?>
            <div class="msg-erro"> 
            <?php echo "Erro: ".$u->msgErro; ?> 
            </div>
            <?php
            }
        } else {
        ?>
            <div class="msg-erro"> 
            Preencha todos os campos! 
            </div>
        <?php
        }
    }
    ?>
</body>
</html>