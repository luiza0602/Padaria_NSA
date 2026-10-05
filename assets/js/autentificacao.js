// login / cadastro
// validação antes de enviar para login.php / cadastro.php

document.addEventListener('DOMContentLoaded', () => {

    const formLogin = document.getElementById('form-login');
    const formCadastro = document.getElementById('form-cadastro');

    if (formLogin) {
        formLogin.addEventListener('submit', (e) => {
            const email = document.getElementById('login-email').value.trim();
            const senha = document.getElementById('login-senha').value;

            if (!email || !senha) {
                e.preventDefault();
                alert('Preencha e-mail e senha para continuar.');
            }
        });
    }

    if (formCadastro) {
        formCadastro.addEventListener('submit', (e) => {
            const senha = document.getElementById('cad-senha').value;
            const confirmaSenha = document.getElementById('cad-confirma-senha').value;
            const termos = document.getElementById('termos').checked;

            if (senha !== confirmaSenha) {
                e.preventDefault();
                alert('As senhas não coincidem.');
                return;
            }

            if (!termos) {
                e.preventDefault();
                alert('Você precisa aceitar os Termos de Uso para continuar.');
            }
        });
    }

    // Olho de mostrar/ocultar senha
    document.querySelectorAll('.toggle-senha').forEach((icone) => {
        icone.addEventListener('click', () => {
            const input = icone.parentElement.querySelector('input');
            if (!input) return;

            const mostrando = input.type === 'text';
            input.type = mostrando ? 'password' : 'text';

            icone.classList.toggle('fa-eye', mostrando);
            icone.classList.toggle('fa-eye-slash', !mostrando);
        });
    });

    // Máscara de telefone
const inputTelefone = document.getElementById('cad-telefone');
if (inputTelefone) {
    inputTelefone.addEventListener('input', (e) => {
        let valor = e.target.value.replace(/\D/g, "").substring(0, 11);

        valor = valor.replace(/^(\d{2})(\d)/, "($1) $2");
        valor = valor.replace(/(\d{4,5})(\d{4})$/, "$1-$2");

        e.target.value = valor;
    });
}

});