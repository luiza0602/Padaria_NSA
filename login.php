
<?php
session_start();
require 'includes/bd-padariansa.php';
 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 
    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';
 
    if (!$email || !$senha) {
        die('Preencha e-mail e senha.');
    }
 
    $stmt = $pdo->prepare('SELECT id_usuario, nome, email, telefone, endereco, senha FROM usuarios WHERE email = ?');
    $stmt->execute([$email]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
 
    if (!$usuario || !password_verify($senha, $usuario['senha'])) {
        die('E-mail ou senha incorretos.');
    }
 
    // usuário autenticado
    $_SESSION['usuario_id'] = $usuario['id_usuario'];
    $_SESSION['usuario_nome'] = $usuario['nome'];
    $_SESSION['usuario_email'] = $usuario['email'];
    $_SESSION['usuario_telefone'] = $usuario['telefone'];
    $_SESSION['usuario_endereco'] = $usuario['endereco'];
 
    if (isset($_POST['lembrar'])) {
        setcookie('lembrar_email', $email, time() + (30 * 24 * 60 * 60), '/');
    }
 
    header('Location: index.php');
    exit;
}
 
 
?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Entrar - Padaria NSA</title>

    <!-- css -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/autentificacao.css">

    <!-- icones -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <!-- fontes -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Poppins:wght@300;400;600;700&display=swap"
        rel="stylesheet">

</head>

<body class="auth-body">

    <div class="auth-box">

        <!--lado logo-->
        <div class="auth-lado">
            <img src="assets/img/logo.png" alt="Logo Padaria NSA">
        </div>

        <!-- form -->
        <div class="auth-conteudo">

            <h1>Bem-vindo de volta</h1>
            <p class="auth-subtitulo">Entre com sua conta para continuar</p>

            <form class="auth-form" id="form-login" action="login.php" method="POST">

                <div class="campo">
                    <label for="login-email">E-mail</label>
                    <div class="input-icone">
                        <i class="fa-regular fa-envelope"></i>
                        <input type="email" id="login-email" name="email" placeholder="seu@email.com" required>
                    </div>
                </div>

                <div class="campo">
        <label for="login-senha">Senha</label>
        <div class="input-icone">
            <i class="fa-solid fa-lock"></i>
            <input type="password" id="login-senha" name="senha" placeholder="Mínimo de 6 dígitos" minlength="6" required>
        <i class="fa-regular fa-eye toggle-senha"></i>
    </div>
    <a href="esqueci-senha.php" style="font-size:0.82rem;color:var(--vinho);font-weight:600;text-transform:none;">Esqueceu a senha?</a>
</div>



                <div class="auth-opcoes">
                    <label class="lembrar">
                        <input type="checkbox" id="lembrar" name="lembrar">
                        Lembrar de mim
                    </label>
                     
                </div>

             

                <button type="submit" class="btn-auth">Entrar</button>

                <div class="auth-divisor"></div>

                

                <p class="auth-rodape">
                    Ainda não possui uma conta? <a href="cadastro.php">Cadastre-se</a>
                </p>

                <a href="index.php" class="auth-voltar">
                    <i class="fa-solid fa-arrow-left"></i> Voltar para a página inicial
                </a>

            </form>

        </div>

    </div>

    <script src="assets/js/autentificacao.js"></script>

</body>

</html>
