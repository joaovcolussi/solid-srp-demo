<?php
declare(strict_types=1);

namespace App\Contracts;

use App\Domain\Product;

interface ProductRepository {
    
    public function save(Product $product): void;
    
    /** @return Product[] */
    public function findAll(): array;
}