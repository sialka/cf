<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class LocalidadesTable extends Table
{
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('localidades');
        $this->setDisplayField('nome');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

    }


    public function validationDefault(Validator $validator)
    {
        $validator->notEmpty('codigo', __('Informe o código da Localidade'));
        $validator->notEmpty('nome', __('Informe o nome da Localidade'));

        return $validator;
    }

    public function buildRules(RulesChecker $rules)
    {

        $rules->add($rules->isUnique(['codigo'], 'O código da localidade informado já está em uso'));
        $rules->add($rules->isUnique(['nome'], 'O nome da localidade informado já está em uso'));

        return $rules;
    }

    public function aevOptions(){

        $aevOptions = [
            'setores' => [
                0 => 'Administração',
                1 => '1 - Centro',
                2 => '2 - Aeroporto',
                3 => '3 - Bonsucesso',
                4 => '4 - Pimentas',
            ],
            'status' => [
                1 => 'Ativo',
                0 => 'Inativo',
            ],
        ];

        return $aevOptions;
    }
}
