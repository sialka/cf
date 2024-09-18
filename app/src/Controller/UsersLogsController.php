<?php

namespace App\Controller;

use Cake\Event\Event;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use Cake\Core\Exception\Exception;

class UsersLogsController extends AppController {
    
    public $paginate = [
        'limit' => 25,
        'order' => [
            'UsersLogs.id' => 'desc',
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
                    'model'        => 'UsersLogs',
                    'pkAlias'      => __('User_id'),
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
            'UsersLogs' => array(
                'id'       => array('name' => 'id', 'operation' => '', 'coalesce' => false, 'date' => false, 'alias' => __('ID'), 'ignore' => array('')),
                'nome'     => array('name' => 'nome', 'operation' => '', 'coalesce' => false, 'date' => false, 'alias' => __('Nome'), 'ignore' => array('')),
                'username' => array('name' => 'username', 'operation' => '', 'coalesce' => false, 'date' => false, 'alias' => __('Login'), 'ignore' => array('')),
                'email'    => array('name' => 'image', 'operation' => 'LIKE', 'coalesce' => false, 'date' => false, 'alias' => __('Email'), 'ignore' => array('')),
                '_all'     => array('name' => ['Users.nome', 'Users.username'], 'operations' => ['LIKE', 'LIKE'], 'coalesce' => false, 'date' => false, 'alias' => __('Pesquisa'), 'ignore' => array(''))
            )
        );

        if (isset($this->request->data) && is_array($this->request->data) && (sizeof($this->request->data) >= 1)) {
            $this->request->data['UsersLogs'] = $this->request->data;
        }

        $_conditions = $this->Conditions->filter('UsersLogs', $conversion, [], null, null);

        $logs = $this->paginate($this->UsersLogs->find('all')->contain(['Users'])->where($_conditions['conditions']));        

        //debug($logs);die();

        //$this->aevOptions();
        $this->set('logs', $logs);
        $this->set('_conditions',   $_conditions['stringFilter']);
    }

    public function aevOptions() {
        $aevOptions = $this->Users->aevOptions();

        $this->set('aevOptions', $aevOptions);
    }

    // Apenas Perfil Admin
    public function isAdmin(){
    
        $perfil = $this->request->session()->read('perfil');
        $isAdmin      = $perfil->cad_logs;        
        
        if(!$isAdmin){
            return $this->redirect(['controller' => 'Dashboard', 'action' => 'index']);
        }
        
    }

    public function savelog(){                

        $userslogsTable =  TableRegistry::get('UsersLogs');                              
        $userslogsTable->salvaLog($this->request->params);
        
    }

}
