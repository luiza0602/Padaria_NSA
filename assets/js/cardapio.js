document.addEventListener('DOMContentLoaded', () => {

    const categorias = document.querySelectorAll('.categoria');
    const produtos = document.querySelectorAll('.produto');
    const cartBadge = document.getElementById('cartBadge');
    const btnCarrinho = document.getElementById('btnCarrinho');

    let carrinho = [];

    // FILTRO DE CATEGORIAS
    categorias.forEach((categoria) => {
        categoria.addEventListener('click', (e) => {
            e.preventDefault();

            const selecionada = categoria.dataset.categoria;

            categorias.forEach((c) => c.classList.remove('ativa'));
            categoria.classList.add('ativa');

            produtos.forEach((produto) => {
                produto.classList.toggle(
                    'mostrar',
                    produto.dataset.categoria === selecionada
                );
            });
        });
    });

    // ADICIONAR AO CARRINHO
    produtos.forEach((produto) => {
        const botao = produto.querySelector('.produto-footer button');
        if (!botao) return;

        botao.addEventListener('click', () => {
            const nome = produto.querySelector('h2')?.textContent.trim();
            const precoTexto = produto.querySelector('strong')?.textContent || '';
            const preco = parseFloat(
                precoTexto.replace('R$', '').replace('.', '').replace(',', '.').trim()
            );

            if (!nome || Number.isNaN(preco)) return;

            const existente = carrinho.find(item => item.nome === nome);

            if (existente) {
                existente.quantidade++;
            } else {
                carrinho.push({ nome, preco, quantidade: 1 });
            }

            atualizarContador();
            feedbackBotao(botao);
        });
    });

    function atualizarContador() {
        const quantidade = carrinho.reduce(
            (total, item) => total + item.quantidade, 0
        );

        if (cartBadge) {
            cartBadge.textContent = quantidade;
            cartBadge.classList.toggle('vazio', quantidade === 0);
        }
    }

    function feedbackBotao(botao) {
        const original = botao.textContent;
        botao.textContent = 'Adicionado!';
        botao.classList.add('adicionado');

        setTimeout(() => {
            botao.textContent = original;
            botao.classList.remove('adicionado');
        }, 900);
    }

    // ABRIR CARRINHO
    if (btnCarrinho) {
        btnCarrinho.addEventListener('click', abrirCarrinho);
    }

    function abrirCarrinho() {
        const antigo = document.querySelector('.carrinho-modal');
        if (antigo) antigo.remove();

        const modal = document.createElement('div');
        modal.className = 'carrinho-modal';

        let itens = '';

        if (carrinho.length === 0) {
            itens = `
                <div class="carrinho-vazio">
                    <i class="fa-solid fa-basket-shopping"></i>
                    <h3>Seu carrinho está vazio</h3>
                    <p>Adicione seus produtos favoritos do cardápio.</p>
                </div>
            `;
        } else {
            itens = carrinho.map((item, index) => `
                <div class="item-carrinho">
                    <div class="item-info">
                        <h3>${item.nome}</h3>
                        <strong>R$ ${formatarMoeda(item.preco * item.quantidade)}</strong>
                    </div>

                    <div class="item-controles">
                        <button class="btn-menos" data-index="${index}" aria-label="Diminuir">−</button>
                        <span>${item.quantidade}</span>
                        <button class="btn-mais" data-index="${index}" aria-label="Aumentar">+</button>
                        <button class="btn-remover" data-index="${index}" aria-label="Remover">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </div>
                </div>
            `).join('');
        }

        const total = carrinho.reduce(
            (soma, item) => soma + item.preco * item.quantidade,
            0
        );

        modal.innerHTML = `
            <div class="carrinho-overlay"></div>

            <div class="carrinho-caixa" role="dialog" aria-modal="true" aria-label="Seu carrinho">
                <div class="carrinho-header">
                    <div>
                        <span class="carrinho-subtitulo">SEU PEDIDO</span>
                        <h2>Seu Carrinho</h2>
                    </div>
                    <button class="carrinho-fechar" aria-label="Fechar carrinho">×</button>
                </div>

                <div class="carrinho-itens">
                    ${itens}
                </div>

                ${carrinho.length ? `
                    <div class="carrinho-total">
                        <span>Total</span>
                        <strong>R$ ${formatarMoeda(total)}</strong>
                    </div>

                    <button class="btn-finalizar">
                        Continuar Pedido
                    </button>
                ` : ''}
            </div>
        `;

        document.body.appendChild(modal);
        document.body.classList.add('carrinho-aberto');

        modal.querySelector('.carrinho-fechar').addEventListener('click', fecharCarrinho);
        modal.querySelector('.carrinho-overlay').addEventListener('click', fecharCarrinho);

        modal.querySelectorAll('.btn-mais').forEach((botao) => {
            botao.addEventListener('click', () => {
                carrinho[Number(botao.dataset.index)].quantidade++;
                atualizarContador();
                abrirCarrinho();
            });
        });

        modal.querySelectorAll('.btn-menos').forEach((botao) => {
            botao.addEventListener('click', () => {
                const index = Number(botao.dataset.index);

                if (carrinho[index].quantidade > 1) {
                    carrinho[index].quantidade--;
                } else {
                    carrinho.splice(index, 1);
                }

                atualizarContador();
                abrirCarrinho();
            });
        });

        modal.querySelectorAll('.btn-remover').forEach((botao) => {
            botao.addEventListener('click', () => {
                carrinho.splice(Number(botao.dataset.index), 1);
                atualizarContador();
                abrirCarrinho();
            });
        });

        const finalizar = modal.querySelector('.btn-finalizar');

        if (finalizar) {
            finalizar.addEventListener('click', () => {
                alert('Carrinho pronto! A próxima etapa será a finalização do pedido.');
            });
        }
    }

    function fecharCarrinho() {
        const modal = document.querySelector('.carrinho-modal');
        if (modal) modal.remove();
        document.body.classList.remove('carrinho-aberto');
    }

    function formatarMoeda(valor) {
        return valor.toFixed(2).replace('.', ',');
    }

    // ESC FECHA O CARRINHO
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') fecharCarrinho();
    });

    atualizarContador();
});