<?php
declare(strict_types=1);

namespace App\Contracts;

use InvalidArgumentException;

interface ProductValidator {
    
    /** @throws InvalidArgumentException */
    public function validate(array $input): void;
}