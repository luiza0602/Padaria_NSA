<?php
session_start();

// Redireciona o usuário para o login caso ele tente acessar a página sem estar logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Minha Conta - Padaria NSA</title>

    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/perfil.css">

    <!-- Ícones -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <!-- Fontes -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

</head>

<body>

    <!-- Header -->
    <header>

        <div class="container">

            <a href="index.php" class="logo">
                <img src="assets/img/logo.png" alt="Logo Padaria NSA">
            </a>

            <nav class="menu">
                <ul>
                    <li><a href="index.php#hero">Início</a></li>
                    <li><a href="index.php#sobre">Sobre</a></li>
                    <li><a href="index.php#destaques">Cardápio</a></li>
                    <li><a href="index.php#contato">Contato</a></li>
                </ul>
            </nav>

            <!-- Botão Login/Perfil -->
            <?php if (isset($_SESSION['usuario_id'])): ?>
                <?php 
                    // Separa o nome pelos espaços e obtém apenas a primeira palavra
                    $primeiro_nome = explode(' ', trim($_SESSION['usuario_nome'] ?? ''))[0]; 
                ?>
                <a href="perfil.php" class="btn-login">
                    <i class="fa-regular fa-user"></i>
                    <?php echo htmlspecialchars($primeiro_nome); ?>
                </a>
            <?php else: ?>
                <a href="login.php" class="btn-login">
                    <i class="fa-regular fa-user"></i>
                    Entrar
                </a>
            <?php endif; ?>

        </div>

    </header>

    <!-- Minha Conta -->
    <section class="conta-section">

        <div class="container">

            <h1 class="conta-titulo">Minha Conta</h1>
            <p class="conta-subtitulo">Gerencie as suas informações pessoais</p>

            <!-- Alertas de Status -->
            <?php if (isset($_GET['status']) && $_GET['status'] === 'sucesso'): ?>
                <p style="color: green; font-weight: bold; text-align: center;">Dados atualizados com sucesso!</p>
            <?php elseif (isset($_GET['status']) && $_GET['status'] === 'erro_nome_vazio'): ?>
                <p style="color: red; font-weight: bold; text-align: center;">O campo nome não pode ser vazio.</p>
            <?php elseif (isset($_GET['status']) && $_GET['status'] === 'erro'): ?>
                <p style="color: red; font-weight: bold; text-align: center;">Ocorreu um erro ao atualizar a conta.</p>
            <?php endif; ?>

            <div class="conta-card">

                <div class="conta-perfil">
                    <div class="conta-avatar">
                        <i class="fa-regular fa-user"></i>
                    </div>
                    <div>
                        <strong id="perfil-nome">
                            <?php echo htmlspecialchars($_SESSION['usuario_nome'] ?? 'Usuário'); ?>
                        </strong>
                        <span id="perfil-email">
                            <?php echo htmlspecialchars($_SESSION['usuario_email'] ?? 'email@nao.informado'); ?>
                        </span>
                    </div>
                </div>

                <form class="conta-form" id="form-conta" action="atualizar-conta.php" method="POST">

                    <div class="campo">
                        <label for="conta-nome"><i class="fa-regular fa-user"></i> Nome Completo</label>
                        <input type="text" id="conta-nome" name="nome" 
                               value="<?php echo htmlspecialchars($_SESSION['usuario_nome'] ?? ''); ?>" 
                               placeholder="Seu nome completo" required>
                    </div>

                    <div class="campo">
                        <label for="conta-email"><i class="fa-regular fa-envelope"></i> E-mail</label>
                        <input type="email" id="conta-email" name="email" 
                               value="<?php echo htmlspecialchars($_SESSION['usuario_email'] ?? ''); ?>" 
                               placeholder="seu@email.com" disabled>
                    </div>
                    <p class="campo-dica">O e-mail não pode ser alterado</p>

                    <div class="campo">
                        <label for="conta-telefone"><i class="fa-solid fa-phone"></i> Telefone</label>
                        <input type="tel" id="conta-telefone" name="telefone" 
                               maxlength="15" 
                               oninput="mascaraTelefone(this)"
                               value="<?php 
                                   $tel = preg_replace('/[^0-9]/', '', $_SESSION['usuario_telefone'] ?? '');
                                   if (strlen($tel) === 11) {
                                       echo sprintf('(%s) %s-%s', substr($tel, 0, 2), substr($tel, 2, 5), substr($tel, 7));
                                   } else {
                                       echo htmlspecialchars($tel);
                                   }
                               ?>" 
                               placeholder="(xx) xxxxx-xxxx" required>
                    </div>

                    <div class="campo">
                        <label for="conta-endereco"><i class="fa-solid fa-location-dot"></i> Endereço</label>
                        <input type="text" id="conta-endereco" name="endereco" 
                               value="<?php echo htmlspecialchars($_SESSION['usuario_endereco'] ?? ''); ?>" 
                               placeholder="Rua ------">
                    </div>

                    <div class="conta-acoes">
                        <a href="logout.php" class="btn-sair" id="btn-sair">Sair da conta</a>
                        <button type="submit" class="btn-salvar">Salvar alterações</button>
                    </div>

                </form>

            </div>

        </div>

    </section>

    <!-- Rodapé -->
    <footer>

        <section id="footer" class="footer-section">
            <div class="footer-container">
                <div class="footer-coluna logo-coluna">
                    <a href="index.php" class="footer-logo">
                        <img src="assets/img/logo.png" alt="Logo Padaria NSA">
                    </a>
                    <p>Tradição e sabor desde 2007. Pães artesanais feitos com amor e ingredientes selecionados.</p>
                </div>
                <div class="footer-coluna">
                    <ul class="footer-links">
                        <li><a href="#hero">Início</a></li>
                        <li><a href="#sobre">Sobre Nós</a></li>
                        <li><a href="#destaques">Cardápio</a></li>
                        <li><a href="#contato">Contato</a></li>
                    </ul>
                </div>

                <div class="footer-coluna">
                    <h4>Redes Sociais</h4>
                    <div class="footer-sociais">
                        <a href="#" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                        <a href="#" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                    </div>
                </div>
            </div>
            
            <div class="footer-bottom">
                <div class="container">
                    <p>&copy; 2026 Padaria NSA. Todos os direitos reservados.</p>
                </div>
            </div>

        </section>

    </footer>

    <script src="assets/js/script.js"></script>


</body>

</html>