<?php

declare(strict_types=1);


use Psr\Container\ContainerInterface;
use Src\Infrastructure\Services\OrderService;
use Src\Infrastructure\Services\ProductService;
use Src\Infrastructure\Services\UserService;
use Src\Infrastructure\Services\SecurityService;


$container['user_service'] = new UserService;
$container['product_service'] = new ProductService;
$container['security_service'] = new SecurityService;
$container['order_service'] = new OrderService;

