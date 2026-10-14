<?php
require_once __DIR__ . '/includes/auth.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') redirect('index.php?view=register');
if (!csrf_valid($_POST['csrf_token'] ?? null)) { http_response_code(403); exit('Requisição inválida.'); }
$name = trim((string) ($_POST['name'] ?? ''));
$email = strtolower(trim((string) ($_POST['email'] ?? '')));
$password = (string) ($_POST['password'] ?? '');
if ($name === '' || strlen($name) > 100 || strlen($email) > 190 || !filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($password) < 8) {
    flash('error', 'Confira nome, e-mail e senha (mínimo 8 caracteres).');
    redirect('index.php?view=register');
}
require_once __DIR__ . '/config/database.php';
try {
    $statement = $pdo->prepare('INSERT INTO users (name, email, password_hash, role) VALUES (?, ?, ?, ?)');
    $statement->execute([$name, $email, password_hash($password, PASSWORD_DEFAULT), 'user']);
    flash('success', 'Cadastro realizado! Agora faça seu login.');
    redirect('index.php');
} catch (PDOException $e) {
    if ($e->getCode() === '23000') {
        flash('error', 'Este e-mail já está cadastrado.');
    } else {
        error_log($e->getMessage());
        flash('error', 'Não foi possível concluir o cadastro.');
    }
    redirect('index.php?view=register');
}
