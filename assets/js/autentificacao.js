// ==========================
// LOGIN / CADASTRO
// Validação simples no front-end antes de enviar para login.php / cadastro.php
// ==========================

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
            // se passou na validação, o form segue normalmente para login.php
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
            // se passou na validação, o form segue normalmente para cadastro.php
        });
    }

});
