<?php
declare(strict_types=1);

namespace App\Infra;

use App\Contracts\ProductRepository;
use App\Domain\Product;

final class FileProductRepository implements ProductRepository {
    private string $filePath;

    public function __construct() {
        $this->filePath = __DIR__ . '/../../storage/products.txt';
        
        $dir = dirname($this->filePath);
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
        if (!file_exists($this->filePath)) {
            touch($this->filePath);
        }
    }
    
    public function save(Product $product): void {
        if ($product->getId() === 0) {
            $product->setId($this->calculateNextId());
        }

        $line = $product->toFileLine(); 
        file_put_contents($this->filePath, $line, FILE_APPEND | LOCK_EX);
    }
    
    /** @return Product[] */
    public function findAll(): array {
        $lines = @file($this->filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) ?: [];
        $products = [];
        
        foreach ($lines as $line) {
            $data = json_decode($line, true);
            
            if (is_array($data) && isset($data['id'], $data['name'], $data['price'])) {
                $products[] = new Product(
                    (int)$data['id'],
                    (string)$data['name'],
                    (float)$data['price']
                );
            }
        }
        return $products;
    }

    private function calculateNextId(): int {
        $allProducts = $this->findAll();
        
        if (empty($allProducts)) {
            return 1;
        }

        $ids = array_map(fn(Product $p) => $p->getId(), $allProducts);
        return max($ids) + 1;
    }
}