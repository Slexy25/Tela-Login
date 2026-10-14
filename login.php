<?php
require_once __DIR__ . '/includes/auth.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') redirect('index.php');
if (!csrf_valid($_POST['csrf_token'] ?? null)) { http_response_code(403); exit('Requisição inválida.'); }
$email = strtolower(trim((string) ($_POST['email'] ?? '')));
$password = (string) ($_POST['password'] ?? '');
require_once __DIR__ . '/config/database.php';
$stmt = $pdo->prepare('SELECT id, name, password_hash, role FROM users WHERE email = ? LIMIT 1');
$stmt->execute([$email]);
$user = $stmt->fetch();
if (!$user || !password_verify($password, $user['password_hash'])) {
    flash('error', 'E-mail ou senha incorretos.');
    redirect('index.php');
}
session_regenerate_id(true);
$_SESSION['user_id'] = (int) $user['id'];
$_SESSION['name'] = $user['name'];
$_SESSION['role'] = $user['role'];
redirect($user['role'] === 'admin' ? 'admin.php' : 'user.php');
