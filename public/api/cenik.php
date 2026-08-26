<?php
/**
 * Pricing overrides API.
 * GET  /api/cenik.php — vrátí uložené přepisy cen (veřejné)
 * POST /api/cenik.php — uloží přepisy cen (vyžaduje heslo)
 *
 * Jména služeb a časy zůstávají statické (v src/i18n/*.js) — edituje se
 * pouze cena, uložená v Kč formátu; anglická stránka si "Kč" nahradí za
 * "CZK" na frontendu.
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

$dataFile = __DIR__ . '/data/cenik.json';

function loadPrices($file) {
    if (!file_exists($file)) {
        return ['packages' => new stdClass(), 'individual' => new stdClass()];
    }
    $data = json_decode(file_get_contents($file), true);
    return [
        'packages'   => is_array($data['packages'] ?? null) ? $data['packages'] : new stdClass(),
        'individual' => is_array($data['individual'] ?? null) ? $data['individual'] : new stdClass(),
    ];
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    echo json_encode(loadPrices($dataFile));
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    requireAdmin();

    $input      = json_decode(file_get_contents('php://input'), true);
    $packages   = is_array($input['packages'] ?? null) ? $input['packages'] : [];
    $individual = is_array($input['individual'] ?? null) ? $input['individual'] : [];

    $clean = ['packages' => [], 'individual' => []];
    foreach ($packages as $idx => $price) {
        $price = sanitize((string) $price);
        if ($price !== '') {
            $clean['packages'][(string) (int) $idx] = $price;
        }
    }
    foreach ($individual as $idx => $price) {
        $price = sanitize((string) $price);
        if ($price !== '') {
            $clean['individual'][(string) (int) $idx] = $price;
        }
    }

    $dir = dirname($dataFile);
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
    file_put_contents($dataFile, json_encode($clean, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

    echo json_encode(['success' => true]);
    exit;
}

http_response_code(405);
echo json_encode(['error' => 'Metoda není povolena.']);
