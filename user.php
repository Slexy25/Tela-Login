<?php
require_once __DIR__ . '/includes/auth.php';
require_role('user');
?>
<!DOCTYPE html><html lang="pt-BR"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>User Page</title><link rel="stylesheet" href="assets/style.css"></head>
<body class="dashboard-page"><main class="dashboard-card"><span class="eyebrow">ÁREA DO USUÁRIO</span><h1>Bem-vindo, <?= escape($_SESSION['name']) ?>! 👋</h1><p>Seu login foi validado pelo PHP e MySQL.</p><a class="logout-button" href="logout.php">Sair da conta</a></main></body></html>
