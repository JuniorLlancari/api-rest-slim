<?php
namespace Src\Infrastructure\Repositories;
use Src\Infrastructure\Data\DbContext;
use Src\Dominio\Entities\User;

use \PDO;

class SecurityRepository //implements UserRepositoryInterface
{
    private $_db;
    public function __construct(){
        $this->_db=DbContext::get();
    }

    public function findByUserName(string $user_name):?User{

        $result=null;
        $stm = $this->_db->prepare('SELECT * FROM users us where us.user_name=:user_name');
        $stm->execute(['user_name' =>$user_name]);
        $data = $stm->fetchObject('\\Src\\Dominio\\Entities\\User');

        if ($data) {
            $result = $data;
        }
        return $result;

    }




}