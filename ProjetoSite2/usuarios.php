<?php 
Class Usuario {
    private $pdo;
    public $msgErro = "";
    public function conectar ($nome, $host, $usuario, $senha) {
        global $pdo;
        global $msgErro;
        try {
            $pdo = new PDO("mysql:dbname=".$nome.";host:". $host, $usuario, $senha);
        } catch (PDOException $e) {
            $msgErro = $e -> getMessage();      
        }
    }
    public function cadastrar ($nome, $email, $senha) {
        global $pdo;
        //Verificar se já existe o email cadastrado
        $sql = $pdo->prepare ("SELECT IDUsuario FROM Usuario WHERE Email = :e");
        $sql->bindValue(":e",$email);
        $sql->execute();
        if($sql->RowCount() > 0){
            return false; // já está cadastrada
        } else {
            //Caso não, cadastrar
            $sql = $pdo->prepare("INSERT INTO Usuario (Nome, Email, Senha) VALUES (:n, :e, :s)");
            $sql->bindValue(":n",$nome);
            $sql->bindValue(":e",$email);
            $sql->bindValue(":s",md5($senha));
            $sql->execute();
            return true;
        }
    }
    public function logar ($email, $senha) {
        global $pdo;
        //verificar se o email e senha estão cadastrados, se sim
        $sql = $pdo->prepare("SELECT IDUsuario FROM Usuario WHERE Email= :e AND Senha = :s");
        $sql->bindValue(":e",$email);
        $sql->bindValue(":s",md5($senha));
        $sql->execute();
        if($sql->RowCount() > 0){
            //entrar no sistema (sessão)
            $dado = $sql->fetch();
            session_start();
            $_SESSION['IDUsuario'] = $dado['IDUsuario'];
            return true;
        } else {
            return false;
        }
    }
?>