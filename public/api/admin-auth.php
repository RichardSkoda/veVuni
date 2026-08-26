<?php
/**
 * Admin authentication.
 * GET/POST /api/admin-auth.php                     — verify X-Admin-Token (login check)
 * POST     /api/admin-auth.php?action=change-password — change the admin password
 */

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, X-Admin-Token');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}

require_once __DIR__ . '/lib.php';

requireAdmin();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_GET['action'] ?? '') === 'change-password') {
    $input = json_decode(file_get_contents('php://input'), true);
    $newPassword = trim($input['newPassword'] ?? '');

    if (strlen($newPassword) < 10) {
        http_response_code(400);
        echo json_encode(['error' => 'Nové heslo musí mít alespoň 10 znaků.']);
        exit;
    }

    setAdminPasswordHash(password_hash($newPassword, PASSWORD_BCRYPT));
    echo json_encode(['success' => true]);
    exit;
}

// A plain request with a valid X-Admin-Token is a login check.
echo json_encode(['success' => true]);
