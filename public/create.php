<?php
declare(strict_types=1);

ini_set('display_errors', 1);
error_reporting(E_ALL);

require __DIR__ . '/../vendor/autoload.php';

use App\Infra\FileProductRepository;
use App\Domain\SimpleProductValidator;
use App\Application\ProductService;
use App\Domain\Product;
use InvalidArgumentException;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    header('Allow: POST');
    exit;
}

$repository = new FileProductRepository(); 
$validator = new SimpleProductValidator();
$service = new ProductService(repository: $repository, validator: $validator);

$input = [
    'name' => $_POST['name'] ?? '',
    'price' => $_POST['price'] ?? ''
];

header('Content-Type: application/json; charset=utf-8');

try {
    /** @var Product $product */
    $product = $service->create($input);

    http_response_code(201);
    $response = [
        'status' => 'success',
        'message' => 'Produto criado com sucesso.',
        'data' => [
            'id' => $product->getId(),
            'name' => $product->getName(),
            'price' => $product->getPrice(),
        ]
    ];

} catch (InvalidArgumentException $e) {
    http_response_code(422);
    $response = [
        'status' => 'error',
        'message' => 'Erro de Validação.',
        'details' => $e->getMessage(),
    ];

} catch (\Exception $e) {
    http_response_code(500);
    $response = [
        'status' => 'error',
        'message' => 'Erro interno do servidor.',
        'details' => $e->getMessage(),
    ];
}

echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);