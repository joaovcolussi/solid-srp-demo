<?php
declare(strict_types=1);

require __DIR__.'/../vendor/autoload.php';

use App\Infra\FileProductRepository;
use App\Domain\SimpleProductValidator;
use App\Application\ProductService;

$repository = new FileProductRepository();
$validator = new SimpleProductValidator();
$service = new ProductService($repository, $validator);

$products = $service->listAll();

?><!doctype html>
<html lang="pt-br">
<head> 
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Listagem de Produtos (SRP)</title>
    </head>
<body>
    <div class="container">
        <h1>Listagem de Produtos</h1>
        
        <nav>
            <a href="./index.php">Cadastrar</a> | 
            <a href="./products.php">Listar Produtos</a>
        </nav>

        <div style="margin-top: 20px;">
            <?php if(empty($products)):?>
                <p style="color: #666;">Nenhum produto cadastrado.</p>
            <?php else:?>
                <table border="1" cellpadding="10" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Preço (R$)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        foreach($products as $p):
                        ?>
                            <tr>
                                <td><?php echo (int)$p->getId();?></td>
                                <td><?php echo htmlspecialchars($p->getName(), ENT_QUOTES, 'UTF-8');?></td>
                                <td><?php echo number_format($p->getPrice(), 2, ',', '.');?></td>
                            </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            <?php endif;?>
        </div>
    </div>
</body>
</html>