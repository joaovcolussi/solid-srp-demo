<?php
declare(strict_types=1);

namespace App\Application;

use App\Contracts\ProductRepository;
use App\Contracts\ProductValidator;
use App\Domain\Product;

final class ProductService {
    public function __construct(
        private ProductRepository $repository, 
        private ProductValidator $validator
    ) {}

    public function create(array $input): Product {
        $this->validator->validate($input);
        
        $name = trim((string)$input['name']); 
        $price = (float)$input['price'];

        $product = new Product(
            0,
            $name,
            round($price, 2)
        );
        
        $this->repository->save($product);

        return $product;
    }

    /** @return Product[] */
    public function listAll(): array {
        return $this->repository->findAll();
    }
}