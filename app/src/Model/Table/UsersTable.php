<?php
namespace App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;

class UsersTable extends Table
{

    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('users');
        $this->setDisplayField('nome');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        
        $this->hasOne('Perfil', [
            'className'         => 'Perfil',
            'bindingKey'        => 'id',
            'foreignKey'        => 'user_id',
            'propertyName'      => 'Perfil',
            
        ]);          
        
    }

    public function validationDefault(Validator $validator)
    {

        return $validator;
    }

    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['email'], 'E-mail já está em uso'));
        $rules->add($rules->isUnique(['username'], 'Usuário já está em uso'));

        return $rules;
    }

    public function aevOptions(){

        $options = [
            'theme' => [
                0 => 'Padrão'
            ],
            'status' => [
                1 => 'Ativo',
                0 => 'Inativo',
            ],
        ];

        return $options;
    }
    
    public function ValidaSenha($data){                
        
        if(empty($data['password']) && empty($data['confirma'])){
            return true;
        }
        
        if($data['password'] === $data['confirma']){
          return true;
        }
        
        return false;        
        
    }
    
    
    public function gerarSenha($tamanho = 8, $maiusculas = false, $numeros = true, $simbolos = true) {
        
        $lmin       = 'abcdefghijklmnopqrstuvwxyz';
        $lmai       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $num        = '1234567890';
        $simb       = '!@#$%*-';
        $retorno    = '';
        $caracteres = '';

        $caracteres .= $lmin;
        if ($maiusculas)
            $caracteres .= $lmai;
        if ($numeros)
            $caracteres .= $num;
        if ($simbolos)
            $caracteres .= $simb;

        $len = strlen($caracteres);
        
        for ($n = 1; $n <= $tamanho; $n++) {
            $rand    = mt_rand(1, $len);
            $retorno .= $caracteres[$rand - 1];
        }
        
        return $retorno;
    }
    
    public function deletar_salvarPerfil($id, $data){
        
        $perfilTable = TableRegistry::get('Perfil');        
        $perfil      = $perfilTable->find()->where(['user_id' => $id])->first();        
        $upSenha     = 0;
        
        // Verificando senhas
        if(!empty($data['password'])){
            $upSenha++;
        }
        if(!empty($data['confirma'])){
            $upSenha++;
        }
        
        if($upSenha == 1){
            debug('stop');exit;
            return false;
        }
        
        if($perfil){
            
            $save                  = $perfil;
                    
        }else{

            $save                  = $perfilTable->newEntity();
            $save->user_id         = $id;

        }
        
        if(isset($data['Perfil'])) {
        
            $save->admin           = $data['Perfil']['admin']; 
            $save->cad_igrejas     = $data['Perfil']['cad_igrejas']; 
            $save->cad_mestrabalho = $data['Perfil']['cad_mestrabalho']; 
            $save->cad_planilhas   = $data['Perfil']['cad_planilhas']; 
            $save->cad_planilhas   = $data['Perfil']['imp_planilhas']; 
            $save->cad_planilhas   = $data['Perfil']['exp_planilhas']; 

            if($data['Perfil']['admin'] == 1){
                $save->cad_igrejas     = 1; 
                $save->cad_mestrabalho = 1; 
                $save->cad_planilhas   = 1;             
                $save->cad_logs        = 1;
                $save->cad_anos        = 1;
                $save->cad_users       = 1;
            }

            if($perfilTable->save($save)){
                return true;
            }

            return false;
        
        }
        
        return true;
    }

    public function salvarPerfil($data)
    {
    
        $perfilTable =  TableRegistry::get('Perfil');     
        $perfil =  $perfilTable->newEntity();

        $new = $perfilTable->patchEntity($perfil, $data['data']);
        $new->user_id = $data['user_id'];       

        $save = $perfilTable->save($new);       

        return $save ? true : false;

    }
    
    public function validarPerfilAdmin($save)
    {        

        $user = $this->get($save->id, [
            'contain' => ['Perfil']
        ]);

        //debug($user);die();

        $perfil = $user->Perfil;
        //debug($user->Perfil);die();

        $id = $user->Perfil->id;
        $user_id = $user->Perfil->user_id;

        unset($perfil['id']);
        unset($perfil['user_id']);
        unset($perfil['admin']);
        unset($perfil['created']);
        unset($perfil['modified']);

        $arr = json_decode($perfil);

        $nivel = 0;
        $admin = 0;

        foreach($arr as $key => $value){
            $admin += 1;            
            $nivel += intval($value);
        }

        $updateUser = json_decode(json_encode($user), true);        
        
        $updateUser['Perfil']['user_id'] = $user_id;
        $updateUser['Perfil']['id'] = $id;
        $updateUser['Perfil']['admin'] = "0";        

        if($nivel == $admin){
            $updateUser['Perfil']['admin'] = "1";
        }

        $new = $this->patchEntity($user, $updateUser); 
        $save = $this->save($new);

        return $save ? true: false;

    }
        
}
