<?php

namespace App\Service;

use App\Constant\CurrencyConst;
use App\Model\Cart;
use App\Model\Product;

/**
 * Class CartService
 */
class CartService
{
    private $cart;

    public function __construct()
    {
        $this->cart = new Cart();
    }

    public function processCartWithProduct(Product $product)
    {
        if ($product->getQuantity() === 0) {
            return;
        }
        if ($product->getQuantity() <= -1) {
            $this->cart->removeProduct($product);
        } else {
            $this->cart->addProduct($product);
        }
        $this->calculateTotalAmount();
    }

    public function calculateTotalAmount()
    {
        $totalAmount = 0.00;
        /** @var Product $product */
        foreach ($this->cart->getProducts() as $product) {
            $totalAmount += $this->getConvertedPrice($product);
        }

        $this->cart->setTotalAmount($totalAmount);
    }

    public function getCartProductCount(): int
    {
        return count($this->cart->getProducts());
    }

    public function getCartTotalAmount(): float
    {
        return number_format($this->cart->getTotalAmount(), 2);
    }

    private function getConvertedPrice(Product $product): float
    {
        if ($product->getPriceCurrency() === CurrencyConst::DEFAULT_CURRENCY) {
            return $product->getPrice();
        }

        return $product->getPrice() / CurrencyConst::CURRENCY_RATES[$product->getPriceCurrency()];
    }
}
