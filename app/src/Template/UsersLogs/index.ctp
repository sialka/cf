<?php

$nav = [
    'Logs' => ''
];    

echo $this->element('breadcrumb', [ 'nav' => $nav ]); 

?>

<div class="container-row normal">
    <div class="col-12">
        
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
                                        <?= $this->element('th_sort', [ 'th' => ['10%', 'UsersLogs.id', __('ID') ] ]); ?>
                                        <?= $this->element('th_sort', [ 'th' => ['20%', 'UsersLogs.User.nome', __('Usuário') ] ]); ?>
                                        <?= $this->element('th_sort', [ 'th' => ['50%', 'UsersLogs.controller', __('Controller') ] ]); ?>                                        
                                        <?= $this->element('th_sort', [ 'th' => ['20%', 'UsersLogs.created', __('Date e Hora') ] ]); ?>                                        
                                    </tr>
                                </thead>
                                <tbody class="tdMiddleAlign">
                                    <?php foreach ($logs as $log): ?>
                                        <tr class="vAlignMiddle">
                                            <td class="text-left px-3"><?= h($log->id) ?></td>
                                            <td class="text-left px-3"><?= h($log->Users->nome) ?></td>
                                            <td class="text-left px-3"><?= h($log->controller) ?></td>
                                            <td class="text-left px-3">
                                                <?= $log->created->modify('-3 hours'); ?>
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
