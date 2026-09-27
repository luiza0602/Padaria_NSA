<?php

header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Método não permitido.']);
    exit;
}

$configPath = __DIR__ . '/includes/mercadopago.php';

if (!file_exists($configPath)) {
    http_response_code(500);
    echo json_encode([
        'error' => 'Configuração do Mercado Pago não encontrada. Copie includes/mercadopago.example.php para includes/mercadopago.php e informe seu Access Token.'
    ]);
    exit;
}

$config = require $configPath;

if (empty($config['access_token']) || $config['access_token'] === 'COLOQUE_SEU_ACCESS_TOKEN_AQUI') {
    http_response_code(500);
    echo json_encode(['error' => 'Access Token do Mercado Pago não configurado.']);
    exit;
}

require_once __DIR__ . '/vendor/autoload.php';

use MercadoPago\Client\Common\RequestOptions;
use MercadoPago\Client\Payment\PaymentClient;
use MercadoPago\MercadoPagoConfig;

$body = json_decode(file_get_contents('php://input'), true);

if (!is_array($body)) {
    http_response_code(400);
    echo json_encode(['error' => 'Dados do pagamento inválidos.']);
    exit;
}

$amount = isset($body['transaction_amount']) ? (float) $body['transaction_amount'] : 0;
$paymentMethod = $body['payment_method_id'] ?? '';
$payer = $body['payer'] ?? [];

if ($amount <= 0 || empty($paymentMethod) || empty($payer['email'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Dados obrigatórios do pagamento não foram enviados.']);
    exit;
}

MercadoPagoConfig::setAccessToken($config['access_token']);

$request = [
    'transaction_amount' => $amount,
    'description' => 'Pedido Padaria NSA',
    'payment_method_id' => $paymentMethod,
    'payer' => [
        'email' => $payer['email'],
    ],
];

if (!empty($payer['identification']['type']) && !empty($payer['identification']['number'])) {
    $request['payer']['identification'] = [
        'type' => $payer['identification']['type'],
        'number' => $payer['identification']['number'],
    ];
}

if (!empty($body['token'])) {
    $request['token'] = $body['token'];
}

if (!empty($body['installments'])) {
    $request['installments'] = (int) $body['installments'];
}

if (!empty($body['issuer_id'])) {
    $request['issuer_id'] = (int) $body['issuer_id'];
}

try {
    $client = new PaymentClient();

    $options = new RequestOptions();
    $options->setCustomHeaders([
        'X-Idempotency-Key: ' . bin2hex(random_bytes(16))
    ]);

    $payment = $client->create($request, $options);

    $response = [
        'id' => $payment->id ?? null,
        'status' => $payment->status ?? null,
        'status_detail' => $payment->status_detail ?? null,
        'payment_method_id' => $payment->payment_method_id ?? $paymentMethod,
    ];

    // No Pix, retornamos os dados necessários para QR Code/copia e cola.
    if ($paymentMethod === 'pix' && isset($payment->point_of_interaction->transaction_data)) {
        $transactionData = $payment->point_of_interaction->transaction_data;

        $response['pix'] = [
            'qr_code' => $transactionData->qr_code ?? null,
            'qr_code_base64' => $transactionData->qr_code_base64 ?? null,
            'ticket_url' => $transactionData->ticket_url ?? null,
        ];
    }

    echo json_encode($response, JSON_UNESCAPED_UNICODE);
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode([
        'error' => 'Não foi possível processar o pagamento.',
        'details' => $e->getMessage()
    ], JSON_UNESCAPED_UNICODE);
}
