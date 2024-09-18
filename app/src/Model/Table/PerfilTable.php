<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class PerfilTable extends Table {

    public function initialize(array $config) {
        parent::initialize($config);

        $this->setTable('perfil');
        $this->setDisplayField('admin');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasOne('Users', [
            'className'         => 'Users',
            'bindingKey'        => 'user_id',
            'foreignKey'        => 'id',
            'propertyName'      => 'Users',
            
        ]); 
    }

}
