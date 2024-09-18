<?php
    $nav = [
        'Anos' => ''
    ];
?>
<?= $this->element('breadcrumb', [ 'nav' => $nav ]); ?>

<div class="container-row normal">
    <div class="col-12">

        <div class="col-12 p-0 mb-2">
            <a class="btn btn-success no-radius normal" href="/Anos/add">
                <i class="fa fa-plus fa-sm"></i>
                <span class="">Novo</span>
            </a>
        </div>  
        
        <div class="row">
            <div class="col-12 mt-2 mb-2">
                
                <!-- CARD -->
                <div class="card shadow no-radius border-1">

                    <!-- HEADER -->
                    <div class="card-header p-2 m-0 d-flex justify-content-between">

                        <?= $this->element('search', [ 'search' => 'Por Nome ou usuário' ]); ?>

                    </div>                                                    

                    <!-- BODY -->
                    <div class="card-body no-border p-0 m-0">                                         

                        <div class="table-responsive table-striped table-sm table-hover m-0" style="overflow-x: visible;">
                            <table id="tableResults" class="table table-bordered p-0 m-0" style="border-bottom: 0px solid white">
                                <thead>
                                    <tr>
                                        <?= $this->element('th_sort', [ 'th' => ['05%', 'Anos.id', __('id') ] ]); ?>
                                        <?= $this->element('th_sort', [ 'th' => ['10%', 'Anos.ano', __('Anos') ] ]); ?>                                        
                                        <?= $this->element('th_sort', [ 'th' => ['10%', 'Anos.status', __('Status') ] ]); ?>
                                        <th class="text-center" width="65%"></th>                                        
                                        <th class="text-center" width="10%"></th> 
                                    </tr>
                                </thead>
                                <tbody class="tdMiddleAlign">
                                    <?php foreach ($anos as $ano): ?>
                                        <tr class="vAlignMiddle">
                                            <td class="text-left px-3"><?= h($ano->id) ?></td>
                                            <td class="text-left px-3"><?= h($ano->ano) ?></td>                                            
                                            <td class="text-left px-3">
                                                <?= $this->element('status', [ 'status' => $aevOptions['status'][$ano->status] ]); ?>
                                            </td>
                                            <td class="text-center px-3"></td>
                                            <td class="text-center px-3">
                                                <div class="dropdown d-block">
                                                    <button class="dropdown-toggle btn btn-primary btn-sm no-radius normal py-0" type="button" id="acoesListar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Opções
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right -py-2 -m-0" aria-labelledby="acoesListar">
                                                        <a class="dropdown-item"  href="/Anos/view/<?= $ano->id;?>">
                                                            <i class="fa fa-search text-primary"></i>
                                                            Visualizar
                                                        </a>                                                        
                                                        <a class="dropdown-item" href="/Anos/edit/<?= $ano->id;?>"
                                                            data-confirm = "Tem certeza que deseja editar o ano?">
                                                            <i class="fa fa-pencil-alt text-success"></i>
                                                            Editar
                                                        </a>
                                                        <a class="dropdown-item" href="/Anos/delete/<?= $ano->id;?>"
                                                            data-confirm = "Tem certeza que deseja excluir o ano?">
                                                            <i class="fas fa-trash-alt text-danger"></i>
                                                            Excluir
                                                        </a>                                                        
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                    </div>

                    <!-- FOOTER -->
                    <div class="card-footer p-0 m-0"> 
                        <?php echo $this->element('pager'); ?>
                    </div>

                </div>
            </div>
        </div>
            
        
    </div>
</div>

<script>

    $(document).ready(function() {

        // ToolTip
        $('[data-toggle="tooltip"]').tooltip();

        // Modal
        <?= $this->element('modal_confirm'); ?>

    });

</script>