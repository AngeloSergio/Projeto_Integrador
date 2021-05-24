<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
    <div id="corpo-form-cad">
        <h1 id="h1-cad">CADASTRAR</h1>
        <form id="form-cadastro" method="POST">
            <input type="text" name= "nome" placeholder="Digite seu nome" maxlength ="30">
            <input type="email" name= "email" placeholder="Digite seu email" maxlength="30">
            <input type="password" name= "senha" placeholder="Digite sua senha" maxlength="15">
            <input type="password" name= "confsenha" placeholder="Confirme sua senha" maxlength="15">
            <input type="submit" value="CADASTRAR">
            <a href="login.php">Já tem uma conta? <strong>Logar-se</strong></a>
        </form>
    </div>

<?php 
    require_once 'usuarios.php';
    $u = new Usuario;
?>

<?php 
        //verificar se clicou no botão 
    if (isset($_POST['nome'])) {
        $nome = addslashes($_POST['nome']);
        $email = addslashes($_POST['email']);
        $senha = addslashes($_POST['senha']);
        $confirmarsenha = addslashes($_POST['confsenha']);

        //verificar se está vazio

        if(!empty($nome) && !empty($email) && !empty($senha) && !empty($confirmarsenha)) {
            $u->conectar("bancodedados", "localhost", "root", "");
            if ($u->msgErro == "") {
                if ($senha == $confirmarsenha) {
                    if ($u->cadastrar($nome, $email, $senha)) {
                    ?>

                        <div id="msg-sucesso"> 
                        Cadastrado com sucesso! Acesse para entrar!
                        </div>

                    <?php
                    } else {
                    ?>
                        <div class="msg-erro"> 
                        E-mail já cadastrado! 
                        </div>
                    <?php
                    }
                } else {
                    ?>
                        <div class="msg-erro"> 
                        Senha e confirmar senha não correspondem!
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