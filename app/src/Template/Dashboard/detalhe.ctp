<?php
    $nav = [
        'Usuarios' => ''
    ];

    echo $this->element('breadcrumb');  
    $numero = 0;
?>


<!-- Content Row -->
<div class="container-row">

    <div class="row col-12 d-block m-auto text-center">
        <h1 class='h3 mb-4 dashboard-title'>
            <?= $title; ?>
        </h1>
    </div>
    
    <div class="container-row normal">
        <div class="col-12">

            <!-- Card -->
            <div class="row">

                <div class="col-12 mb-2">            
                    <a class="btn btn-primary no-radius normal" href="/Dashboard/">
                        <i class="fa fa-reply"></i>
                        <span class="">Voltar</span>
                    </a>                       
                </div>                   

                <div class="col-12 mb-2">
                    <div class="card shadow no-radius border-1">                        
                        <div class="card-body p-3">                        
                            <p>Total de Gastos:</p>
                            <div class="pt-1S">                                                        
                                <p class="h4 font-weight-bold text-gray-800">R$ <?= number_format($total, 2, ',', '.'); ?></p>
                            </div>
                        </div>                        
                    </div>
                </div>  

                <div class="col-12 mt-0 mb-2">
                    <div class="card shadow no-radius border-1">
                        <!-- BODY -->
                        <div class="card-body no-border p-0 m-0">                            
                            <div class="table-striped table-sm table-hover m-0" style="overflow-x: visible;">
                                <table id="tableResults" class="table-responsive-lg table table-bordered p-0 m-0 no-border">
                                    <thead>
                                        <tr class="normal strong">                                   
                                            <th class="text-center text-dark" width="05%"> <?= __('') ?> </th>
                                            <th class="text-center text-dark" width="20%"> <?= __('Localidade/Setor') ?> </th>
                                            <th class="text-center text-dark" width="40%"> <?= __('Fornecedores') ?> </th>
                                            <th class="text-center text-dark" width="10%"> <?= __('Vencimentos') ?> </th>
                                            <th class="text-center text-dark" width="10%"> <?= __('Pagamentos') ?> </th>
                                            <th class="text-center text-dark" width="10%"> <?= __('Valores') ?> </th>
                                            <th class="text-center text-dark" width="05%"> <?= __('') ?> </th>
                                        </tr>
                                    </thead>
                                    <tbody class="">
                                        <?php foreach ($lancamentos as $lancamento): $numero++; //debug($lancamento)?>
                                            <tr class="normal">
                                                <td class="text-left   px-3"><?= $numero ?></td>
                                                <td class="text-left   px-3"><?= $lancamento->Localidades->nome ?></td>
                                                <td class="text-left   px-3"><?= $lancamento->fornecedor_nome ?></td>
                                                <td class="text-center px-3"><?= $lancamento->dt_vencimento ?></td>
                                                <td class="text-center px-3"><?= $lancamento->dt_pagamento ?></td>
                                                <td class="text-right  px-3"><?= "" . number_format($lancamento->valor, 2, ',', '.'); ?></td>                               
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>            
        </div>
    </div>       
</div>
