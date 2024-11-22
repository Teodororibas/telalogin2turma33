<?php
require_once 'usuario.php';
$usuario = new Usuario();
$usuario->conectar("cadastrousuarioturma33", "localhost", "root", "");

if(isset($_POST['id_usuario'])){
    $id = (int) $_POST['id_usuario'];
    $usuario->excluir($id);
    echo "Usuario deletado";
}
else{
    echo "Usuario não encontrado";
}

?>