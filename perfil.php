<?php
session_start();
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
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Poppins:wght@300;400;600;700&display=swap"
        rel="stylesheet">

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
                    <li><a href="index.php#visite">Contato</a></li>
                </ul>
            </nav>

           <!-- botao login -->
            <?php if (isset($_SESSION['usuario_id'])): ?>
                        <a href="perfil.php" class="btn-login">
                            <i class="fa-regular fa-user"></i>
            <?php echo htmlspecialchars($_SESSION['usuario_nome']); ?>
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

            <div class="conta-card">

                <div class="conta-perfil">
                    <div class="conta-avatar">
                        <i class="fa-regular fa-user"></i>
                    </div>
                    <div>
                        <strong id="perfil-nome">Seu Nome</strong>
                        <span id="perfil-email">seu@email.com</span>
                    </div>
                </div>

                <!-- action/method: ajustar para o endpoint do backend que atualiza os dados -->
                <form class="conta-form" id="form-conta" action="atualizar-conta.php" method="POST">

                    <div class="campo">
                        <label for="conta-nome"><i class="fa-regular fa-user"></i> Nome Completo</label>
                        <input type="text" id="conta-nome" name="nome" placeholder="Usuário">
                    </div>

                    <div class="campo">
                        <label for="conta-email"><i class="fa-regular fa-envelope"></i> E-mail</label>
                        <input type="email" id="conta-email" name="email" placeholder="seu@email.com" disabled>
                    </div>
                    <p class="campo-dica">O e-mail não pode ser alterado</p>

                    <div class="campo">
                        <label for="conta-telefone"><i class="fa-solid fa-phone"></i> Telefone</label>
                        <input type="tel" id="conta-telefone" name="telefone" placeholder="(xx) xxxxx-xxxx">
                    </div>

                    <div class="campo">
                        <label for="conta-endereco"><i class="fa-solid fa-location-dot"></i> Endereço</label>
                        <input type="text" id="conta-endereco" name="endereco" placeholder="Rua ------">
                    </div>

                    <div class="conta-acoes">
                        <button type="button" class="btn-sair" id="btn-sair">Sair da conta</button>
                        <button type="submit" class="btn-salvar" >Salvar alterações</button>
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
                    <a href="index.html" class="footer-logo">
                        <img src="assets/img/logo.png" alt="Logo Padaria NSA">
                    </a>
                    <p>Tradição e sabor desde 2007. Pães artesanais feitos com amor e ingredientes selecionados.</p>
                </div>
                <div class="footer-coluna">
                    <h4></h4>
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
