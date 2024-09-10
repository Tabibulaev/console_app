<?php

require_once 'ProductManager.php';

if ($argc < 3) {
    echo "Usage: php script.php <filename> <action> [params...]\n";
    exit(1);
}

$fileName = $argv[1];
$action = $argv[2];

$productManager = new ProductManager($fileName);

switch ($action) {
    case 'add':
        $name = $argv[3];
        $price = $argv[4];
        $productManager->addProduct($name, $price);
        break;

    case 'update':
        $name = $argv[3];
        $newPrice = $argv[4];
        $productManager->updateProduct($name, $newPrice);
        break;

    case 'delete':
        $name = $argv[3];
        $productManager->deleteProduct($name);
        break;

    case 'total':
        $productManager->calculateTotal();
        break;

    default:
        echo "Unknown action: $action\n";
        break;
}
