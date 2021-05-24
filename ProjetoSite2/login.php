<?php 
require_once 'usuarios.php';
$u = new Usuario;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <div id="corpo-form">
        <h1>ENTRAR</h1>
        <form method="POST">
            <input type="email" name= "email" placeholder="E-mail">
            <input type="password"  name= "senha" placeholder="Senha">
            <input href="AreaPrivada.php" type="submit" value="ACESSAR">
            <a href="cadastrar.php">Ainda não é inscrito? <strong>Cadastre-se!</strong></a>
        </form>
    </div>
<?php 
 if (isset($_POST['email'])) {
    $email = addslashes($_POST['email']);
    $senha = addslashes($_POST['senha']);
    

    if(!empty($email) || !empty($senha))
    {
        $u->conectar("bancodedados", "localhost", "root", "");
        if ($u->msgErro == "") 
        {
            if($u->logar($email, $senha)) 
            {
                header("location: AreaPrivada.php");
            } 
            else 
            {
            ?>
            <div class="msg-erro"> 
                E-mail e/ou senha estão incorretos!
            </div>
                
            <?php
            }
        } 
        else 
        {
        ?>
            <div class="msg-erro">
                <?php echo "Erro: ".$u->msgErro; ?>
            </div>
        <?php 
        }    
            
    } 
    else 
    {
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