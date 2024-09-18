<?php
namespace App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;

class AnosTable extends Table
{

    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('anos');
        $this->setDisplayField('ano');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');        
        
    }

    public function validationDefault(Validator $validator)
    {

        return $validator;
    }

    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['ano'], 'O ano já está cadastrado'));        

        return $rules;
    }

    public function aevOptions(){

        $options = [            
            'status' => [
                1 => 'Ativo',
                0 => 'Inativo',
            ],
        ];

        return $options;
    }
        
}
