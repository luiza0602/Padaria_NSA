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
                fecharCarrinho();
                abrirPagamento();
            });
        }
    }

    function fecharCarrinho() {
        const modal = document.querySelector('.carrinho-modal');
        if (modal) modal.remove();
        document.body.classList.remove('carrinho-aberto');
    }

    function abrirPagamento() {
        const pagamento = document.createElement('div');
        pagamento.className = 'pagamento-modal';

        const total = carrinho.reduce(
            (soma, item) => soma + item.preco * item.quantidade,
            0
        );

        pagamento.innerHTML = `
            <div class="pagamento-overlay"></div>
            <div class="pagamento-caixa" role="dialog" aria-modal="true">
                <button class="pagamento-fechar" type="button" aria-label="Fechar">×</button>

                <div class="pagamento-etapa" data-etapa="escolha">
                    <span class="pagamento-subtitulo">FINALIZAR PEDIDO</span>
                    <h2>Como você quer pagar?</h2>
                    <p>Escolha quando e onde o pagamento será realizado.</p>

                    <div class="opcoes-principais">
                        <button class="opcao-pagamento" data-tipo="retirada" type="button">
                            <i class="fa-solid fa-store"></i>
                            <span><strong>Pagar na retirada</strong><small>Dinheiro ou cartão</small></span>
                            <i class="fa-solid fa-chevron-right"></i>
                        </button>

                        <button class="opcao-pagamento" data-tipo="site" type="button">
                            <i class="fa-solid fa-credit-card"></i>
                            <span><strong>Pagar no site</strong><small>Cartão ou Pix</small></span>
                            <i class="fa-solid fa-chevron-right"></i>
                        </button>
                    </div>
                </div>

                <div class="pagamento-etapa" data-etapa="retirada" hidden>
                    <button class="voltar-pagamento" type="button">← Voltar</button>
                    <span class="pagamento-subtitulo">PAGAMENTO NA RETIRADA</span>
                    <h2>Como você vai pagar?</h2>
                    <p>O pagamento será feito quando você retirar o pedido.</p>

                    <div class="formas-pagamento">
                        <label>
                            <input type="radio" name="pagamento-retirada" value="Dinheiro">
                            <span><i class="fa-solid fa-money-bill-wave"></i> Dinheiro</span>
                        </label>
                        <label>
                            <input type="radio" name="pagamento-retirada" value="Cartão">
                            <span><i class="fa-solid fa-credit-card"></i> Cartão</span>
                        </label>
                    </div>

                    <button class="btn-whatsapp btn-confirmar-retirada" type="button">Confirmar pedido</button>
                </div>

                <div class="pagamento-etapa" data-etapa="site" hidden>
                    <button class="voltar-pagamento" type="button">← Voltar</button>
                    <span class="pagamento-subtitulo">PAGAMENTO ONLINE</span>
                    <h2>Pagamento pelo site</h2>
                    <p>Escolha cartão ou Pix. O pagamento será processado com segurança pelo Mercado Pago.</p>

                    <div class="formas-online">
                        <button class="forma-online" data-online="cartao" type="button">
                            <i class="fa-solid fa-credit-card"></i>
                            <span><strong>Cartão</strong><small>Crédito ou débito</small></span>
                        </button>
                        <button class="forma-online" data-online="pix" type="button">
                            <i class="fa-brands fa-pix"></i>
                            <span><strong>Pix</strong><small>QR Code ou copia e cola</small></span>
                        </button>
                    </div>

                    <div class="payment-brick-area" hidden>
                        <button class="voltar-pagamento voltar-online" type="button">← Escolher outra forma</button>
                        <div id="paymentBrick_container"></div>
                    </div>

                    <div class="pix-resultado" hidden></div>
                </div>

                <div class="pagamento-resumo">
                    <span>Total do pedido</span>
                    <strong>R$ ${formatarMoeda(total)}</strong>
                </div>
            </div>
        `;

        document.body.appendChild(pagamento);

        const fechar = () => {
            if (window.paymentBrickController) {
                try { window.paymentBrickController.unmount(); } catch (e) {}
                window.paymentBrickController = null;
            }
            pagamento.remove();
        };

        pagamento.querySelector('.pagamento-fechar').addEventListener('click', fechar);
        pagamento.querySelector('.pagamento-overlay').addEventListener('click', fechar);

        const mostrarEtapa = (nome) => {
            pagamento.querySelectorAll('.pagamento-etapa').forEach((etapa) => {
                etapa.hidden = etapa.dataset.etapa !== nome;
            });
        };

        pagamento.querySelectorAll('.opcao-pagamento').forEach((botao) => {
            botao.addEventListener('click', () => mostrarEtapa(botao.dataset.tipo));
        });

        pagamento.querySelectorAll('.voltar-pagamento').forEach((botao) => {
            botao.addEventListener('click', () => {
                if (window.paymentBrickController) {
                    try { window.paymentBrickController.unmount(); } catch (e) {}
                    window.paymentBrickController = null;
                }

                pagamento.querySelector('.payment-brick-area').hidden = true;
                pagamento.querySelector('.pix-resultado').hidden = true;
                pagamento.querySelector('.formas-online').hidden = false;
                mostrarEtapa(botao.classList.contains('voltar-online') ? 'site' : 'escolha');
            });
        });

        pagamento.querySelector('.btn-confirmar-retirada').addEventListener('click', () => {
            const selecionado = pagamento.querySelector('input[name="pagamento-retirada"]:checked');

            if (!selecionado) {
                alert('Escolha dinheiro ou cartão para a retirada.');
                return;
            }

            enviarWhatsApp({
                formaPagamento: selecionado.value,
                statusPagamento: 'Pagamento na retirada'
            });

            fechar();
            carrinho = [];
            atualizarContador();
        });

        pagamento.querySelectorAll('.forma-online').forEach((botao) => {
            botao.addEventListener('click', () => {
                pagamento.querySelector('.formas-online').hidden = true;
                pagamento.querySelector('.payment-brick-area').hidden = false;
                renderizarMercadoPago(pagamento, botao.dataset.online);
            });
        });
    }

    async function renderizarMercadoPago(pagamento, formaEscolhida) {
        const publicKey = 'COLOQUE_SUA_PUBLIC_KEY_AQUI';

        if (!window.MercadoPago) {
            alert('O Mercado Pago não foi carregado. Verifique a conexão com a internet.');
            return;
        }

        if (publicKey === 'COLOQUE_SUA_PUBLIC_KEY_AQUI') {
            alert('Configure sua Public Key do Mercado Pago no arquivo assets/js/cardapio.js.');
            return;
        }

        if (window.paymentBrickController) {
            try { window.paymentBrickController.unmount(); } catch (e) {}
        }

        const total = carrinho.reduce(
            (soma, item) => soma + item.preco * item.quantidade,
            0
        );

        const mp = new MercadoPago(publicKey, { locale: 'pt-BR' });
        const bricksBuilder = mp.bricks();

        const paymentMethods = formaEscolhida === 'pix'
            ? { bankTransfer: 'all' }
            : { creditCard: 'all', debitCard: 'all' };

        const settings = {
            initialization: {
                amount: Number(total.toFixed(2))
            },
            customization: {
                paymentMethods
            },
            callbacks: {
                onReady: () => {},
                onError: (error) => console.error('Mercado Pago:', error),
                onSubmit: async ({ selectedPaymentMethod, formData }) => {
                    try {
                        const response = await fetch('process_payment.php', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json' },
                            body: JSON.stringify({
                                ...formData,
                                transaction_amount: Number(total.toFixed(2))
                            })
                        });

                        const resultado = await response.json();

                        if (!response.ok) {
                            throw new Error(resultado.error || 'Erro ao processar pagamento.');
                        }

                        if (resultado.status === 'approved') {
                            enviarWhatsApp({
                                formaPagamento: selectedPaymentMethod === 'pix'
                                    ? 'Pix (pago online)'
                                    : 'Cartão (pago online)',
                                statusPagamento: 'Pagamento aprovado'
                            });

                            mostrarSucessoPagamento(
                                pagamento,
                                'Pagamento aprovado!',
                                'Seu pedido foi confirmado.'
                            );

                            carrinho = [];
                            atualizarContador();
                        } else if (resultado.status === 'pending' && resultado.pix) {
                            mostrarPix(pagamento, resultado.pix);
                        } else {
                            mostrarSucessoPagamento(
                                pagamento,
                                'Pagamento em análise',
                                'O pedido foi criado, mas o pagamento ainda não foi aprovado.'
                            );
                        }
                    } catch (erro) {
                        console.error(erro);
                        alert(erro.message || 'Não foi possível processar o pagamento.');
                    }
                }
            }
        };

        window.paymentBrickController = await bricksBuilder.create(
            'payment',
            'paymentBrick_container',
            settings
        );
    }

    function mostrarPix(pagamento, pix) {
        const area = pagamento.querySelector('.pix-resultado');
        const brickArea = pagamento.querySelector('.payment-brick-area');

        if (brickArea) brickArea.hidden = true;
        if (!area) return;

        area.hidden = false;

        const imagem = pix.qr_code_base64
            ? '<img src="data:image/png;base64,' + pix.qr_code_base64 + '" alt="QR Code Pix" class="pix-qr-code">'
            : '';

        area.innerHTML =
            '<div class="pix-confirmacao">' +
                '<span class="pagamento-subtitulo">PAGAMENTO VIA PIX</span>' +
                '<h3>Escaneie o QR Code</h3>' +
                imagem +
                '<p>Ou copie o código Pix abaixo:</p>' +
                '<div class="pix-copia">' +
                    '<input type="text" value="' + (pix.qr_code || '') + '" readonly>' +
                    '<button type="button" class="btn-copiar-pix">Copiar</button>' +
                '</div>' +
                '<p class="pix-aviso">Depois de pagar, o pedido continuará registrado como aguardando confirmação do pagamento.</p>' +
            '</div>';

        area.querySelector('.btn-copiar-pix').addEventListener('click', async () => {
            const campo = area.querySelector('input');
            try {
                await navigator.clipboard.writeText(campo.value);
                area.querySelector('.btn-copiar-pix').textContent = 'Copiado!';
            } catch (e) {
                campo.select();
                document.execCommand('copy');
            }
        });

        enviarWhatsApp({
            formaPagamento: 'Pix (online)',
            statusPagamento: 'Aguardando confirmação do pagamento'
        });
    }

    function mostrarSucessoPagamento(pagamento, titulo, texto) {
        const etapa = pagamento.querySelector('[data-etapa="site"]');

        etapa.innerHTML =
            '<div class="pagamento-sucesso">' +
                '<i class="fa-solid fa-circle-check"></i>' +
                '<h2>' + titulo + '</h2>' +
                '<p>' + texto + '</p>' +
                '<button type="button" class="btn-whatsapp" id="fechar-sucesso-pagamento">Fechar</button>' +
            '</div>';

        etapa.hidden = false;

        const btn = etapa.querySelector('#fechar-sucesso-pagamento');
        if (btn) btn.addEventListener('click', () => pagamento.remove());
    }

    function enviarWhatsApp({ formaPagamento, statusPagamento }) {
        const numeroWhatsApp = '5516996016977';

        let mensagem = '🥐 *NOVO PEDIDO - PADARIA NSA*\\n\\n';
        mensagem += '*Pedido:*\\n';

        carrinho.forEach((item) => {
            const subtotal = item.preco * item.quantidade;
            mensagem += item.quantidade + 'x ' + item.nome + ' - R$ ' +
                formatarMoeda(subtotal) + '\\n';
        });

        const total = carrinho.reduce(
            (soma, item) => soma + item.preco * item.quantidade,
            0
        );

        mensagem += '\\n*Total: R$ ' + formatarMoeda(total) + '*\\n';
        mensagem += '*Forma de pagamento: ' + formaPagamento + '*\\n';
        mensagem += '*Status: ' + statusPagamento + '*';

        const linkWhatsApp =
            'https://wa.me/' + numeroWhatsApp + '?text=' + encodeURIComponent(mensagem);

        window.open(linkWhatsApp, '_blank');
    }

    function formatarMoeda(valor) {
        return valor.toFixed(2).replace('.', ',');
    }

    // ESC FECHA O CARRINHO
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            fecharCarrinho();

            const pagamento = document.querySelector('.pagamento-modal');
            if (pagamento) pagamento.remove();
        }
    });

    atualizarContador();
});