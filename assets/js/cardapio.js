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

    // ADICIONAR PRODUTOS
    produtos.forEach((produto) => {
        const botao = produto.querySelector('.produto-footer button');
        if (!botao) return;

        botao.addEventListener('click', () => {
            const nome = produto.querySelector('h2').textContent.trim();
            const preco = parseFloat(
                produto.querySelector('strong').textContent
                    .replace('R$', '')
                    .replace('.', '')
                    .replace(',', '.')
                    .trim()
            );

            const existente = carrinho.find(item => item.nome === nome);

            if (existente) {
                existente.quantidade++;
            } else {
                carrinho.push({
                    nome,
                    preco,
                    quantidade: 1
                });
            }

            atualizarContador();

            const texto = botao.textContent;
            botao.textContent = 'Adicionado!';
            botao.classList.add('adicionado');

            setTimeout(() => {
                botao.textContent = texto;
                botao.classList.remove('adicionado');
            }, 1000);
        });
    });

    function atualizarContador() {
        const quantidade = carrinho.reduce(
            (total, item) => total + item.quantidade,
            0
        );

        if (cartBadge) {
            cartBadge.textContent = quantidade;
        }
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

        let itensHTML = '';

        if (carrinho.length === 0) {
            itensHTML = `
                <div class="carrinho-vazio">
                    <i class="fa-solid fa-basket-shopping"></i>
                    <p>Seu carrinho está vazio.</p>
                    <span>Adicione seus produtos favoritos!</span>
                </div>
            `;
        } else {
            carrinho.forEach((item, index) => {
                itensHTML += `
                    <div class="item-carrinho">
                        <div class="item-info">
                            <h3>${item.nome}</h3>
                            <strong>R$ ${item.preco.toFixed(2).replace('.', ',')}</strong>
                        </div>

                        <div class="item-controles">
                            <button class="btn-menos" data-index="${index}">−</button>
                            <span>${item.quantidade}</span>
                            <button class="btn-mais" data-index="${index}">+</button>
                            <button class="btn-remover" data-index="${index}" aria-label="Remover">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>
                    </div>
                `;
            });
        }

        const total = carrinho.reduce(
            (soma, item) => soma + item.preco * item.quantidade,
            0
        );

        modal.innerHTML = `
            <div class="carrinho-overlay"></div>

            <div class="carrinho-caixa">
                <div class="carrinho-header">
                    <h2>Seu Carrinho</h2>
                    <button class="carrinho-fechar" aria-label="Fechar">×</button>
                </div>

                <div class="carrinho-itens">
                    ${itensHTML}
                </div>

                ${carrinho.length ? `
                    <div class="carrinho-total">
                        <span>Total</span>
                        <strong>R$ ${total.toFixed(2).replace('.', ',')}</strong>
                    </div>

                    <button class="btn-finalizar">
                        Finalizar Pedido
                    </button>
                ` : ''}
            </div>
        `;

        document.body.appendChild(modal);

        modal.querySelector('.carrinho-fechar')
            .addEventListener('click', () => modal.remove());

        modal.querySelector('.carrinho-overlay')
            .addEventListener('click', () => modal.remove());

        modal.querySelectorAll('.btn-mais').forEach((botao) => {
            botao.addEventListener('click', () => {
                carrinho[botao.dataset.index].quantidade++;
                atualizarContador();
                abrirCarrinho();
            });
        });

        modal.querySelectorAll('.btn-menos').forEach((botao) => {
            botao.addEventListener('click', () => {
                const index = botao.dataset.index;

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
                carrinho.splice(botao.dataset.index, 1);
                atualizarContador();
                abrirCarrinho();
            });
        });

        const finalizar = modal.querySelector('.btn-finalizar');

        if (finalizar) {
            finalizar.addEventListener('click', () => {
                alert('Seu pedido foi preparado para finalização!');
            });
        }
    }
});