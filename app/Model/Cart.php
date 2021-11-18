<?php

namespace App\Model;

class Cart
{
    /**
     * @var array
     */
    protected $products = [];

    /**
     * @var float
     */
    protected $totalAmount = 0.00;

    public function addProduct(Product $product)
    {
        $this->products[$product->getCode()] = $product;
    }

    public function removeProduct(Product $product)
    {
        unset($this->products[$product->getCode()]);
    }

    public function getProducts(): array
    {
        return $this->products;
    }

    /**
     * @return float
     */
    public function getTotalAmount(): float
    {
        return $this->totalAmount;
    }

    /**
     * @param float $totalAmount
     *
     * @return self
     */
    public function setTotalAmount(float $totalAmount): self
    {
        $this->totalAmount = $totalAmount;

        return $this;
    }
}
