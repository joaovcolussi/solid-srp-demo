<?php
declare(strict_types=1);
session_start();

require __DIR__.'/../vendor/autoload.php';

use App\Infra\FileProductRepository;
use App\Domain\SimpleProductValidator;
use App\Application\ProductService;

$repository = new FileProductRepository();
$validator = new SimpleProductValidator();
$service = new ProductService($repository, $validator);

$message = $_SESSION['message'] ?? null;
unset($_SESSION['message']);
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $input = [
        'name' => $_POST['name'] ?? '',
        'price' => $_POST['price'] ?? ''
    ];

    try {
        $product = $service->create($input);
        
        $_SESSION['message'] = "Produto '{$product->getName()}' (ID: {$product->getId()}) cadastrado com sucesso!";
        header('Location: index.php');
        exit;
        
    } catch (\InvalidArgumentException $e) {
        http_response_code(422);
        $errors = explode('; ', $e->getMessage());
        
    } catch (\Throwable $e) {
        http_response_code(500);
        $errors[] = "Erro interno no servidor: " . $e->getMessage();
    }
}

?><!doctype html>
<html lang="pt-br">
<head> 
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Cadastro de Produtos (SRP)</title>
    </head>
<body>
    <div class="container">
        <h1>Cadastrar Produto</h1>

        <nav>
            <a href="./index.php">Cadastrar</a> | 
            <a href="./products.php">Listar Produtos</a>
        </nav>
        
        <div style="margin-top: 20px;">
            <?php if ($message): ?>
                <p style="color: green; font-weight: bold;"><?php echo htmlspecialchars($message); ?></p>
            <?php endif; ?>

            <?php if (!empty($errors)): ?>
                <p style="color: red; font-weight: bold;">Erro(s) de Validação:</p>
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li style="color: red;"><?php echo htmlspecialchars($error); ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>

        <form method="POST" action="index.php" style="margin-top: 20px;">
            <label for="name">Nome:</label><br>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>"><br><br>

            <label for="price">Preço:</label><br>
            <input type="text" id="price" name="price" value="<?php echo htmlspecialchars($_POST['price'] ?? ''); ?>"><br><br>

            <button type="submit">Cadastrar</button>
        </form>
    </div>
</body>
</html>