<?php
    $nav = [
        'Usuarios' => ''
    ];

    echo $this->element('breadcrumb');  
    
    function percent($valor, $total){
        return  (100 * $valor) / $total;
    }

    $primeiros = 0;
    
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

                <div class="col-12 -p-0 mb-2">
                    <div class="card shadow no-radius border-1">                        
                        <div class="card-body p-3">                        
                            <div class="pt-1S">                                                        
                                <p class="h6 font-weight-bold text-gray-800">
                                    <i class="far fa-credit-card text-success"></i>
                                    <?= $pagamentos; ?> Pagamentos
                                </p>                            
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
                                            <th class="text-center text-dark" width="25%"> <?= __('Localidades') ?> </th>
                                            <th class="text-center text-dark" width="10%"> <?= __('Pagamentos') ?> </th>
                                            <th class="text-center text-dark" width="10%"> <?= __('%') ?> </th>
                                            <th class="text-center text-dark" width="15%"> <?= __('Gastos') ?> </th>
                                            <th class="text-center text-dark" width="40%"> <?= __('') ?> </th>
                                        </tr>
                                    </thead>
                                    <tbody class="">
                                        <?php foreach ($localidades as $key => $value): $primeiros++ ?>
                                            <tr class="normal">
                                                <td class="text-left   px-3">
                                                    <?php 
                                                        $localidade_id = $value['localidade_id'];
                                                        $mes = $value['mes'];
                                                        if($primeiros < 4) {
                                                            echo '<i class="fas fa-star text-warning"></i> ';
                                                            echo "<a href='/dashboard/detalhe/$mes/$localidade_id' style='text-decoration: none'><strong>$key</strong></a>";                                                            
                                                        }else{
                                                            echo "<a href='/dashboard/detalhe/$mes/$localidade_id' style='text-decoration: none'>$key</a>";
                                                        }
                                                    ?>                                                    
                                                </td>
                                                <td class="text-center px-3"><?= $value['pagtos']?></td>
                                                <td class="text-center px-3"><?= "" . number_format(percent($value['gastos'], $total), 2, ',', '.'); ?></td>
                                                <td class="text-right px-3">                                                    
                                                    <?php 
                                                        if($primeiros < 4) {
                                                            echo '<strong>R$ '.number_format($value['gastos'], 2, ',', '.').'</strong>';
                                                        }else{
                                                            echo 'R$ '.number_format($value['gastos'], 2, ',', '.');
                                                        }
                                                    ?>                                                    

                                                </td>
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
