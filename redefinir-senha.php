<?php
session_start();
require 'includes/bd-padariansa.php';

$token = $_GET['token'] ?? $_POST['token'] ?? '';

$stmt = $pdo->prepare('SELECT id_usuario FROM usuarios WHERE reset_token = ? AND reset_expira > NOW()');
$stmt->execute([$token]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
    die('Link inválido ou expirado. <a href="esqueci-senha.php">Solicitar um novo</a>.');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $senha = $_POST['senha'] ?? '';
    $confirmaSenha = $_POST['confirma_senha'] ?? '';

    if (strlen($senha) < 6) {
        die('A senha precisa ter no mínimo 6 caracteres.');
    }
    if ($senha !== $confirmaSenha) {
        die('As senhas não coincidem.');
    }

    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare('UPDATE usuarios SET senha = ?, reset_token = NULL, reset_expira = NULL WHERE id_usuario = ?');
    $stmt->execute([$senhaHash, $usuario['id_usuario']]);

    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinir senha - Padaria NSA</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/autentificacao.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
</head>
<body class="auth-body">

    <div class="auth-box">
        <div class="auth-lado">
            <img src="assets/img/logo.png" alt="Logo Padaria NSA">
        </div>

        <div class="auth-conteudo">
            <h1>Nova senha</h1>
            <p class="auth-subtitulo">Escolha uma nova senha para sua conta</p>

            <form class="auth-form" method="POST">
                <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">

                <div class="campo">
                    <label for="senha">Nova senha</label>
                    <div class="input-icone">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" id="senha" name="senha" placeholder="Mínimo de 6 dígitos" minlength="6" required>
                        <i class="fa-regular fa-eye toggle-senha"></i>
                    </div>
                </div>

                <div class="campo">
                    <label for="confirma_senha">Confirme a nova senha</label>
                    <div class="input-icone">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" id="confirma_senha" name="confirma_senha" placeholder="Digite novamente" minlength="6" required>
                        <i class="fa-regular fa-eye toggle-senha"></i>
                    </div>
                </div>

                <button type="submit" class="btn-auth">Redefinir senha</button>
            </form>
        </div>
    </div>

    <script src="assets/js/autentificacao.js"></script>

</body>
</html>