<?php
session_start();
require 'includes/bd-padariansa.php';

$linkGerado = null;
$erro = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');

    $stmt = $pdo->prepare('SELECT id_usuario FROM usuarios WHERE email = ?');
    $stmt->execute([$email]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario) {
        $token = bin2hex(random_bytes(32));
        $expira = date('Y-m-d H:i:s', strtotime('+1 hour'));

        $stmt = $pdo->prepare('UPDATE usuarios SET reset_token = ?, reset_expira = ? WHERE id_usuario = ?');
        $stmt->execute([$token, $expira, $usuario['id_usuario']]);

        // em produção: enviar esse link por e-mail em vez de mostrar na tela
        $linkGerado = 'redefinir-senha.php?token=' . $token;
    } else {
        // mesma mensagem genérica, não revela se o e-mail existe ou não
        $erro = 'Se esse e-mail existir na nossa base, um link de redefinição foi gerado.';
    }
}

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Esqueci a senha - Padaria NSA</title>
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
            <h1>Esqueceu a senha?</h1>
            <p class="auth-subtitulo">Informe seu e-mail para redefinir</p>

            <?php if ($erro): ?>
                <p style="text-align:center;color:var(--cinza);margin-bottom:16px;font-size:0.88rem;"><?= $erro ?></p>
            <?php endif; ?>

            <?php if ($linkGerado): ?>
                <p style="text-align:center;margin-bottom:20px;font-size:0.9rem;">
                    Link gerado (em produção isso vai por e-mail):<br>
                    <a href="<?= $linkGerado ?>" style="color:var(--vinho);font-weight:600;word-break:break-all;">
                        <?= $linkGerado ?>
                    </a>
                </p>
            <?php else: ?>
                <form class="auth-form" method="POST">
                    <div class="campo">
                        <label for="email">E-mail</label>
                        <div class="input-icone">
                            <i class="fa-regular fa-envelope"></i>
                            <input type="email" id="email" name="email" placeholder="seu@email.com" required>
                        </div>
                    </div>
                    <button type="submit" class="btn-auth">Enviar link de redefinição</button>
                </form>
            <?php endif; ?>

            <a href="login.php" class="auth-voltar">
                <i class="fa-solid fa-arrow-left"></i> Voltar para o login
            </a>
        </div>
    </div>

</body>
</html>