<?php
/**
 * Shared helpers for the API endpoints: admin credential storage/verification
 * and input sanitization.
 *
 * The active admin password hash lives in data/admin-config.json, which is
 * NOT committed to git (see .gitignore) — it's created/overwritten on the
 * server the first time someone changes the password from Admin → Změnit
 * heslo. Until that happens, BOOTSTRAP_ADMIN_PASSWORD_HASH below is used as
 * a fallback. Treat that bootstrap value as public/compromised (it lives in
 * git history) and change the password immediately after deploying.
 */

const BOOTSTRAP_ADMIN_PASSWORD_HASH = '$2a$12$k2QS8srOuBlNgVCUr924ROa0hYcMt3XaKgR9jGMOMLyBuEL8M3VV.';

function adminConfigPath() {
    return __DIR__ . '/data/admin-config.json';
}

function getAdminPasswordHash() {
    $path = adminConfigPath();
    if (file_exists($path)) {
        $data = json_decode(file_get_contents($path), true);
        if (!empty($data['password_hash'])) {
            return $data['password_hash'];
        }
    }
    return BOOTSTRAP_ADMIN_PASSWORD_HASH;
}

function setAdminPasswordHash($hash) {
    $dir = dirname(adminConfigPath());
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
    file_put_contents(adminConfigPath(), json_encode(['password_hash' => $hash], JSON_PRETTY_PRINT));
}

function requireAdmin() {
    $token = $_SERVER['HTTP_X_ADMIN_TOKEN'] ?? '';
    if (!$token || !password_verify($token, getAdminPasswordHash())) {
        http_response_code(401);
        echo json_encode(['error' => 'Neplatné heslo.']);
        exit;
    }
}

function sanitize($str) {
    return htmlspecialchars(trim($str), ENT_QUOTES, 'UTF-8');
}
