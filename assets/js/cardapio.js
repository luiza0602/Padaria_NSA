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

    // FLUXO DE PAGAMENTO
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
                    <p>Escolha uma forma de pagamento para continuar.</p>

                    <div class="opcoes-principais">
                        <button class="opcao-pagamento" data-tipo="retirada" type="button">
                            <i class="fa-solid fa-store"></i>
                            <span>
                                <strong>Pagar na retirada</strong>
                                <small>Dinheiro ou cartão</small>
                            </span>
                            <i class="fa-solid fa-chevron-right"></i>
                        </button>

                        <button class="opcao-pagamento" data-tipo="site" type="button">
                            <i class="fa-solid fa-credit-card"></i>
                            <span>
                                <strong>Pagar no site</strong>
                                <small>Cartão ou Pix</small>
                            </span>
                            <i class="fa-solid fa-chevron-right"></i>
                        </button>
                    </div>
                </div>

                <div class="pagamento-etapa" data-etapa="retirada" hidden>
                    <button class="voltar-pagamento" type="button">← Voltar</button>
                    <span class="pagamento-subtitulo">PAGAMENTO NA RETIRADA</span>
                    <h2>Como você vai pagar?</h2>
                    <p>Escolha uma das opções abaixo.</p>

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

                    <button class="btn-whatsapp btn-confirmar-retirada" type="button">
                        Confirmar pedido
                    </button>
                </div>

                <div class="pagamento-etapa" data-etapa="site" hidden>
                    <button class="voltar-pagamento" type="button">← Voltar</button>
                    <span class="pagamento-subtitulo">PAGAMENTO ONLINE</span>
                    <h2>Escolha a forma de pagamento</h2>
                    <p>Selecione cartão ou Pix para continuar.</p>

                    <div class="formas-online">
                        <button class="forma-online" data-online="cartao" type="button">
                            <i class="fa-solid fa-credit-card"></i>
                            <span>
                                <strong>Cartão</strong>
                                <small>Crédito ou débito</small>
                            </span>
                        </button>

                        <button class="forma-online" data-online="pix" type="button">
                            <i class="fa-brands fa-pix"></i>
                            <span>
                                <strong>Pix</strong>
                                <small>Pagamento via Pix</small>
                            </span>
                        </button>
                    </div>

                    <div class="pagamento-online-form" hidden></div>
                </div>

                <div class="pagamento-resumo">
                    <span>Total do pedido</span>
                    <strong>R$ ${formatarMoeda(total)}</strong>
                </div>
            </div>
        `;

        document.body.appendChild(pagamento);

        const fechar = () => {
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
                pagamento.querySelector('.pagamento-online-form').hidden = true;
                pagamento.querySelector('.formas-online').hidden = false;
                mostrarEtapa('escolha');
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

            carrinho = [];
            atualizarContador();
            fechar();
        });

        pagamento.querySelectorAll('.forma-online').forEach((botao) => {
            botao.addEventListener('click', () => {
                pagamento.querySelector('.formas-online').hidden = true;
                const formulario = pagamento.querySelector('.pagamento-online-form');
                formulario.hidden = false;
                renderizarFormularioOnline(formulario, botao.dataset.online, pagamento);
            });
        });
    }

    function renderizarFormularioOnline(area, forma, pagamento) {
        if (forma === 'cartao') {
            area.innerHTML = `
                <button class="voltar-pagamento voltar-online" type="button">← Escolher outra forma</button>

                <div class="pagamento-formulario">
                    <span class="pagamento-subtitulo">PAGAMENTO COM CARTÃO</span>
                    <h3>Dados do cartão</h3>

                    <label>Número do cartão
                        <input class="campo-pagamento" type="text" inputmode="numeric"
                            maxlength="19" placeholder="0000 0000 0000 0000">
                    </label>

                    <label>Nome no cartão
                        <input class="campo-pagamento" type="text" placeholder="Nome completo">
                    </label>

                    <div class="campos-duplos">
                        <label>Validade
                            <input class="campo-pagamento" type="text" inputmode="numeric"
                                maxlength="5" placeholder="MM/AA">
                        </label>

                        <label>CVV
                            <input class="campo-pagamento" type="password" inputmode="numeric"
                                maxlength="4" placeholder="123">
                        </label>
                    </div>

                    <button class="btn-pagar-online" type="button">Finalizar pagamento</button>
                </div>
            `;

            area.querySelector('.voltar-online').addEventListener('click', () => {
                area.hidden = true;
                pagamento.querySelector('.formas-online').hidden = false;
            });

            area.querySelector('.btn-pagar-online').addEventListener('click', () => {
                const campos = [...area.querySelectorAll('.campo-pagamento')];
                const preenchidos = campos.every(campo => campo.value.trim() !== '');

                if (!preenchidos) {
                    alert('Preencha todos os dados do cartão.');
                    return;
                }

                mostrarSucessoPagamento(pagamento, 'Pagamento aprovado!', 'Seu pedido foi confirmado.');
                enviarWhatsApp({
                    formaPagamento: 'Cartão (online)',
                    statusPagamento: 'Pagamento aprovado'
                });

                carrinho = [];
                atualizarContador();
            });
        } else {
            const codigoPix = gerarCodigoPix();
            area.innerHTML = `
                <button class="voltar-pagamento voltar-online" type="button">← Escolher outra forma</button>

                <div class="pix-confirmacao">
                    <span class="pagamento-subtitulo">PAGAMENTO VIA PIX</span>
                    <h3>Faça o pagamento</h3>

                    <div class="pix-simulado">
                        <i class="fa-brands fa-pix"></i>
                        <strong>PIX</strong>
                    </div>

                    <p>Valor do pedido: <strong>R$ ${formatarMoeda(
                        carrinho.reduce((soma, item) => soma + item.preco * item.quantidade, 0)
                    )}</strong></p>

                    <div class="pix-copia">
                        <input type="text" value="${codigoPix}" readonly>
                        <button type="button" class="btn-copiar-pix">Copiar</button>
                    </div>

                    <button class="btn-pagar-online btn-confirmar-pix" type="button">
                        Confirmar pagamento
                    </button>
                </div>
            `;

            area.querySelector('.voltar-online').addEventListener('click', () => {
                area.hidden = true;
                pagamento.querySelector('.formas-online').hidden = false;
            });

            area.querySelector('.btn-copiar-pix').addEventListener('click', async () => {
                const campo = area.querySelector('input');

                try {
                    await navigator.clipboard.writeText(campo.value);
                } catch (e) {
                    campo.select();
                    document.execCommand('copy');
                }

                area.querySelector('.btn-copiar-pix').textContent = 'Copiado!';
            });

            area.querySelector('.btn-confirmar-pix').addEventListener('click', () => {
                mostrarSucessoPagamento(pagamento, 'Pagamento aprovado!', 'Seu pedido foi confirmado.');
                enviarWhatsApp({
                    formaPagamento: 'Pix (online)',
                    statusPagamento: 'Pagamento aprovado'
                });

                carrinho = [];
                atualizarContador();
            });
        }
    }

    function gerarCodigoPix() {
        const caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        let codigo = 'PADARIA.NSA.PIX.';

        for (let i = 0; i < 20; i++) {
            codigo += caracteres.charAt(Math.floor(Math.random() * caracteres.length));
        }

        return codigo;
    }

    function mostrarSucessoPagamento(pagamento, titulo, texto) {
        const etapa = pagamento.querySelector('[data-etapa="site"]');

        etapa.innerHTML = `
            <div class="pagamento-sucesso">
                <i class="fa-solid fa-circle-check"></i>
                <h2>${titulo}</h2>
                <p>${texto}</p>
                <button type="button" class="btn-whatsapp" id="fechar-sucesso-pagamento">
                    Fechar
                </button>
            </div>
        `;

        etapa.hidden = false;

        const btn = etapa.querySelector('#fechar-sucesso-pagamento');
        if (btn) {
            btn.addEventListener('click', () => pagamento.remove());
        }
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

    // ESC FECHA O CARRINHO E O PAGAMENTO
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            fecharCarrinho();

            const pagamento = document.querySelector('.pagamento-modal');
            if (pagamento) pagamento.remove();
        }
    });

    atualizarContador();
});