<?php
namespace App\Model\Entity;

use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;

class Localidade extends Entity
{
    protected $_accessible = [
        '*' => true,
    ];

    protected function _setNome($nome){
        $arr   = explode(" ", $nome);
        $final = "";

        foreach($arr as $parte){

            if(in_array(mb_strtolower($parte), ['de', 'da', 'das', 'do', 'dos']) ){
                $final .= mb_strtolower($parte). " ";
                continue;
            }

            if(in_array(mb_strtolower($parte), ['i', 'ii', 'iii', 'iv', 'vi', 'vii', 'viii', 'ix', 'xi', 'xii', 'xiii']) ){
                $final .= mb_strtoupper($parte). " ";
                continue;
            }

            $final .= ucwords(mb_strtolower($parte)) . " ";


        }

        return trim($final);
    }
}
