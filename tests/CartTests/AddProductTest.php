<?php

declare(strict_types=1);

namespace CartTests;

use App\Model\Product;
use App\Service\CartService;
use PHPUnit\Framework\TestCase;
use Throwable;

class AddProductTest extends TestCase
{
    public function testValidAddProductToCart()
    {
        try {
            $product = (new Product())
                ->setCode('test')
                ->setName('test name')
                ->setQuantity(2)
                ->setPrice(1.23)
                ->setPriceCurrency('USD');
            $cartService = new CartService();
            $cartService->processCartWithProduct($product);
            $this->assertTrue($cartService->getCartTotalAmount() > 0);
        } catch (Throwable $exception) {
            self::fail(sprintf('Exception: %s', $exception->getMessage()));
        }
    }
}
