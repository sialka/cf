<?php

namespace App\Controller;

use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use Cake\Controller\Controller;
use Cake\Event\Event;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class DashboardController extends AppController {

    public function initialize() {
        parent::initialize();

        $this->loadComponent('Paginator');
    }

    public function index() {

        $this->savelog();

        $this->carregarMesTrabalho();
    }

    public function savelog(){
        $userslogsTable =  TableRegistry::get('UsersLogs');                              
        $userslogsTable->salvaLog($this->request->params);
    }

    public function resumo($setor){
        
        $this->savelog();

        $title = array(            
            'setor0' => "Administração",
            'setor1' => "Setor 1 - Centro",
            'setor2' => "Setor 2 - Aeroporto",
            'setor3' => "Setor 3 - Bonsucesso",
            'setor4' => "Setor 4 - Pimentas",            
        );

        if(!array_key_exists($setor, $title)){
            return $this->redirect(['controller' => 'Dashboard', 'action' => 'index']);
        }

        $setores = array(
            'setor0' => 0,
            'setor1' => 1,
            'setor2' => 2,
            'setor3' => 3,
            'setor4' => 4,            
        );        
        
        $planilhasTable = TableRegistry::get('Planilhas');      
        
        $mes_trabalho = $this->getSessionMesAnoTrabalho();
        
        $_conditions = [];
        $_conditions += ['Planilhas.mes_trabalho' => $mes_trabalho];        
        $_conditions += ['Planilhas.status' => true];   
        $_conditions += ["Localidades.setor" => $setores[$setor]];

        $lancamentos = $planilhasTable->find('all')->contain(['Localidades'])->where($_conditions)->toArray();       
        
        $localidades = [];

        $total = 0;
        $pagamentos = 0;        
        $valor = 0;
        
        foreach ($lancamentos as $lancamento) {

            $igreja = $lancamento['Localidades']['nome'];
            $valor = $lancamento->valor;

            $total += $valor;
            $pagamentos += 1;
            $localidade_id = $lancamento->localidade_id;
            
            if (!array_key_exists($igreja, $localidades)) {                
                $localidades += [$igreja => ['gastos' => $valor, 'pagtos' => 1, 'localidade_id' => $localidade_id, 'mes' => $mes_trabalho]];
            }else{                
                $valor = $localidades[$igreja]['gastos'] + $valor;                
                $pgto = $localidades[$igreja]['pagtos'] + 1;                
                $localidades[$igreja] = ['gastos' => $valor, 'pagtos' => $pgto, 'localidade_id' => $localidade_id, 'mes' => $mes_trabalho];                                
            }            

        }                        

        $this->set('title', $title[$setor]);
        $this->set('localidades', $this->sortByField($localidades, 'gastos'));
        $this->set('total', $total);
        $this->set('pagamentos', $pagamentos);
    }

    public function detalhe($mes, $localidade_id){        

        # Validacao mes de trabalho
        $mestrabalho = $this->request->session()->read('mes');  
        if($mestrabalho->mes."-".$mestrabalho->ano != $mes){
            return $this->redirect(['controller' => 'Dashboard', 'action' => 'index']);
        }

        $this->savelog();

        $planilhasTable = TableRegistry::get('Planilhas');      
        
        $_conditions = [];
        $_conditions += ['Planilhas.mes_trabalho' => $mes];
        $_conditions += ['Planilhas.status' => true];   
        $_conditions += ["Planilhas.localidade_id" => $localidade_id];

        $lancamentos = $planilhasTable->find('all')->contain(['Localidades'])->where($_conditions)->order(['Planilhas.dt_vencimento' => 'asc'])->toArray();  

        # Validacao de localidade_id
        if(count($lancamentos) == 0){
            return $this->redirect(['controller' => 'Dashboard', 'action' => 'index']);
        }

        $total = 0;
        foreach($lancamentos as $lancamento){
            $total += $lancamento->valor;
        }

        try {
            $title = $lancamentos[0]->Localidades->codigo . ' - ' . $lancamentos[0]->Localidades->nome;
        } catch (\Exception $e) {
            $title = "00-0000 - Localidade";
        } 

        $this->set('title', $title);
        $this->set('total', $total);
        $this->set('lancamentos', $lancamentos);
    }
   
    private function sortByField($multArray,$sortField,$desc=false){
            
        $tmpKey='';
        $ResArray=array();

        $maIndex=array_keys($multArray);
        $maSize=count($multArray)-1;

        for($i=0; $i < $maSize ; $i++) {

            $minElement=$i;
            $tempMin=$multArray[$maIndex[$i]][$sortField];
            $tmpKey=$maIndex[$i];

            for($j=$i+1; $j <= $maSize; $j++)
                if($multArray[$maIndex[$j]][$sortField] < $tempMin ) {
                    $minElement=$j;
                    $tmpKey=$maIndex[$j];
                    $tempMin=$multArray[$maIndex[$j]][$sortField];

                }
                $maIndex[$minElement]=$maIndex[$i];
                $maIndex[$i]=$tmpKey;
        }

        if($desc)
            for($j=0;$j<=$maSize;$j++)
                $ResArray[$maIndex[$j]]=$multArray[$maIndex[$j]];
        else
            for($j=$maSize;$j>=0;$j--)
                $ResArray[$maIndex[$j]]=$multArray[$maIndex[$j]];

        return $ResArray;
    
    }

}
