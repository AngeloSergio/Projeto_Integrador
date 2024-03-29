<?php 
Class Usuario {
    private $pdo;
    public $msgErro = "";
    public function conectar ($nome, $host, $usuario, $senha) {
        global $pdo;
        global $msgErro;
        try {
            $pdo = new PDO("mysql:dbname=".$nome.";host:". $host, $usuario, $senha,
            array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_PERSISTENT => false,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
            ));
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
    public function CadastrarPesquisa ($NomePesquisa, $palavraChave, $TempoInicioPesquisa, $TempoFimPesquisa, $descricao, $fk_Usuario_IDUsuario) {
        global $pdo;
        
        //Verificar se já existe uma pesquisa com o mesmo nome cadastrado.
        $sql = $pdo->prepare ("SELECT NomePesquisa FROM pesquisa WHERE NomePesquisa= :np AND fk_Usuario_IDUsuario = $_SESSION[IDUsuario]");
        $sql->bindValue(":np", $NomePesquisa);
        $sql->execute();
        if($sql->RowCount() > 0){
            return false; // já está cadastrada
        } else {
            //verificar se o usuario já criou uma palavra chave igual no banco
            $sql = $pdo->prepare ("SELECT NomePesquisa FROM pesquisa WHERE palavraChave= :p AND fk_Usuario_IDUsuario = $_SESSION[IDUsuario]");
            $sql->bindValue(":p", $palavraChave);
            $sql->execute();
            if ($sql->RowCount() > 0) {
                return false; // já está cadastrada
            } else {//Caso não, cadastrar
                $sql = $pdo->prepare("INSERT INTO pesquisa (NomePesquisa, palavraChave, TempoInicioPesquisa, TempoFimPesquisa, descricao, fk_Usuario_IDUsuario) VALUES (:np, :p, :tip, :tfp, :d, :fk)");
                $sql->bindValue(":np",$NomePesquisa);
                $sql->bindValue(":p",$palavraChave);
                $sql->bindValue(":tip",$TempoInicioPesquisa);
                $sql->bindValue(":tfp",$TempoFimPesquisa);
                $sql->bindValue(":d",$descricao);
                $sql->bindValue(":fk",$fk_Usuario_IDUsuario);
                $sql->execute();
                return true;
            }
        }
    }
    public function ApagarPesquisa ($Pesquisa) {
        global $pdo;

        $sql = $pdo->prepare("DELETE FROM pesquisa WHERE NomePesquisa = :np");
        $sql->bindValue(":np",$Pesquisa);
        $sql->execute();
        
        return true;
    }
    public function PuxarDadosDoBanco ($Id_Usuario) {
        global $pdo;
        
        $sql = $pdo->prepare("SELECT Nome, Email, Senha FROM usuario WHERE IDUsuario = :id");
        $sql->bindValue(":id",$Id_Usuario);
        $sql->execute();
    }
    public function AlterarNome ($nome) {
        global $pdo;
        
        $sql = $pdo->prepare("UPDATE usuario SET Nome = :n WHERE IDUsuario = $_SESSION[IDUsuario]");
        $sql->bindValue(":n",$nome);
        $sql->execute();    
    }
    public function AlterarEmail ($email) {
        global $pdo;
        
        $sql = $pdo->prepare("UPDATE usuario SET Email = :e WHERE IDUsuario = $_SESSION[IDUsuario]");
        $sql->bindValue(":e",$email);
        $sql->execute();    
    }
    public function AlterarSenha ($senha) {
        global $pdo;
        
        $sql = $pdo->prepare("UPDATE usuario SET Senha = :s WHERE IDUsuario = $_SESSION[IDUsuario]");
        $sql->bindValue(":s",md5($senha));
        $sql->execute();    
    }
    public function EditarPesquisa ($NomePesquisa, $palavraChave, $TempoInicioPesquisa, $TempoFimPesquisa, $descricao, $IDPesquisa) {
        global $pdo;
        $sql = $pdo->prepare ("UPDATE Pesquisa SET NomePesquisa = :np, palavraChave = :pc, TempoInicioPesquisa = :tip, TempoFimPesquisa = :tfp, descricao = :d WHERE IDPesquisa = $IDPesquisa");
        $sql->bindValue(":np",$NomePesquisa);
        $sql->bindValue(":pc",$palavraChave);
        $sql->bindValue(":tip",$TempoInicioPesquisa);
        $sql->bindValue(":tfp",$TempoFimPesquisa);
        $sql->bindValue(":d",$descricao);
        $sql->execute();
    }
}
?>