<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

function redirect(string $path): void {
    header("Location: $path");
    exit;
}

function logged_in(): bool {
    return isset($_SESSION['user_id']);
}

function require_role(string $role): void {
    if (!logged_in()) {
        redirect('index.php');
    }
    if (($_SESSION['role'] ?? '') !== $role) {
        http_response_code(403);
        exit('Acesso negado.');
    }
}

function csrf_token(): string {
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function csrf_valid(?string $value): bool {
    return is_string($value) && hash_equals(csrf_token(), $value);
}

function flash(string $kind, string $message): void {
    $_SESSION['flash'] = ['kind' => $kind, 'message' => $message];
}

function escape(string $value): string {
    return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}
