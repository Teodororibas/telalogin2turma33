<?php
    require_once 'usuario.php';
    $usuario = new Usuario();
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela Cadastro</title>
</head>
<body>
    <h2>CADASTRO DE USUARIO</h2><br>
    <form action="" method="post">
        <label>Nome:</label><br>
        <input type="text" name="nome" id="" placeholder="Nome Completo"><br>

        <label>Email:</label><br>
        <input type="text" name="email" id="" placeholder="digite seu email"><br>

        <label>Telefone:</label><br>
        <input type="text" name="telefone" id="" placeholder="telefone completo"><br>

        <label>Senha:</label><br>
        <input type="text" name="senha" id="" placeholder="digite sua senha"><br>

        <label>Confirmar Senha:</label><br>
        <input type="text" name="confSenha" id="" placeholder="confirme sua senha"><br><br>

        <input type="submit" value="CADASTRAR">

    </form>

    <?php

        if(isset($_POST['nome']))
        {
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $telefone = $_POST['telefone'];
            $senha = $_POST['senha'];
            $confSenha = addslashes($_POST['confSenha']);

            if(!empty($nome) && !empty($email) && !empty($telefone) && !empty($senha) && !empty($confSenha))
            {
                $usuario->conectar("cadastrousuarioturma33", "localhost", "root", "");
                if($usuario->msgErro == "")
                {

                    if($senha == $confSenha)
                    {
                        if($usuario->cadastrar($nome, $telefone, $email, $senha))
                        {
                            ?>
                                <!-- bloco de HTML -->
                                <div class="msg-sucesso">
                                    <p>Cadastrado com Sucesso</p>
                                    <p>Clique <a href="login.php">aqui </a>para logar.</p>
                                </div>
                            <?php
                        }
                    }

                }
                else
                {
                    echo "tente outra vez".$usuario->msgErro;
                }
            }
        }
    ?>

</body>
</html>