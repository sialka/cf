<?php
namespace App\Model\Entity;

use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;

class User extends Entity
{
    protected $_accessible = [
        'nome' => true,
        'email' => true,
        'status' => true,
        'username' => true,
        'password' => true,
        'status'  => true,
        'created' => true,
        'modified' => true,
    ];

    protected $_hidden = [
        'password',
    ];

    protected function _setPassword($password){
        if (strlen($password) > 0) {
            $hasher = new DefaultPasswordHasher();

            return $hasher->hash($password);
        }
    }

    protected function _setUsername($username){
        return mb_strtolower($username);
    }

    protected function _setNome($nome){
        $arr   = explode(" ", $nome);
        $final = "";

        foreach($arr as $parte){

            if(in_array(mb_strtolower($parte), ['de', 'da', 'das', 'do', 'dos']) ){
                $final .= mb_strtolower($parte). " ";
            }else{
                $final .= ucwords(mb_strtolower($parte)) . " ";
            }

        }

        return trim($final);
    }

    protected function _setEmail($email){
        return mb_strtolower($email);
    }

}
