<?php

namespace App\Controller;

use App\Constant\CurrencyConst;
use App\Exception\ValidationException;
use App\Model\Product;
use App\Service\CartService;

/**
 * ProcessController
 */
class ProcessController
{
    const INPUT_FILE = __DIR__.'/../../public/inputData.txt';
    const SEPARATOR = ';';

    /**
     * @var CartService
     */
    private $cartService;


    public function __construct() {
        $this->cartService = new CartService();
    }

    public function processFile()
    {
        $this->outputMessage('====================================================================');
        $file = fopen(self::INPUT_FILE, 'rb');
        if ($file) {
            $lineNumber = 0;
            while (!feof($file)) {
                $line = fgets($file);
                $lineNumber++;
                $this->processLine(preg_replace('/\r?\n$/', '', $line), $lineNumber);
            }
            fclose($file);
        }
        $this->outputMessage('====================================================================');
    }

    /**
     * @return void
     */
    private function processLine(string $line, int $lineNumber)
    {
        try {
            $columns = explode(self::SEPARATOR, $line);
            $this->validateColumns($columns);

            $product = (new Product())
                ->setCode($columns[0])
                ->setName($columns[1])
                ->setQuantity((int) $columns[2])
                ->setPrice((float) $columns[3])
                ->setPriceCurrency($columns[4]);

            $this->cartService->processCartWithProduct($product);

            $this->outputMessage(sprintf(
                'Products count: %s. Total amount: %s %s',
                $this->cartService->getCartProductCount(),
                $this->cartService->getCartTotalAmount(),
                CurrencyConst::DEFAULT_CURRENCY
            ));
        } catch (ValidationException $exception) {
            $this->outputMessage(sprintf('--- Error in line %s (%s): %s', $lineNumber, $exception->getMessage(), $line));

            return;
        }
    }

    /**
     * @throws ValidationException
     */
    private function validateColumns(array $columns)
    {
        if (count($columns) !== 5) {
            throw new ValidationException('error');
        }
        // if quantity is greater than 0, price must be greate than zero
        if ($columns[2] > 0 && empty($columns[3])) {
            throw new ValidationException('price must be greater than zero');
        }
        // if quantity is greater than 0, validate currency code
        if ($columns[2] > 0 && !in_array($columns[4], CurrencyConst::VALID_CURRENCIES, true)) {
            throw new ValidationException('currency code not valid');
        }
    }

    private function outputMessage(string $message)
    {
        echo $message.PHP_EOL;
    }
}
