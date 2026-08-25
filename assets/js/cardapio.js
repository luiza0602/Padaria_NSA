// ==========================
// CARDÁPIO
// Filtro de categorias + carrinho (contador simples)
// ==========================

document.addEventListener('DOMContentLoaded', () => {

    const categorias = document.querySelectorAll('.categoria');
    const produtos = document.querySelectorAll('.produto');
    const cartBadge = document.getElementById('cartBadge');

    let totalCarrinho = 0;

    // ---- Filtro de categorias ----
    categorias.forEach((btn) => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();

            const categoriaSelecionada = btn.dataset.categoria;

            // marca o botão ativo
            categorias.forEach((c) => c.classList.remove('ativa'));
            btn.classList.add('ativa');

            // mostra só os produtos da categoria escolhida
            produtos.forEach((produto) => {
                const mostrar = produto.dataset.categoria === categoriaSelecionada;
                produto.classList.toggle('mostrar', mostrar);
            });
        });
    });

    // ---- Adicionar ao carrinho ----
    produtos.forEach((produto) => {
        const botao = produto.querySelector('.produto-footer button');

        if (!botao) return;

        botao.addEventListener('click', () => {
            totalCarrinho++;
            if (cartBadge) cartBadge.textContent = totalCarrinho;

            const textoOriginal = botao.textContent;
            botao.textContent = 'Adicionado!';
            botao.classList.add('adicionado');

            setTimeout(() => {
                botao.textContent = textoOriginal;
                botao.classList.remove('adicionado');
            }, 1000);
        });
    });

});