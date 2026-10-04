<?php
session_start();


require_once 'includes/bd-padariansa.php'; 


if (!isset($_SESSION['usuario_id']) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: login.php");
    exit;
}


$usuario_id = $_SESSION['usuario_id'];
$nome       = trim($_POST['nome'] ?? '');
$endereco   = trim($_POST['endereco'] ?? '');
$telefone   = trim($_POST['telefone'] ?? '');

$telefone_limpo = substr(preg_replace('/[^0-9]/', '', $_POST['telefone'] ?? ''), 0, 11);

// Validação simples para não permitir nome vazio
if (empty($nome)) {
    header("Location: perfil.php?status=erro_nome_vazio");
    exit;
}

try {
    
    $sql = "UPDATE usuarios SET nome = :nome, telefone = :telefone, endereco = :endereco WHERE id_usuario = :id";
    $stmt = $pdo->prepare($sql);
    
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':telefone', $telefone_limpo);
    $stmt->bindParam(':endereco', $endereco);
    $stmt->bindParam(':id', $usuario_id);

    
    if ($stmt->execute()) {
        $_SESSION['usuario_nome']     = $nome;
        $_SESSION['usuario_telefone'] = $telefone_limpo;
        $_SESSION['usuario_endereco'] = $endereco;

        header("Location: perfil.php?status=sucesso");
        exit;
    } else {
        header("Location: perfil.php?status=erro");
        exit;
    }

} catch (PDOException $e) {
    error_log("Erro ao atualizar conta: " . $e->getMessage());
    header("Location: perfil.php?status=erro");
    exit;
}
?>