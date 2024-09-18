<?php
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

class AppController extends Controller
{
    protected $varForSerialize      = [];

    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Auth', [
            'loginRedirect' => [
                'controller'    => 'Dashboard',
                'action'        => 'index'
            ],
            'logoutRedirect' => [
                'controller'    => 'Users',
                'action'        => 'login',
            ],
            'unauthorizedRedirect' => [
                'prefix'        => false,
                'controller'    => 'Users',
                'action'        => 'login',
            ],
            'authError' => __('É necessario se logar.'),
            'flash' => [
                'element' => 'auth_error'
            ],

        ]);

        $this->loadComponent('Security');
        //$this->loadComponent('Csrf');                
        
    }

    public function beforeFilter(Event $event){
       $this->Security->config('blackHoleCallback', 'blackhole');
    }

    public function beforeRender(Event $event){

        if (!isset($this->viewVars['_notSerialize'])) {
            if (($this->request->is('ajax')) || (in_array($this->response->type(), ['application/json', 'application/xml']))) {
                if (sizeof($this->varForSerialize) <= 0) {
                    if (isset($this->_notSerialize) && is_array($this->_notSerialize)) {
                        $this->set('_serialize', array_diff(array_keys($this->viewVars), $this->_notSerialize));
                    } else {
                        $this->set('_serialize', array_keys($this->viewVars));
                    }
                } else {
                    $this->set('_serialize', $this->varForSerialize);
                }
            }
        }

        //debug($this->request->session()->read('Auth.User.id'));        

        if(!$this->request->session()->read('Auth.User.id')){
            $this->viewBuilder()->setLayout('login');
        }else{
            $this->viewBuilder()->setLayout('default');
        }

    }    

    public function blackhole($type, \Cake\Controller\Exception\SecurityException $exception) {
        throw $exception;
        if ($exception->getMessage() === 'Request is not SSL and the action is required to be secure') {
            // Reword the exception message with a translatable string.
            $exception->setMessage(__('Please access the requested page through HTTPS'));
        }

        // Re-throw the conditionally reworded exception.
        $this->Flash->error(__('Houve uma tentativa de burlar o preenchimento de algum campo. Processo cancelado'));
        return $this->redirect('/');
        // Alternatively, handle the error, e.g. set a flash message &
        // redirect to HTTPS version of the requested page.
    }
    
    public function getSessionMesAnoTrabalho() {

        $nc_mes = $this->request->session()->read('mes')['mes'];
        $nc_ano = $this->request->session()->read('mes')['ano'];

        return "{$nc_mes}-{$nc_ano}";
    }
    
    private function getMesPorExtenso(){
        $nc_mes = $this->request->session()->read('mes')['mes'];
        $nc_ano = $this->request->session()->read('mes')['ano'];        

        switch ($nc_mes) {
            case '01':
                $mes = "Janeiro";
                break;
            case '02':
                $mes = "Fevereiro";
                break;
            case '03':
                $mes = "Março";
                break;
            case '04':
                $mes = "Abril";
                break;
            case '05':
                $mes = "Maio";
                break;
            case '06':
                $mes = "Junho";
                break;
            case '07':
                $mes = "Julho";
                break;
            case '08':
                $mes = "Agosto";
                break;
            case '09':
                $mes = "Setembro";
                break;
            case '10':
                $mes = "Outubro";
                break;
            case '11':
                $mes = "Novembro";
                break;
            case '12':
                $mes = "Dezembro";
                break;
            default:
                $mes = null;                
        }

        if ($nc_mes == null && $nc_ano == null) {
            return 'Não há mês de Trabalho Cadastrado';
        }        
        
        return "{$mes}/{$nc_ano}";        
    }
    
    public function carregarMesTrabalho(){
        
        $ncsTable       = TableRegistry::get('Ncs');
        $planilhasTable = TableRegistry::get('Planilhas');

        $ncsTable->atualizaMesTrabalho();

        $mes_trabalho = $this->getSessionMesAnoTrabalho();
        $saldos       = $planilhasTable->getSaldos($mes_trabalho);
        $title        = $this->getMesPorExtenso();

        $this->set('title',  $title);
        $this->set('saldos', $saldos);
    }

}
