<?php
namespace App\Domain;

class Product
{
    private int $id;
    private string $name;
    private float $price;

    public function __construct(int $id, string $name, float $price)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }
    
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function toFileLine(): string
    {
        return json_encode([
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price
        ]) . PHP_EOL;
    }
}