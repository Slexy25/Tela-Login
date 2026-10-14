<?php
require_once __DIR__ . '/includes/auth.php';
if (logged_in()) {
    redirect(($_SESSION['role'] ?? '') === 'admin' ? 'admin.php' : 'user.php');
}
$message = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
$view = ($_GET['view'] ?? '') === 'register' ? 'register' : 'login';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Full Stack | Login</title>
  <link rel="stylesheet" href="assets/style.css">
  <script src="assets/app.js" defer></script>
</head>
<body class="auth-page" data-view="<?= escape($view) ?>">
  <main class="scene">
    <section class="branding" aria-label="Tecnologias do projeto">
      <h1>🔥 Full Stack</h1>
      <div class="tech-row" aria-label="HTML, CSS, JavaScript, PHP e MySQL">
        <span class="tech html">HTML<span>5</span></span>
        <span class="tech css">CSS<span>3</span></span>
        <span class="tech js">JS</span>
        <span class="tech php">php</span>
        <span class="tech mysql">My<span>SQL</span></span>
      </div>
      <div class="page-labels">
        <div><strong>ADMIN</strong> PAGE</div>
        <div><strong>USER</strong> PAGE</div>
      </div>
    </section>

    <section class="auth-area" aria-label="Acesso à conta">
      <div class="auth-card register-card" id="register-card">
        <h2>Register</h2>
        <form action="register.php" method="post">
          <input type="hidden" name="csrf_token" value="<?= escape(csrf_token()) ?>">
          <label class="sr-only" for="reg-name">Nome</label>
          <input id="reg-name" name="name" type="text" placeholder="Name" required maxlength="100" autocomplete="name">
          <label class="sr-only" for="reg-email">E-mail</label>
          <input id="reg-email" name="email" type="email" placeholder="Email" required maxlength="190" autocomplete="email">
          <label class="sr-only" for="reg-password">Senha</label>
          <input id="reg-password" name="password" type="password" placeholder="Password (min. 8 characters)" minlength="8" required autocomplete="new-password">
          <label class="sr-only" for="reg-role">Tipo de conta</label>
          <select id="reg-role" disabled aria-label="Tipo de conta"><option>User</option></select>
          <p class="helper">Novos cadastros são sempre usuários comuns.</p>
          <button type="submit">Register</button>
        </form>
        <p class="switch-text">Already have an account? <a href="?view=login" data-switch="login">Login</a></p>
      </div>

      <div class="auth-card login-card" id="login-card">
        <h2>Login</h2>
        <?php if ($message): ?>
          <div class="message <?= $message['kind'] === 'success' ? 'success' : 'error' ?>" role="alert"><?= escape($message['message']) ?></div>
        <?php endif; ?>
        <form action="login.php" method="post">
          <input type="hidden" name="csrf_token" value="<?= escape(csrf_token()) ?>">
          <label class="sr-only" for="login-email">E-mail</label>
          <input id="login-email" name="email" type="email" placeholder="Email" required autocomplete="email">
          <label class="sr-only" for="login-password">Senha</label>
          <input id="login-password" name="password" type="password" placeholder="Password" required autocomplete="current-password">
          <button type="submit">Login</button>
        </form>
        <p class="switch-text">Don't have an account? <a href="?view=register" data-switch="register">Register</a></p>
      </div>
    </section>
  </main>
</body>
</html>
