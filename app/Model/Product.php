<?php

namespace App\Model;

/**
 * Class Product
 */
class Product
{
    /**
     * @var string
     */
    private $code;

    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $quantity;

    /**
     * @var float|null
     */
    private $price;

    /**
     * @var string|null
     */
    private $priceCurrency;

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $code
     *
     * @return self
     */
    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     *
     * @return self
     */
    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float|null $price
     *
     * @return self
     */
    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPriceCurrency(): string
    {
        return $this->priceCurrency;
    }

    /**
     * @param string|null $priceCurrency
     *
     * @return self
     */
    public function setPriceCurrency(string $priceCurrency): self
    {
        $this->priceCurrency = $priceCurrency;

        return $this;
    }
}
