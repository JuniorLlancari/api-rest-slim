<?php

declare(strict_types=1);
 
use Slim\App;
use Src\Controllers\User;
use Src\Controllers\ProductController;
use Src\Controllers\OrderController;
use Src\Controllers\Login;
use Src\Dominio\Entities\User as EnUser;
use Src\Infrastructure\Services\UserService;
use Src\Controllers\Login\Lib\Middleware;;


$app->group('/api', function ()  {
   
    $this->GROUP('/v1', function () {
        
        $this->POST('/login', Login\LoginController::class . ':Login');


        $this->GROUP('/user', function () {
            $this->GET('',  User\UserController::class . ':UserGetController');
            $this->GET('/{id}',User\UserController::class . ':UserGetByIdController');
            $this->POST('', User\UserController::class . ':UserInsertController');
            $this->PUT('/{id}', User\UserController::class . ':UserUpdateController');
            $this->DELETE('/{id}',User\UserController::class . ':UserDeleteController');
        });//->add(new Middleware());

        $this->GROUP('/product', function () {
            $this->GET('', ProductController::class . ':ProductGetController');
            $this->GET('/{id}',ProductController::class . ':ProductGetByIdController');
            $this->POST('', ProductController::class . ':ProductInsertController');
            $this->PUT('/{id}', ProductController::class . ':ProductUpdateController');
            $this->DELETE('/{id}',ProductController::class . ':ProductDeleteController');
        });

        $this->GROUP('/order', function () {
            $this->GET('', OrderController::class . ':OrderGetController');
            $this->GET('/{id}',OrderController::class . ':OrderGetByIdController');
            $this->POST('', OrderController::class . ':OrderInsertController');
            $this->PUT('/{id}', OrderController::class . ':OrderUpdateController');
            $this->DELETE('/{id}',OrderController::class . ':OrderDeleteController');
        });
    });

    $this->GROUP('/v2', function () {


        $this->GROUP('/test', function () {
            $this->GET('',  ProductController::class . ':testController');
        });
    });

    $this->GET('/prueba',function($request,$response) //use($objUser)
    {
        return $this->get('user_repository');
    });

});