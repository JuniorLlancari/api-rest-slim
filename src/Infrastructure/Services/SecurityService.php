<?php
namespace Src\Infrastructure\Services;

use PDO;
use PDOException;
// use PDO;
 // use Kodoti\Database\DbProvider;
use Src\Infrastructure\Repositories\SecurityRepository;
use Src\Dominio\Entities\User;
use Src\Dominio\Entities\Security;

class SecurityService
{
    private $_securityRepository;

    public function __construct()
    {
        $this->_securityRepository = new SecurityRepository();

    }

    public function GetLoginByCredentials(string $user_name)
    {
        // $result = null;}

         try {
            $result=$this->_securityRepository->findByUserName($user_name);
            return $result;
        } catch (PDOException $ex) {

        }
    }

    public function GetSecurity(User $objUser)
    {
        $result = null;
             try {
                $security =new Security();
                $security->id=$objUser->id;
                $security->first_name=$objUser->first_name;
                $security->last_name=$objUser->last_name;
                $security->created_at=$objUser->created_at;
                $security->updated_at=$objUser->updated_at;
                return $security;
            } catch (PDOException $ex) {

        }
    }

}
