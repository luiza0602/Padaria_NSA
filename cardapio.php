<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cardápio | Padaria NSA</title>

    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/cardapio.css">

    <!-- icones -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

</head>

<body>

    <!-- CABEÇALHO 

    <header>

        <div class="container">

           

            <nav class="menu">

                <ul>

                    <li>
                        <a href="index.html">Início</a>
                    </li>

                    <li>
                        <a href="sobre">Sobre</a>
                    </li>

                    <li>
                        <a href="cardapio.php">Cardápio</a>
                    </li>

                    <li>
                        <a href="contato">Contato</a>
                    </li>

                </ul>

            </nav>

            <a href="login.html" class="btn-login">
                Entrar
            </a>

        </div>

    </header>
-->

    <!-- CARDÁPIO -->

    <main class="cardapio">

        <!-- Barra superior -->

        <div class="cardapio-topo">

            <a href="index.html" class="voltar">
                ← Voltar
            </a>

           <a href="index.html" class="logo">
                <img src="assets/img/logo.png" alt="Padaria NSA">
            </a>

        </div>


        <!-- Apresentação -->

        <section class="cardapio-intro">

            <span>Nosso Cardápio</span>

            <h1>
                Delícias feitas com carinho
            </h1>

            <p>
                Pães fresquinhos, feitos com amor e tradição.
                Ingredientes selecionados para momentos especiais.
            </p>

            <button class="cart-flutuante" id="btnCarrinho" aria-label="Ver carrinho">
                <i class="fa-solid fa-cart-shopping"></i>
                <span class="cart-badge" id="cartBadge">0</span>
            </button>

        </section>


        <!-- Categorias -->

        <nav class="categorias" id="categorias">

            <a href="#" class="categoria ativa" data-categoria="paes">
                Pães
            </a>

            <a href="#" class="categoria" data-categoria="doces">
                Doces
            </a>

            <a href="#" class="categoria" data-categoria="bebidas">
                Bebidas
            </a>

            <a href="#" class="categoria" data-categoria="cafeteria">
                Cafeteria
            </a>

        </nav>


        <!-- Produtos -->

        <section class="produtos" id="produtos">

            <!-- ===== PÃES ===== -->

            <article class="produto mostrar" data-categoria="paes">
                <img src="assets/img/produto1.jpg" alt="Americano de Presunto">
                <div class="produto-info">
                    <h2>Americano de Presunto</h2>
                    <p>Presunto, queijo e salada temperados no pão fresquinho.</p>
                    <div class="produto-footer">
                        <strong>R$ 12,00</strong>
                        <button>Adicionar</button>
                    </div>
                </div>
            </article>

            <article class="produto mostrar" data-categoria="paes">
                <img src="assets/img/produto2.jpg" alt="Lanche Frio - Pão com Mortadela">
                <div class="produto-info">
                    <h2>Lanche Frio - Pão com Mortadela</h2>
                    <p>Mortadela fatiada no pão amanteigado, simples e tradicional.</p>
                    <div class="produto-footer">
                        <strong>R$ 8,90</strong>
                        <button>Adicionar</button>
                    </div>
                </div>
            </article>

            <article class="produto mostrar" data-categoria="paes">
                <img src="assets/img/produto3.jpg" alt="Lanche Frio - Peito de Peru">
                <div class="produto-info">
                    <h2>Lanche Frio - Peito de Peru</h2>
                    <p>Peito de peru fatiado com queijo e alface crocante.</p>
                    <div class="produto-footer">
                        <strong>R$ 13,90</strong>
                        <button>Adicionar</button>
                    </div>
                </div>
            </article>

            <article class="produto mostrar" data-categoria="paes">
                <img src="assets/img/produto4.jpg" alt="Misto Quente">
                <div class="produto-info">
                    <h2>Misto Quente</h2>
                    <p>Presunto e queijo derretidos no pão quentinho.</p>
                    <div class="produto-footer">
                        <strong>R$ 10,90</strong>
                        <button>Adicionar</button>
                    </div>
                </div>
            </article>

            <article class="produto mostrar" data-categoria="paes">
                <img src="assets/img/produto1.jpg" alt="Croissant Presunto e Queijo">
                <div class="produto-info">
                    <h2>Croissant Presunto e Queijo</h2>
                    <p>Croissant amanteigado recheado com presunto, queijo e toque de mel.</p>
                    <div class="produto-footer">
                        <strong>R$ 14,00</strong>
                        <button>Adicionar</button>
                    </div>
                </div>
            </article>

            <article class="produto mostrar" data-categoria="paes">
                <img src="assets/img/produto2.jpg" alt="Croissant Cheddar e Bacon">
                <div class="produto-info">
                    <h2>Croissant Cheddar e Bacon</h2>
                    <p>Croissant recheado com cheddar cremoso e bacon crocante.</p>
                    <div class="produto-footer">
                        <strong>R$ 15,90</strong>
                        <button>Adicionar</button>
                    </div>
                </div>
            </article>


            <!-- ===== DOCES ===== -->

            <article class="produto" data-categoria="doces">
                <img src="assets/img/produto3.jpg" alt="Chocolate Cremoso Tradicional">
                <div class="produto-info">
                    <h2>Chocolate Cremoso Tradicional</h2>
                    <p>Chocolate quente cremoso, feito com achocolatado especial e um toque de canela.</p>
                    <div class="produto-footer">
                        <strong>R$ 11,00</strong>
                        <button>Adicionar</button>
                    </div>
                </div>
            </article>

            <article class="produto" data-categoria="doces">
                <img src="assets/img/produto4.jpg" alt="Chocolate Gelado Avelã">
                <div class="produto-info">
                    <h2>Chocolate Gelado Avelã</h2>
                    <p>A combinação irresistível de chocolate gelado com creme cremoso e avelã.</p>
                    <div class="produto-footer">
                        <strong>R$ 16,90</strong>
                        <button>Adicionar</button>
                    </div>
                </div>
            </article>

            <article class="produto" data-categoria="doces">
                <img src="assets/img/produto1.jpg" alt="Chocolate Quente Nutella">
                <div class="produto-info">
                    <h2>Chocolate Quente Nutella</h2>
                    <p>Chocolate cremoso derretido com baunilha para os verdadeiros amantes de chocolate.</p>
                    <div class="produto-footer">
                        <strong>R$ 16,90</strong>
                        <button>Adicionar</button>
                    </div>
                </div>
            </article>

            <article class="produto" data-categoria="doces">
                <img src="assets/img/produto2.jpg" alt="Chocolate Gelado Tradicional">
                <div class="produto-info">
                    <h2>Chocolate Gelado Tradicional</h2>
                    <p>O equilíbrio perfeito entre o cacau intenso e o leite bem cremoso.</p>
                    <div class="produto-footer">
                        <strong>R$ 13,90</strong>
                        <button>Adicionar</button>
                    </div>
                </div>
            </article>

            <article class="produto" data-categoria="doces">
                <img src="assets/img/produto3.jpg" alt="Chocolate Gelado Nutella">
                <div class="produto-info">
                    <h2>Chocolate Gelado Nutella</h2>
                    <p>Chocolate cremoso, gelado com nutella, perfeito para os dias mais quentes.</p>
                    <div class="produto-footer">
                        <strong>R$ 16,90</strong>
                        <button>Adicionar</button>
                    </div>
                </div>
            </article>

            <article class="produto" data-categoria="doces">
                <img src="assets/img/produto4.jpg" alt="Chocolate Quente Avelã">
                <div class="produto-info">
                    <h2>Chocolate Quente Avelã</h2>
                    <p>Receita clássica com creme de avelã, gostinho de infância em cada gole.</p>
                    <div class="produto-footer">
                        <strong>R$ 15,90</strong>
                        <button>Adicionar</button>
                    </div>
                </div>
            </article>


            <!-- ===== BEBIDAS ===== -->

            <article class="produto" data-categoria="bebidas">
                <img src="assets/img/produto1.jpg" alt="Suco de Acerola">
                <div class="produto-info">
                    <h2>Suco de Acerola</h2>
                    <p>Explosão de vitamina C e frescor em cada gole da colheita.</p>
                    <div class="produto-footer">
                        <strong>R$ 10,90</strong>
                        <button>Adicionar</button>
                    </div>
                </div>
            </article>

            <article class="produto" data-categoria="bebidas">
                <img src="assets/img/produto2.jpg" alt="Suco de Abacaxi">
                <div class="produto-info">
                    <h2>Suco de Abacaxi</h2>
                    <p>Refrescante e adocicado, preparado com frutas selecionadas e bem gelado.</p>
                    <div class="produto-footer">
                        <strong>R$ 10,90</strong>
                        <button>Adicionar</button>
                    </div>
                </div>
            </article>

            <article class="produto" data-categoria="bebidas">
                <img src="assets/img/produto3.jpg" alt="Suco de Cupuaçu">
                <div class="produto-info">
                    <h2>Suco de Cupuaçu</h2>
                    <p>Sabor nativo da Amazônia, cremoso e com toque tropical inconfundível.</p>
                    <div class="produto-footer">
                        <strong>R$ 13,90</strong>
                        <button>Adicionar</button>
                    </div>
                </div>
            </article>

            <article class="produto" data-categoria="bebidas">
                <img src="assets/img/produto4.jpg" alt="Suco de Caju">
                <div class="produto-info">
                    <h2>Suco de Caju</h2>
                    <p>Sabor tropical e delicado da caju com uma leve acidez refrescante.</p>
                    <div class="produto-footer">
                        <strong>R$ 10,90</strong>
                        <button>Adicionar</button>
                    </div>
                </div>
            </article>

            <article class="produto" data-categoria="bebidas">
                <img src="assets/img/produto1.jpg" alt="Suco de Morango">
                <div class="produto-info">
                    <h2>Suco de Morango</h2>
                    <p>Feito com morangos frescos, equilibrando doçura e acidez na medida certa.</p>
                    <div class="produto-footer">
                        <strong>R$ 12,90</strong>
                        <button>Adicionar</button>
                    </div>
                </div>
            </article>

            <article class="produto" data-categoria="bebidas">
                <img src="assets/img/produto2.jpg" alt="Suco de Laranja">
                <div class="produto-info">
                    <h2>Suco de Laranja</h2>
                    <p>O clássico indispensável, natural, espremido na hora e cheio de vitamina.</p>
                    <div class="produto-footer">
                        <strong>R$ 10,90</strong>
                        <button>Adicionar</button>
                    </div>
                </div>
            </article>


            <!-- ===== CAFETERIA ===== -->

            <article class="produto" data-categoria="cafeteria">
                <img src="assets/img/produto3.jpg" alt="Fondue de Chocolate - Banana">
                <div class="produto-info">
                    <h2>Fondue de Chocolate - Banana</h2>
                    <p>Rodelas de banana mergulhadas em uma calda cremosa de chocolate derretido.</p>
                    <div class="produto-footer">
                        <strong>R$ 20,90</strong>
                        <button>Adicionar</button>
                    </div>
                </div>
            </article>

            <article class="produto" data-categoria="cafeteria">
                <img src="assets/img/produto4.jpg" alt="Fondue de Chocolate - Morango">
                <div class="produto-info">
                    <h2>Fondue de Chocolate - Morango</h2>
                    <p>Fatias de morango fresco banhadas em uma calda artesanal de chocolate cremoso.</p>
                    <div class="produto-footer">
                        <strong>R$ 24,90</strong>
                        <button>Adicionar</button>
                    </div>
                </div>
            </article>

            <article class="produto" data-categoria="cafeteria">
                <img src="assets/img/produto1.jpg" alt="Frappé Cappuccino">
                <div class="produto-info">
                    <h2>Frappé Cappuccino</h2>
                    <p>A combinação gelada do café com chocolate e um toque cremoso de canela.</p>
                    <div class="produto-footer">
                        <strong>R$ 17,90</strong>
                        <button>Adicionar</button>
                    </div>
                </div>
            </article>

            <article class="produto" data-categoria="cafeteria">
                <img src="assets/img/produto2.jpg" alt="Frappé de Café">
                <div class="produto-info">
                    <h2>Frappé de Café</h2>
                    <p>Nosso café favorito, gelado, super batido e cremoso, equilibrado e aromático.</p>
                    <div class="produto-footer">
                        <strong>R$ 16,90</strong>
                        <button>Adicionar</button>
                    </div>
                </div>
            </article>

            <article class="produto" data-categoria="cafeteria">
                <img src="assets/img/produto3.jpg" alt="Frappé Caramelo">
                <div class="produto-info">
                    <h2>Frappé Caramelo</h2>
                    <p>Delicioso café batido com calda de caramelo artesanal e chantilly cremoso.</p>
                    <div class="produto-footer">
                        <strong>R$ 17,90</strong>
                        <button>Adicionar</button>
                    </div>
                </div>
            </article>

            <article class="produto" data-categoria="cafeteria">
                <img src="assets/img/produto4.jpg" alt="Frappé Ovomaltine">
                <div class="produto-info">
                    <h2>Frappé Ovomaltine</h2>
                    <p>Batido com muito Ovomaltine, guarnecido com chocolate cremoso e crocante.</p>
                    <div class="produto-footer">
                        <strong>R$ 18,90</strong>
                        <button>Adicionar</button>
                    </div>
                </div>
            </article>

        </section>


        <!-- CTA -->
<nav>
        <section class="cardapio-cta id= "cardapio-fundo>

            <h2>
                Gostou do que viu?
            </h2>

            <p>
                Adicione seus produtos favoritos ao carrinho
                e finalize seu pedido.
            </p>

            <a href="contato.php">
                Fale Conosco
            </a>

        </section>

    </main>
</nav>

    

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


    <script src="assets/js/cardapio.js"></script>

</body>

</html>