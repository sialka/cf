<?php

namespace App\Controller;

use Cake\Event\Event;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use Cake\Core\Exception\Exception;
use Cake\I18n\Time;
use Cake\Mailer\Email;


/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController {
    
    public $paginate = [
        'limit' => 25,
        'order' => [
            'Users.nome' => 'asc',
        ]
    ];    

    public function initialize() {
        parent::initialize();

        $this->loadComponent('Paginator');
        $this->loadComponent('Conditions', [
            'prefixSession'      => 'ccb',
            'delimiter'          => '__',
            'pipe'               => '-',
            'char_case'          => 1,
            'tables_names'       => [],
            'try_resolve_fields' => true,
            'listenRequestClear' => [
                'index' => [
                    'param' => 'clear'
                ],
            ],
            'listenRequestPiped' => [
                'index' => [
                    'model'        => 'Users',
                    'pkAlias'      => __('Código'),
                    'blockPkPiped' => true,
                ]
            ]
        ]);
        

        $this->Auth->allow(['logout', 'login']);
    }
    
    public function beforeRender(Event $event) {        
        parent::beforeRender($event);
    }

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);

        if ($this->request->is('ajax') || (in_array('application/json', $this->request->accepts()))) {
           $this->Security->config('unlockedActions', ['index']);
        }

    }    

    public function index() {       
        
        $this->savelog();
      
        $this->isAdmin();        
        
        $conversion = array(
            'Users' => array(
                'id'       => array('name' => 'id', 'operation' => '', 'coalesce' => false, 'date' => false, 'alias' => __('ID'), 'ignore' => array('')),
                'nome'     => array('name' => 'nome', 'operation' => '', 'coalesce' => false, 'date' => false, 'alias' => __('Nome'), 'ignore' => array('')),
                'username' => array('name' => 'username', 'operation' => '', 'coalesce' => false, 'date' => false, 'alias' => __('Login'), 'ignore' => array('')),
                'email'    => array('name' => 'image', 'operation' => 'LIKE', 'coalesce' => false, 'date' => false, 'alias' => __('Email'), 'ignore' => array('')),
                '_all'     => array('name' => ['Users.nome', 'Users.username'], 'operations' => ['LIKE', 'LIKE'], 'coalesce' => false, 'date' => false, 'alias' => __('Pesquisa'), 'ignore' => array(''))
            )
        );

        if (isset($this->request->data) && is_array($this->request->data) && (sizeof($this->request->data) >= 1)) {
            $this->request->data['Users'] = $this->request->data;
        }

        $_conditions = $this->Conditions->filter('Users', $conversion, [], null, null);

        $usersf = $this->Users->find('all')->where(['id > 1']);        

        $users = $this->paginate($usersf->where($_conditions['conditions']));

        $perfil = $this->request->session()->read('perfil');      

        $this->aevOptions();
        $this->set('users', $users);
        $this->set('perfil', $perfil);
        $this->set('_conditions',   $_conditions['stringFilter']);
    }

    public function add($id = null){

        $this->savelog();
        
        $this->isAdmin();
        
        $user = $this->Users->newEntity();  

        if ($this->request->is('post')) {

            $data = $this->request->data;

            $new = $this->Users->patchEntity($user, $data);
            
            $senha = $this->Users->gerarSenha(8, false, true, true);
            
            $new->password = $senha;

            $save = $this->Users->save($new);

            if ($save) {               
                
                $this->Flash->success(__("O usuário foi gerado com sucesso. Senha de acesso <strong>{$senha}</strong>"));  
                
                $data = [
                    'user_id' => $save->id,
                    'data' => $data
                ];

                $this->salvarPerfil($data);

                $this->validarPerfilAdmin($save);


                // Envio do e-mail com a senha

                $this->EmailsUsers(
                    'reset', [
                        'to'       => $user->email,
                        'from'     => "suporte@smport.com.br",
                        'subject'  => __('Conselho Fiscal - Primeiro Acesso'),
                        'template' => 'senha',
                        'layout'   => 'default',
                        'format'   => 'html'
                    ], 
                    'default', [
                        'nome'     => $user->nome,
                        'username' => $user->username,
                        'password' => $senha                        
                    ]
                );

                // Fim

                
                return $this->redirect(['controller' => 'Users', 'action' => 'index']);                
                
            } else {

                $this->Flash->error(__('Erro ao mudar o perfil do usuário <strong>' .$new->nome.' </strong> !!!'));

                $error_list = "<p class='mt-2'>Não foi possivel criar a usuário <strong> {$new->nome}: </strong></p>";
                $error_list .= '<ul class="mt-3">';
                $erros = $new->errors();
                                
                if($erros){
                    foreach($erros as $key => $value){
                        $error_list .= "<li>".implode(' ', $value) . "</li>";
                    }
                }
                $error_list .= '</ul>';
                $this->Flash->error($error_list);
                
                return $this->redirect(['controller' => 'Users', 'action' => 'add']);
            }

        }        
        
        $perfil = $this->request->session()->read('perfil');              

        $this->aevOptions();
        $this->set('perfil', $perfil);
        $this->set('mode', 'add');
        $this->set('user', $user);
        $this->render("save");
    }

    public function edit($id = null){
        
        $this->savelog();       
        
        $user = $this->Users->get($id, [
            'contain' => ['Perfil']
        ]);

        //$id = $this->validacaoID($user);

        if(!$this->validacaoID($user))
        {
            $this->Flash->error(__('O seu perfil não tem autorização para editar esse usuário !!!'));
            return $this->redirect(['controller' => 'Users', 'action' => 'index']);
        }

        if ($this->request->is('post')) {

            $data = $this->request->data;
            //debug($data);die();
            
            if(!$this->Users->ValidaSenha($data)){
                $this->Flash->error(__('Não foi possivel alterar a senha do usuário <strong>' .$user->nome.'</strong>.'));
                return $this->redirect(['controller' => 'Users', 'action' => 'index']);
            }                        
            
            if(empty($data['password'])){
                unset($data['password']);
            }
            
            $new = $this->Users->patchEntity($user, $data); 
            
            $save = $this->Users->save($new);
            
            if ($save) {                

                $this->validarPerfilAdmin($save);
                
                $this->Flash->success(__('O usuário <strong>' .$new->nome.' </strong> foi alterado(a) com sucesso !!!'));       
                
                
                if(!empty($data['password'])){                
                    // Envio do e-mail com a senha
                    $this->EmailsUsers(
                        'reset', [
                            'to'       => $user->email,
                            'from'     => "suporte@smport.com.br",
                            'subject'  => __('Conselho Fiscal - Nova Senha'),
                            'template' => 'resete',
                            'layout'   => 'default',
                            'format'   => 'html'
                        ], 
                        'default', [
                            'nome'     => $user->nome,
                            'username' => $user->username,
                            'password' => $data['password']
                        ]
                    );

                    // Fim
                }
                
                return $this->redirect(['controller' => 'Users', 'action' => 'index']);
                
            } else {
                
                $this->Flash->error(__('Erro ao mudar o perfil do usuário <strong>' .$new->nome.' </strong> !!!'));

                $erros = $new->errors();
                if($erros){
                    foreach($erros as $key => $value){
                        $this->Flash->error(__(implode(' ', $value)));
                    }
                }
            }

        }

        $user_auth = $this->request->session()->read('Auth')['User'];                
        
        $perfil = $this->request->session()->read('perfil');        
        
        $this->aevOptions();
        $this->set('perfil', $perfil );
        $this->set('user_auth', $user_auth);
        $this->set('mode', 'edit');
        $this->set('user', $user);
        $this->render("save");
    }

    public function view($id = null){

        $this->savelog();

        $user = $this->Users->get($id, [
            'contain' => ['Perfil']
        ]);
        
        if(!$this->validacaoID($user))
        {
            $this->Flash->error(__('O seu perfil não tem autorização para editar esse usuário !!!'));
            return $this->redirect(['controller' => 'Users', 'action' => 'index']);
        }
                
        $user_auth = $this->Auth->user();        

        $perfil = $this->request->session()->read('perfil');        
        
        $this->aevOptions();
        $this->set('perfil', $perfil );
        $this->set('user_auth', $user_auth);
        $this->set('mode', 'view');
        $this->set('user', $user);
        $this->render("save");
    }

    public function delete($id = null){

        $this->savelog();

        $user = $this->Users->get($id);

        if($user){

            $resul = $this->Users->delete($user);

            if ($resul){
                $this->Flash->success(__('O usuário <strong>' .$user->nome.'</strong> foi removido(a) com sucesso !!!'));
            }else{
                $this->Flash->error(__('Não foi possivel remover o usuário ' .$user->name));
            }
        }

        return $this->redirect(['action' => 'index']);
    }

    public function login(){        

        if($this->request->is('post')){

            try {

                $user = $this->Auth->identify();

                if ($user) {                    
                    
                    $this->Auth->setUser($user);
                    
                    $perfilTable = TableRegistry::get('Perfil');        
                    $perfil      = $perfilTable->find()->contain(['Users'])->where(['user_id' => $user['id']])->first();                                          

                    $nome_completo = explode(" ", $user['nome']);
                    
                    $this->request->session()->write('logado', $nome_completo[0]);
                    $this->request->session()->write('perfil', $perfil);
                    
                    $this->carregarMesTrabalho();                    
                    
                    $this->savelog();

                    $update = $this->Users->get($user['id']);
                    $update['last_access'] = Time::now();                    
                    $this->Users->save($update);

                    return $this->redirect($this->Auth->redirectUrl());
                }

                $erro = __('Acesso não autorizado');
                
                $this->Flash->auth_error($erro);
                
            } catch (\PDOException $e) {
                
                echo 'Exceção capturada: ', $e->getMessage(), "\n";exit;                
                //$this->Flash->auth_error('A aplicação está desativada !!!');
            }


            return $this->redirect($this->referer());
        }

        $this->set('user', $this->Users->newEntity());
    }

    public function logout() {

        $this->savelog();
        
        $this->request->session()->destroy();
        return $this->redirect($this->Auth->logout());
    }

    public function perfil() {

        $this->savelog();
        
        $id = $this->Auth->user('id');               
        
        return $this->redirect(['controller' => 'Users', 'action' => 'edit', $id]);
        
    }

    public function aevOptions() 
    {
        $aevOptions = $this->Users->aevOptions();

        $this->set('aevOptions', $aevOptions);
    }

    // Apenas Perfil Admin
    public function isAdmin()
    {
        
        $perfil = $this->request->session()->read('perfil');
        $isAdmin      = $perfil->cad_users;        
        
        if(!$isAdmin){
            return $this->redirect(['controller' => 'Dashboard', 'action' => 'index']);
        }
        
    }
    
    public function validarPerfilAdmin($save)
    {        
     
        $res = $this->Users->validarPerfilAdmin($save);
            
        if(!$res){
            $this->Flash->error(__("Erro ao gerar o Perfil do usuário !"));
        }

    }

    public function salvarPerfil($data)
    {

        $res = $this->Users->salvarPerfil($data);
            
        if(!$res){
            $this->Flash->error(__("Erro ao gerar o Perfil do usuário !"));
        }        

    }

    // Somente perfil admin pode alterar admin
    // Filtrando Perfis: Admin x Comun
    public function validacaoID($user){

        $perfil = $this->request->session()->read('perfil');
        $isAdmin = $perfil->admin;             

        if($isAdmin){
            return true;
        }

        if($isAdmin != $user->Perfil->admin){            
            return false;       
        }
        
        return true;
    }

    public function savelog(){                

        $userslogsTable =  TableRegistry::get('UsersLogs');                              
        $userslogsTable->salvaLog($this->request->params);
        
    }

    private function EmailsUsers($tipo, array $options, $config, array $viewVars) {
        $urlImage     = 'http://openadm/img/';        

        $email               = new Email((isset($config)) ? $config : 'default');

        //debug($email);exit();

        $options['template'] = (isset($options['template'])) && (is_string($options['template'])) ? $options['template'] : 'default';
        $options['layout']   = (isset($options['layout'])) && (is_string($options['layout'])) ? $options['layout'] : 'default';
        $options['format']   = (isset($options['format'])) && (is_string($options['format'])) ? $options['format'] : 'both';

        /*
        $email->attachments([
            'logo.png' => [
                'file'      => WWW_ROOT . DS . 'img' . DS . 'perfil1.png',
                'mimetype'  => 'image/png',
                'contentId' => '1'
            ]
        ]);*/

        $email->template($options['template'], $options['layout']);
        $email->emailFormat($options['format']);
        $email->viewVars($viewVars + array('urlImage' => $urlImage));
        //$email->from($options['from']);
        $email->to($options['to']);
        $email->subject($options['subject']);


        //debug($email);exit();

        $email->send();
    }

}
