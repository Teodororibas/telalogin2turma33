<?php
require_once 'usuario.php';
$usuario = new Usuario();
$usuario->conectar("cadastrousuarioturma33", "localhost", "root", "");

if(isset($_POST['id_usuario'])) {
    // Recuperar os dados do POST
    $id = (int) $_POST['id_usuario'];
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Chamar o método de edição
    if ($usuario->editar($id, $nome, $telefone, $email, $senha)) {
        echo "Usuário editado com sucesso";
    } else {
        echo "Erro ao editar o usuário";
    }
} else {
    echo "ID do usuário não fornecido";
}
?>
