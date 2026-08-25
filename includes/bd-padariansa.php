<?php


// Configurações do banco de dados no XAMPP
$host     = 'localhost';
$dbname   = 'bd_padariansa'; // Substitua pelo nome do seu banco de dados no phpMyAdmin
$usuario  = 'root';        // Usuário padrão do XAMPP
$senha    = '';            // Senha padrão do XAMPP é vazia

try {
    // Cria a conexão utilizando PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $usuario, $senha);
    
    // Configura o PDO para lançar exceções em caso de erros
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $e) {
    // Caso ocorra um erro de conexão, exibe a mensagem e encerra a execução
    die('Erro ao conectar com o banco de dados: ' . $e->getMessage());
}