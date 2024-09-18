<?php
namespace App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;
use Cake\Network\Session;
//use Cake\Http\Session;

class UsersLogsTable extends Table
{

    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('users_logs');
        $this->setPrimaryKey('id');
        $this->setDisplayField('controller');
        
        $this->addBehavior('Timestamp');        

        $this->hasOne('Users', [
            'className'         => 'Users',
            'bindingKey'        => 'user_id',
            'foreignKey'        => 'id',
            'propertyName'      => 'Users',
            
        ]); 
        
    }

    public function validationDefault(Validator $validator)
    {

        return $validator;
    }

    public function aevOptions(){

        $options = [
        ];

        return $options;
    }

    public function salvaLog($request){                             

        $session   = new Session();  
        $perfil = $session->read('perfil');                        
        $id = $perfil['user_id'];

        $pass = "";

        if (count($request['pass']) != 0) {
            $pass = "/" . $request['pass'][0];
        }

        $data = [
            'user_id' => $id,
            'controller'=> $request['controller'] . "/" . $request['action'] . $pass
        ];                

        $log = $this->newEntity();       

        $new = $this->patchEntity($log, $data);                

        $save = $this->save($new);

    }
        
}
