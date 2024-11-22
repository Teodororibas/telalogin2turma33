<?php
require_once 'usuario.php';
 
$usuario = new Usuario();
$usuario->conectar("cadastrousuarioturma33", "localhost", "root", "");
 
// Verifique se ocorreu algum erro na conexão
if (!empty($usuario->msgErro)) {
    echo "Erro: " . $usuario->msgErro;
    exit;
}
 
// Obtenha a lista de usuários
$usuarios = $usuario->listarUsuarios();
?>
 
<!DOCTYPE html>
<html lang="pt-br">
 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuários</title>
</head>
 
<body>
    <h2>Usuários Cadastrados</h2>
 
    <?php if (!empty($usuarios)): ?>
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Telefone</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ur6suarios as $user): ?>
                    <tr>
                        <td><?= htmlspecialchars($user['id_usuario']) ?></td>
                        <td><?= htmlspecialchars($user['nome']) ?></td>
                        <td><?= htmlspecialchars($user['email']) ?></td>
                        <td><?= htmlspecialchars($user['telefone']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
 
    <?php else: ?>
        <p>Nenhum usuário encontrado.</p>
    <?php endif; ?>
 
 
</body>
 
</html>