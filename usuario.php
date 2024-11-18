<?php
Class Usuario
{
    private $pdo;
    public $msgErro = "";
 
    public function conectar($nome, $host, $usuario, $senha)
    {
        try
        {
            $this->pdo = new PDO("mysql:dbname=".$nome.";host=".$host, $usuario, $senha);
        }
        catch (PDOException $erro)
        {
            $this->msgErro = $erro->getMessage();
        }
    }
 
    public function cadastrar($nome, $telefone, $email, $senha)
    {
        // Verificar se o email já está cadastrado
        $sql = $this->pdo->prepare("SELECT id_usuario FROM usuario WHERE email = :m");
        $sql->bindValue(":m", md5($email)); // Usando md5, mas recomendamos usar password_hash para maior segurança
        $sql->execute();
 
        // Verificar se existe o email cadastrado
        if ($sql->rowCount() > 0)
        {
            return false;
        }
        else
        {
            $sql = $this->pdo->prepare("INSERT INTO usuario (nome, telefone, email, senha) VALUES (:n, :t, :e, :s)");
            $sql->bindValue(":n", $nome);
            $sql->bindValue(":t", $telefone);
            $sql->bindValue(":e", $email);
            $sql->bindValue(":s", md5($senha)); // Usando md5, mas recomendamos usar password_hash para maior segurança
            $sql->execute();
            return true;
        }
    }
 
    public function logar($email, $senha)
    {
        $verificarEmail = $this->pdo->prepare("SELECT id_usuario, senha FROM usuario WHERE email = :e");
        $verificarEmail->bindValue(":e", $email);
        $verificarEmail->execute();
 
        if ($verificarEmail->rowCount() > 0)
        {
            $dados = $verificarEmail->fetch();
            // Verifica se a senha corresponde (usando password_hash seria password_verify)
            if (md5($senha) == $dados['senha'])
            {
                session_start();
                $_SESSION['id_usuario'] = $dados['id_usuario'];
                return true;
            }
        }
        return false;
    }
 
    public function listarUsuarios()
    {
        $sqlListar = $this->pdo->prepare("SELECT * FROM usuario");
        $sqlListar->execute();
 
        if ($sqlListar->rowCount() > 0)
        {
            $dados = $sqlListar->fetchAll(PDO::FETCH_ASSOC);
            return $dados;
        }
        else
        {
            return false;
        }
    }
 
    public function excluir($id)
    {
        // Verifica se o usuário com esse ID existe
        $sql = $this->pdo->prepare("SELECT id_usuario FROM usuario WHERE id_usuario = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();
 
        if ($sql->rowCount() > 0)
        {
            // Exclui o usuário com o ID fornecido
            $sql = $this->pdo->prepare("DELETE FROM usuario WHERE id_usuario = :id");
            $sql->bindValue(":id", $id);
            $sql->execute();
            return true; // Usuário excluído com sucesso
        }
        else
        {
            return false; // Usuário não encontrado
        }
    }
}
?>