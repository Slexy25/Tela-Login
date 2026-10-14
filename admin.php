<?php
require_once __DIR__ . '/includes/auth.php';
require_role('admin');
?>
<!DOCTYPE html><html lang="pt-BR"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Admin Page</title><link rel="stylesheet" href="assets/style.css"></head>
<body class="dashboard-page"><main class="dashboard-card"><span class="eyebrow">PAINEL ADMINISTRATIVO</span><h1>Olá, <?= escape($_SESSION['name']) ?>! 👑</h1><p>Você entrou como administrador. Esta área é protegida no servidor.</p><a class="logout-button" href="logout.php">Sair da conta</a></main></body></html>
