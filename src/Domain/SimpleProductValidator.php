<?php
declare(strict_types=1);

namespace App\Domain;

use App\Contracts\ProductValidator;
use InvalidArgumentException;

final class SimpleProductValidator implements ProductValidator {
    public function validate(array $input): void {
        $errors = [];
        $name = isset($input['name']) ? trim((string)$input['name']) : '';

        if ($name === '') {
            $errors[] = 'Nome é obrigatório.';
        } elseif (mb_strlen($name) < 2 || mb_strlen($name) > 100) {
            $errors[] = 'Nome deve ter entre 2 e 100 caracteres.';
        }

        if (!isset($input['price']) || $input['price'] === '') {
            $errors[] = 'Preço é obrigatório.';
        } elseif (!is_numeric($input['price'])) {
            $errors[] = 'Preço deve ser numérico.';
        } elseif ((float)$input['price'] < 0) {
            $errors[] = 'Preço não pode ser negativo.';
        }
        
        if (!empty($errors)) {
            throw new InvalidArgumentException(implode('; ', $errors));
        }
    }
}