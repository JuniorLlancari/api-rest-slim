<?php

namespace Src\Controllers\Login;

use PDOException;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
 
use Src\Dominio\Entities\Login;
use Src\Dominio\Entities\User;

use Src\Dominio\Entities\Security;
use Src\Infrastructure\Services\UserService;
use Src\Infrastructure\Services\SecurityService;

use Ramsey\Uuid\Uuid;
use Psr\Http\Message\UploadedFileInterface as FileInterface;
use Psr\Http\Message\UploadedFile;
use Src\Controllers\Login\Lib\Auth;
use Firebase\JWT\JWT;
use Src\Controllers\BaseController;


date_default_timezone_set("America/Lima");


class LoginController extends BaseController
{
     

    public function Login(Request $request, Response $response, array $args)
    {

 
        $body= $request->getParsedBody();
        $login=new Login;
        $login->user_name=$body['user_name'];
        $login->password=$body['password'];
        $isValid = $this->IsValidUser($login);
        return $this->showOne($response,['encode'=>$isValid]);

     }

    public function IsValidUser(Login $login)
    {
        $data=$this->_container->security_service->GetLoginByCredentials($login->user_name);
        
        if($data){
            if (password_verify($login->password, $data->password)) {
                $valor= $this->_container->security_service->GetSecurity($data);
                return Auth::SignIn($valor);
            }else{
                throw new Exception("Exception message");            
            }
        }
        return false;

    }
   
 




}