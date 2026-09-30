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

            <a href="login.php" class="btn-login">
                Entrar
            </a>

        </div>

    </header>
-->

    <!-- CARDÁPIO -->

    <main class="cardapio">

        <!-- Barra superior -->

   <div class="cardapio-topo">

    <a href="index.php" class="voltar">
        ← Voltar
    </a>

    <a href="index.php" class="logo-topo">
        <img src="assets/img/logo.png" alt="Logo Padaria NSA">
    </a>

</div>


        <!-- Apresentação -->

        <section class="cardapio-intro">

            <span>Nosso Cardápio</span>

            <h1>
                Delícias feitas com carinho
            </h1>

            <p>
                Lanches fresquinhos, feitos com amor e tradição.
                Ingredientes selecionados para momentos especiais.
            </p>

            <button class="cart-flutuante" id="btnCarrinho" aria-label="Ver carrinho">
                <i class="fa-solid fa-cart-shopping"></i>
                <span class="cart-badge" id="cartBadge">0</span>
            </button>

        </section>


        <!-- Categorias -->

        <nav class="categorias" id="categorias">

            <a href="#" class="categoria ativa" data-categoria="lanches">
                Lanches
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

            <!-- ===== LANCHES ===== -->

            <article class="produto" data-categoria="lanches">
                <img src="assets/img/AMERICANO DE PRESUNTO (2).jpg" alt="Americano de Presunto">
                <div class="produto-info">
                    <h2>Americano de Presunto</h2>
                    <p>Presunto, queijo e alface em um pão fresquinho.</p>
                    <div class="produto-footer">
                        <strong>R$ 12,00</strong>
                        <button>Adicionar</button>
                    </div>
                </div>
            </article>

            <article class="produto" data-categoria="lanches">
                <img src="assets/img/LANCHE FRIO - PÃO COM MORTADELA SIMPLES.jpg" alt="Lanche Frio - Pão com Mortadela">
                <div class="produto-info">
                    <h2>Lanche Frio - Pão com Mortadela</h2>
                    <p>Mortadela fatiada no pão amanteigado, simples e tradicional.</p>
                    <div class="produto-footer">
                        <strong>R$ 8,90</strong>
                        <button>Adicionar</button>
                    </div>
                </div>
            </article>

            <article class="produto" data-categoria="lanches">
                <img src="assets/img/LANCHE FRIO - PEITO DE PERU.jpg" alt="Lanche Frio - Peito de Peru">
                <div class="produto-info">
                    <h2>Lanche Frio - Peito de Peru</h2>
                    <p>Peito de peru fatiado com queijo e alface crocante.</p>
                    <div class="produto-footer">
                        <strong>R$ 13,90</strong>
                        <button>Adicionar</button>
                    </div>
                </div>
            </article>

            <article class="produto" data-categoria="lanches">
                <img src="assets/img/LANCHES QUENTES - MISTO QUENTE.jpg" alt="Misto Quente">
                <div class="produto-info">
                    <h2>Misto Quente</h2>
                    <p>Presunto e queijo derretidos no pão quentinho.</p>
                    <div class="produto-footer">
                        <strong>R$ 10,90</strong>
                        <button>Adicionar</button>
                    </div>
                </div>
            </article>

            <article class="produto" data-categoria="lanches">
                <img src="assets/img/Croissant Presunto e Queijo.jpg" alt="Croissant Presunto e Queijo">
                <div class="produto-info">
                    <h2>Croissant Presunto e Queijo</h2>
                    <p>Croissant amanteigado recheado com presunto, queijo e toque de mel.</p>
                    <div class="produto-footer">
                        <strong>R$ 14,00</strong>
                        <button>Adicionar</button>
                    </div>
                </div>
            </article>

            <article class="produto" data-categoria="lanches">
                <img src="assets/img/CROISSANT SANDUBA DE CHEDDAR E BACON.jpg" alt="Croissant Cheddar e Bacon">
                <div class="produto-info">
                    <h2>Croissant Cheddar e Bacon</h2>
                    <p>Croissant recheado com cheddar cremoso e bacon crocante.</p>
                    <div class="produto-footer">
                        <strong>R$ 15,90</strong>
                        <button>Adicionar</button>
                    </div>
                </div>
            </article>


            
            <article class="produto mostrar" data-categoria="lanches">
                <img src="assets/img/LANCHE FRIO - PÃO COM PRESUNTO E QUEIJO SIMPLES.jpg" alt="Lanche Frio - Pão com Presunto e Queijo Simples">
                <div class="produto-info">
                    <h2>Lanche Frio - Pão com Presunto e Queijo Simples</h2>
                    <p>Pão fresquinho recheado com presunto e queijo, em uma combinação simples e tradicional.</p>
                    <div class="produto-footer">
                        <strong>R$ 10,90</strong>
                        <button>Adicionar</button>
                    </div>
                </div>
            </article>

            <article class="produto mostrar" data-categoria="lanches">
                <img src="assets/img/LANCHES QUENTE - SALAME COM MUSSARELA [.jpg" alt="Lanches Quentes - Salame com Mussarela">
                <div class="produto-info">
                    <h2>Lanches Quentes - Salame com Mussarela</h2>
                    <p>Salame e mussarela no pão quentinho, preparados na chapa.</p>
                    <div class="produto-footer">
                        <strong>R$ 12,90</strong>
                        <button>Adicionar</button>
                    </div>
                </div>
            </article>

            <article class="produto mostrar" data-categoria="lanches">
                <img src="assets/img/LANCHES QUENTES - MISTO CREMOSO.jpg" alt="Lanches Quentes - Misto Cremoso">
                <div class="produto-info">
                    <h2>Lanches Quentes - Misto Cremoso</h2>
                    <p>Misto quente com recheio cremoso e queijo derretido.</p>
                    <div class="produto-footer">
                        <strong>R$ 6,50</strong>
                        <button>Adicionar</button>
                    </div>
                </div>
            </article>

            <article class="produto mostrar" data-categoria="lanches">
                <img src="assets/img/Lanches Quentes - Misto Mineiro.jpg" alt="Lanches Quentes - Misto Mineiro">
                <div class="produto-info">
                    <h2>Lanches Quentes - Misto Mineiro</h2>
                    <p>Lanche quente com sabor tradicional e queijo derretido.</p>
                    <div class="produto-footer">
                        <strong>R$ 13,90</strong>
                        <button>Adicionar</button>
                    </div>
                </div>
            </article>

            <article class="produto mostrar" data-categoria="lanches">
                <img src="assets/img/LANCHES QUENTES - PÃO COM OVO.jpg" alt="Lanches Quentes - Pão com Ovo">
                <div class="produto-info">
                    <h2>Lanches Quentes - Pão com Ovo</h2>
                    <p>Pão quentinho recheado com ovo preparado na hora.</p>
                    <div class="produto-footer">
                        <strong>R$ 14,90</strong>
                        <button>Adicionar</button>
                    </div>
                </div>
            </article>

            <article class="produto mostrar" data-categoria="lanches">
                <img src="assets/img/LANCHES QUENTES - PEITO DE PERU COM  MUSSARELA (1).jpg" alt="Lanches Quentes - Peito de Peru com Mussarela">
                <div class="produto-info">
                    <h2>Lanches Quentes - Peito de Peru com Mussarela</h2>
                    <p>Peito de peru e mussarela servidos quentinhos no pão.</p>
                    <div class="produto-footer">
                        <strong>R$ 11,90</strong>
                        <button>Adicionar</button>
                    </div>
                </div>
            </article>

<!-- ===== DOCES ===== -->



            <article class="produto" data-categoria="doces">
                <img src="assets/img/CHOCOLATE GELADO - AVELÃ.jpg" alt="Chocolate Gelado Avelã">
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
                <img src="assets/img/CHOCOLATE QUENTE - NUTELLA.jpg" alt="Chocolate Quente Nutella">
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
                <img src="assets/img/CHOCOLATE GELADO - TRADICIONAL.jpg" alt="Chocolate Gelado Tradicional">
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
                <img src="assets/img/CHOCOLATE GELADO NUTELLA.jpg" alt="Chocolate Gelado Nutella">
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
                <img src="assets/img/CHOCOLATE QUENTE - AVELÃ.jpg" alt="Chocolate Quente Avelã">
                <div class="produto-info">
                    <h2>Chocolate Quente Avelã</h2>
                    <p>Receita clássica com creme de avelã, gostinho de infância em cada gole.</p>
                    <div class="produto-footer">
                        <strong>R$ 15,90</strong>
                        <button>Adicionar</button>
                    </div>
                </div>
            </article>


            
            <article class="produto" data-categoria="doces">
                <img src="assets/img/CHOCOLATE CREMOSO - TRADICIONAL - QUENTE.jpg" alt="Chocolate Cremoso Tradicional Quente">
                <div class="produto-info">
                    <h2>Chocolate Cremoso Tradicional Quente</h2>
                    <p>Chocolate quente cremoso e tradicional, perfeito para acompanhar um doce.</p>
                    <div class="produto-footer">
                        <strong>R$ 9,90</strong>
                        <button>Adicionar</button>
                    </div>
                </div>
            </article>

            <article class="produto" data-categoria="doces">
                <img src="assets/img/CHOCOLATE GELADO - AVELÃ.jpg" alt="Chocolate Gelado - Avelã">
                <div class="produto-info">
                    <h2>Chocolate Gelado - Avelã</h2>
                    <p>Chocolate gelado cremoso com sabor de avelã.</p>
                    <div class="produto-footer">
                        <strong>R$ 4,50</strong>
                        <button>Adicionar</button>
                    </div>
                </div>
            </article>

          

            <article class="produto" data-categoria="doces">
                <img src="assets/img/CHOCOLATE GELADO TRADICIONAL E AVELÃ.jpg" alt="Chocolate Gelado Tradicional e Avelã">
                <div class="produto-info">
                    <h2>Chocolate Gelado Tradicional e Avelã</h2>
                    <p>Chocolate gelado tradicional combinado com o sabor de avelã.</p>
                    <div class="produto-footer">
                        <strong>R$ 12,90</strong>
                        <button>Adicionar</button>
                    </div>
                </div>
            </article>

            <article class="produto" data-categoria="doces">
                <img src="assets/img/CHOCOLATE QUENTE - TRADICIONAL.jpg" alt="Chocolate Quente - Tradicional">
                <div class="produto-info">
                    <h2>Chocolate Quente - Tradicional</h2>
                    <p>Chocolate quente tradicional, cremoso e servido bem quentinho.</p>
                    <div class="produto-footer">
                        <strong>R$ 10,90</strong>
                        <button>Adicionar</button>
                    </div>
                </div>
            </article>

  <article class="produto" data-categoria="doces">
                <img src="assets/img/FONDUE DE CHOCOLATE - MORANGO.jpg" alt="Fondue de Chocolate - Morango">
                <div class="produto-info">
                    <h2>Fondue de Chocolate - Morango</h2>
                    <p>Fatias de morango fresco banhadas em uma calda artesanal de chocolate cremoso.</p>
                    <div class="produto-footer">
                        <strong>R$ 24,90</strong>
                        <button>Adicionar</button>
                    </div>
                </div>
            </article>

            <article class="produto" data-categoria="doces">
                <img src="assets/img/FONDUE DE CHOCOLATE - BANANA.jpg" alt="Fondue de Chocolate - Banana">
                <div class="produto-info">
                    <h2>Fondue de Chocolate - Banana</h2>
                    <p>Rodelas de banana mergulhadas em uma calda cremosa de chocolate derretido.</p>
                    <div class="produto-footer">
                        <strong>R$ 20,90</strong>
                        <button>Adicionar</button>
                    </div>
                </div>
            </article>

            <article class="produto" data-categoria="doces">
                <img src="assets/img/MINI BOLO VULCÃO CENOURA.jpg" alt="Mini Bolo Vulcão Cenoura">
                <div class="produto-info">
                    <h2>Mini Bolo Vulcão Cenoura</h2>
                    <p>Mini bolo de cenoura com cobertura cremosa de chocolate.</p>
                    <div class="produto-footer">
                        <strong>R$ 7,90</strong>
                        <button>Adicionar</button>
                    </div>
                </div>
            </article>

<!-- ===== BEBIDAS ===== -->

            <article class="produto" data-categoria="bebidas">
                <img src="assets/img/SUCO ACEROLA.jpg" alt="Suco de Acerola">
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
                <img src="assets/img/SUCO ABACAXI.jpg" alt="Suco de Abacaxi">
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
                <img src="assets/img/SUCO CUPUAÇU.jpg" alt="Suco de Cupuaçu">
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
                <img src="assets/img/SUCO DE CAJU.jpg" alt="Suco de Caju">
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
                <img src="assets/img/SUCO FRUTAS VERMELHAS.jpg" alt="Suco de frutas vermelhas">
                <div class="produto-info">
                    <h2>Suco de Frutas Vermelhas</h2>
                    <p>Feito com frutas vermelhas frescas, equilibrando doçura e acidez na medida certa.</p>
                    <div class="produto-footer">
                        <strong>R$ 12,90</strong>
                        <button>Adicionar</button>
                    </div>
                </div>
            </article>

            <article class="produto" data-categoria="bebidas">
                <img src="assets/img/SUCO LARANJA.jpg" alt="Suco de Laranja">
                <div class="produto-info">
                    <h2>Suco de Laranja</h2>
                    <p>O clássico indispensável, natural, espremido na hora e cheio de vitamina.</p>
                    <div class="produto-footer">
                        <strong>R$ 10,90</strong>
                        <button>Adicionar</button>
                    </div>
                </div>
            </article>


            
            <article class="produto" data-categoria="bebidas">
                <img src="assets/img/SODA ITALIANA - LIMÃO SICILIANO.jpg" alt="Soda Italiana de Limão Siciliano">
                <div class="produto-info">
                    <h2>Soda Italiana de Limão Siciliano</h2>
                    <p>Refrescante e cítrica, com o sabor marcante do limão siciliano.</p>
                    <div class="produto-footer">
                        <strong>R$ 9,00</strong>
                        <button>Adicionar</button>
                    </div>
                </div>
            </article>

            <article class="produto" data-categoria="bebidas">
                <img src="assets/img/SODA ITALIANA - MAÇA VERDE.jpg" alt="Soda Italiana de Maçã Verde">
                <div class="produto-info">
                    <h2>Soda Italiana de Maçã Verde</h2>
                    <p>Levemente doce e com o sabor irresistível da maçã verde.</p>
                    <div class="produto-footer">
                        <strong>R$ 7,50</strong>
                        <button>Adicionar</button>
                    </div>
                </div>
            </article>

            <article class="produto" data-categoria="bebidas">
                <img src="assets/img/SODA ITALIANA - MORANGO.jpg" alt="Soda Italiana de Morango">
                <div class="produto-info">
                    <h2>Soda Italiana de Morango</h2>
                    <p>Docinha, com o sabor delicado e delicioso do morango.</p>
                    <div class="produto-footer">
                        <strong>R$ 7,00</strong>
                        <button>Adicionar</button>
                    </div>
                </div>
            </article>

            <article class="produto" data-categoria="bebidas">
                <img src="assets/img/SODA ITALIANA CRANBERRY.jpg" alt="Soda Italiana de Cranberry">
                <div class="produto-info">
                    <h2>Soda Italiana de Cranberry</h2>
                    <p>levemente ácido e com o sabor marcante do cranberry.</p>
                    <div class="produto-footer">
                        <strong>R$ 10,90</strong>
                        <button>Adicionar</button>
                    </div>
                </div>
            </article>

            <article class="produto" data-categoria="bebidas">
                <img src="assets/img/VITAMINAS FRUTAS (BANANA, MAMAO E ABACATE).jpg" alt="Chocolate Cremoso Tradicional Quente">
                <div class="produto-info">
                    <h2>Vitamina de Frutas</h2>
                    <p>Cremosa e nutritiva, preparada com banana, mamão e abacate.</p>
                    <div class="produto-footer">
                        <strong>R$ 11,90</strong>
                        <button>Adicionar</button>
                    </div>
                </div>
            </article>

            <article class="produto" data-categoria="bebidas">
                <img src="assets/img/VITAMINA DE ABACATE.jpg" alt="Vitamina de Abacate">
                <div class="produto-info">
                    <h2>Vitamina de Abacate</h2>
                    <p>Cremosa e saborosa, com a textura suave e o sabor marcante do abacate.</p>
                    <div class="produto-footer">
                        <strong>R$ 11,90</strong>
                        <button>Adicionar</button>
                    </div>
                </div>
            </article>

<!-- ===== CAFETERIA ===== -->

            <article class="produto" data-categoria="cafeteria">
                <img src="assets/img/CAPPUCCINO TRADICIONAL.jpg" alt="Cappuccino Tradicional:">
                <div class="produto-info">
                    <h2>Cappuccino Tradicional:</h2>
                    <p>Cremoso e aromático, com o sabor clássico do café e um toque suave de leite.</p>
                    <div class="produto-footer">
                        <strong>R$ 20,90</strong>
                        <button>Adicionar</button>
                    </div>
                </div>
            </article>

            <article class="produto" data-categoria="cafeteria">
                <img src="assets/img/CAPPUCCINO NUTELLA.jpg" alt="Cappuccino de Nutella">
                <div class="produto-info">
                    <h2>Cappuccino de Nutella</h2>
                    <p>Cremoso e irresistível, combinando café, leite e o delicioso sabor de Nutella.</p>
                    <div class="produto-footer">
                        <strong>R$ 24,90</strong>
                        <button>Adicionar</button>
                    </div>
                </div>
            </article>

            <article class="produto" data-categoria="cafeteria">
                <img src="assets/img/FRAPE CAPPUCCINO.jpg" alt="Frappé Cappuccino">
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
                <img src="assets/img/FRAPES CAFÉ.jpg" alt="Frappé de Café">
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
                <img src="assets/img/FRAPES CARAMELO.jpg" alt="Frappé Caramelo">
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
                <img src="assets/img/FRAPÊS OVOMALTINE.jpg" alt="Frappé Ovomaltine">
                <div class="produto-info">
                    <h2>Frappé Ovomaltine</h2>
                    <p>Batido com muito Ovomaltine, guarnecido com chocolate cremoso e crocante.</p>
                    <div class="produto-footer">
                        <strong>R$ 18,90</strong>
                        <button>Adicionar</button>
                    </div>
                </div>
            </article>


            <article class="produto" data-categoria="cafeteria">
                <img src="assets/img/EXPRESSO, EXPRESSO DUPLO.jpg" alt="Expresso, Expresso Duplo">
                <div class="produto-info">
                    <h2>Expresso, Expresso Duplo</h2>
                    <p>Café expresso ou expresso duplo, preparado na hora.</p>
                    <div class="produto-footer">
                        <strong>R$ 5,00</strong>
                        <button>Adicionar</button>
                    </div>
                </div>
            </article>

            <article class="produto" data-categoria="cafeteria">
                <img src="assets/img/EXPRESSO COM DOCE DE LEITE.jpg" alt="Expresso com Doce de Leite">
                <div class="produto-info">
                    <h2>Expresso com Doce de Leite</h2>
                    <p>Café expresso combinado com o sabor cremoso do doce de leite.</p>
                    <div class="produto-footer">
                        <strong>R$ 6,50</strong>
                        <button>Adicionar</button>
                    </div>
                </div>
            </article>

            <article class="produto" data-categoria="cafeteria">
                <img src="assets/img/MOCHA CHOCOLATE.jpg" alt="Mocha Chocolate">
                <div class="produto-info">
                    <h2>Mocha Chocolate</h2>
                    <p>Mocha de chocolate, com café e chocolate em uma combinação cremosa.</p>
                    <div class="produto-footer">
                        <strong>R$ 9,90</strong>
                        <button>Adicionar</button>
                    </div>
                </div>
            </article>

            <article class="produto" data-categoria="cafeteria">
                <img src="assets/img/MOCHA COM CARAMELO.jpg" alt="Mocha com Caramelo">
                <div class="produto-info">
                    <h2>Mocha com Caramelo</h2>
                    <p>Mocha com café, chocolate e um toque de caramelo.</p>
                    <div class="produto-footer">
                        <strong>R$ 10,90</strong>
                        <button>Adicionar</button>
                    </div>
                </div>
            </article>

            <article class="produto" data-categoria="cafeteria">
                <img src="assets/img/CAFÉ COADO NA HORA.jpg" alt="Café Coado na Hora">
                <div class="produto-info">
                    <h2> Café Coado na Hora</h2>
                    <p>Café fresco quentinho e coado na hora</p>
                    <div class="produto-footer">
                        <strong>R$ 11,90</strong>
                        <button>Adicionar</button>
                    </div>
                </div>
            </article>

            <article class="produto" data-categoria="cafeteria">
                <img src="assets/img/AFOGATTO.jpg" alt="Afogatto">
                <div class="produto-info">
                    <h2>Afogatto</h2>
                    <p>Frapê cremoso com sabor de avelã.</p>
                    <div class="produto-footer">
                        <strong>R$ 8,90</strong>
                        <button>Adicionar</button>
                    </div>
                </div>
            </article>

        </section>


        <!-- CTA -->        </section>


        <!-- CTA -->
        <section class="cardapio-cta" id="cardapio-fundo">

            <h2>
                Gostou do que viu?
            </h2>

            <p>
                Adicione seus produtos favoritos ao carrinho
                e finalize seu pedido.
            </p>

            <a href="index.php#contato">
                Fale Conosco
            </a>

        </section>

    </main>

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
                    <h4></h4>
                    <ul class="footer-links">
                        <li><a href="index.php#hero">Início</a></li>
                        <li><a href="index.php#sobre">Sobre Nós</a></li>
                        <li><a href="index.php#destaques">Cardápio</a></li>
                        <li><a href="index.php#contato">Contato</a></li>
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