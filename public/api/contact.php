<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Metoda není povolena.']);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);

$name    = isset($input['name'])    ? trim($input['name'])    : '';
$email   = isset($input['email'])   ? trim($input['email'])   : '';
$service = isset($input['service']) ? trim($input['service']) : '';
$message = isset($input['message']) ? trim($input['message']) : '';

// Validace
if (!$name || !$email || !$service || !$message) {
    http_response_code(400);
    echo json_encode(['error' => 'Všechna pole jsou povinná.']);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(['error' => 'Neplatná e-mailová adresa.']);
    exit;
}

// Sanitizace
$name    = htmlspecialchars($name,    ENT_QUOTES, 'UTF-8');
$email   = htmlspecialchars($email,   ENT_QUOTES, 'UTF-8');
$service = htmlspecialchars($service, ENT_QUOTES, 'UTF-8');
$message = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');

$to      = 'michal@vevuni.cz';
$subject = '=?UTF-8?B?' . base64_encode('[VeVůni] Nová poptávka: ' . $service) . '?=';

$body  = "Nová poptávka z webu VeVůni\n";
$body .= str_repeat('-', 40) . "\n";
$body .= "Jméno:   $name\n";
$body .= "E-mail:  $email\n";
$body .= "Služba:  $service\n";
$body .= str_repeat('-', 40) . "\n";
$body .= "Zpráva:\n$message\n";

// From musí být adresa existující na hostingu, jinak hosting mail zahodí
$headers  = "From: michal@vevuni.cz\r\n";
$headers .= "Reply-To: $email\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
$headers .= "Content-Transfer-Encoding: 8bit\r\n";
$headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";

// Parametr -f nastaví envelope sender (pomáhá s doručitelností)
$additional_params = '-f michal@vevuni.cz';

$sent = mail($to, $subject, $body, $headers, $additional_params);

// Logování pouze při chybě
if (!$sent) {
    $logFile = __DIR__ . '/mail.log';
    $logLine = date('Y-m-d H:i:s') . ' | sent=false'
             . ' | name=' . $name
             . ' | email=' . $email
             . ' | service=' . $service
             . ' | error=' . json_encode(error_get_last()) . "\n";
    file_put_contents($logFile, $logLine, FILE_APPEND | LOCK_EX);
}

if ($sent) {
    echo json_encode(['success' => true, 'message' => 'E-mail byl úspěšně odeslán.']);
} else {
    http_response_code(500);
    echo json_encode(['error' => 'Nepodařilo se odeslat e-mail.']);
}
