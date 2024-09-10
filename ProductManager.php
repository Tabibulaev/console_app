<?php

class ProductManager
{
    private $fileName;

    public function __construct($fileName)
    {
        $this->fileName = $fileName;
    }

    public function addProduct($name, $price)
    {
        $products = $this->readFile();
        $products[$name] = $price;
        $this->writeFile($products);
        echo "Product added: $name - $price\n";
    }

    public function updateProduct($name, $newPrice)
    {
        $products = $this->readFile();
        if (isset($products[$name])) {
            $products[$name] = $newPrice;
            $this->writeFile($products);
            echo "Product updated: $name - $newPrice\n";
        } else {
            echo "Product not found: $name\n";
        }
    }

    public function deleteProduct($name)
    {
        $products = $this->readFile();
        if (isset($products[$name])) {
            unset($products[$name]);
            $this->writeFile($products);
            echo "Product deleted: $name\n";
        } else {
            echo "Product not found: $name\n";
        }
    }

    public function calculateTotal()
    {
        $products = $this->readFile();
        $total = array_sum($products);
        echo "Total sum: $total\n";
    }

    private function readFile()
    {
        $products = [];
        if (file_exists($this->fileName)) {
            $lines = file($this->fileName, FILE_IGNORE_NEW_LINES);
            foreach ($lines as $line) {
                list($name, $price) = explode(' — ', $line);
                $products[$name] = (int)$price;
            }
        }
        return $products;
    }

    private function writeFile($data)
    {
        $lines = [];
        foreach ($data as $name => $price) {
            $lines[] = "$name — $price";
        }
        file_put_contents($this->fileName, implode("\n", $lines));
    }
}
