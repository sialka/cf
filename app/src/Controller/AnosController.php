<?php

namespace App\Controller;

use Cake\Event\Event;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use Cake\Core\Exception\Exception;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class AnosController extends AppController {
    
    public $paginate = [
        'limit' => 25,
        'order' => [
            'Anos.ano' => 'desc',
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
                'ano'     => array('name' => 'ano', 'operation' => '', 'coalesce' => false, 'date' => false, 'alias' => __('Ano'), 'ignore' => array('')),
                '_all'     => array('name' => ['Anos.id', 'Anos.ano'], 'operations' => ['LIKE', 'LIKE'], 'coalesce' => false, 'date' => false, 'alias' => __('Pesquisa'), 'ignore' => array(''))
            )
        );

        if (isset($this->request->data) && is_array($this->request->data) && (sizeof($this->request->data) >= 1)) {
            $this->request->data['Anos'] = $this->request->data;
        }

        $_conditions = $this->Conditions->filter('Users', $conversion, [], null, null);        

        $anos = $this->paginate($this->Anos->find('all')->where($_conditions['conditions']));

        $this->aevOptions();
        $this->set('anos', $anos);
        $this->set('_conditions',   $_conditions['stringFilter']);
    }

    public function add($id = null){

        $this->savelog();
        
        $this->isAdmin();
        
        $ano = $this->Anos->newEntity();                             
        

        if ($this->request->is('post')) {

            $data = $this->request->data;

            $new = $this->Anos->patchEntity($ano, $data);

            if ($this->Anos->save($new)) {                
                $this->Flash->success(__("O ano <strong>" . $new->ano . "</strong> foi incluído com sucesso."));
            }else{
                $this->Flash->error(__("Não foi possivel incluir o ano " . $new->ano . " !!! "));                    
            }
                
            return $this->redirect(['controller' => 'Anos', 'action' => 'index']);                            

        }                
        
        $this->aevOptions();        
        $this->set('mode', 'add');
        $this->set('ano', $ano);
        $this->render("save");
    }

    public function edit($id = null){
        
        $this->savelog();        
        
        $ano = $this->Anos->get($id);

        if ($this->request->is('post')) {

            $data = $this->request->data;
            
            $new = $this->Anos->patchEntity($ano, $data);                                    
            
            if ($this->Anos->save($new)) {                
                
                $this->Flash->success(__('O ano <strong>' .$new->ano.' </strong> foi alterado(a) com sucesso !!!'));                    
                
                return $this->redirect(['controller' => 'Anos', 'action' => 'index']);
                
            } else {

                $this->Flash->error(__('Erro ao mudar o ano <strong>' .$new->ano.' </strong> !!!'));                    

                $erros = $new->errors();
                if($erros){
                    foreach($erros as $key => $value){
                        $this->Flash->error(__(implode(' ', $value)));
                    }
                }
            }

        }
        
        $this->aevOptions();               
        $this->set('mode', 'edit');
        $this->set('ano', $ano);
        $this->render("save");
    }

    public function view($id = null){

        $this->savelog();
        
        $ano = $this->Anos->get($id);        
        
        $this->aevOptions();
        $this->set('mode', 'view');
        $this->set('ano', $ano);
        $this->render("save");
    }

    public function delete($id = null){

        $this->savelog();

        $ano = $this->Anos->get($id);

        if ($this->Anos->delete($ano)){
            $this->Flash->success(__('O ano <strong>' .$ano->ano.'</strong> foi removido(a) com sucesso !!!'));
        }else{
            $this->Flash->error(__('Não foi possivel remover o ano ' .$ano->ano));
        }
        

        return $this->redirect(['action' => 'index']);
    }

    public function aevOptions() {
        $aevOptions = $this->Anos->aevOptions();

        $this->set('aevOptions', $aevOptions);
    }

    // Apenas Perfil Admin
    public function isAdmin(){
        
        $perfil = $this->request->session()->read('perfil');
        $isAdmin      = $perfil->cad_anos;        
        
        if(!$isAdmin){
            return $this->redirect(['controller' => 'Dashboard', 'action' => 'index']);
        }
        
    }  

    public function savelog(){                

        $userslogsTable =  TableRegistry::get('UsersLogs');                              
        $userslogsTable->salvaLog($this->request->params);
        
    }

}
