<?php 
    require_once 'Classes/usuarios.php';
    $u = new Usuario;
?>

<?php 
//verificar se clicou no botão 
if (isset($_POST['nome'])) {
    $nome = addslashes($_POST['nome']);
    $sobrenome = addslashes($_POST['snome']);
    $email = addslashes($_POST['email']);
    $senha = addslashes($_POST['senha']);
    $confirmarsenha = addslashes($_POST['csenha']);
    //verificar se está vazio
    if(!empty($nome) && !empty($sobrenome) && !empty($email) && !empty($senha) && !empty($confirmarsenha)) {
        $u->conectar("bancodedados", "localhost", "root", "");
        if ($u->msgErro == "") {
            if ($senha == $confirmarsenha) {
                if ($u->cadastrar($nome, $sobrenome, $email, $senha)) {
                    echo "Cadastrado com sucesso! Acesse para entrar!";
                } else {
                    echo "E-mail já cadastrado!";
                }
            } else {
                echo "Senha e confirmar senha não correspondem!";
            }
        } else {
            echo "Erro: ".$msgErro;
        }
    } else {
        echo "Preencha todos os campos!";
    }
}    
?>