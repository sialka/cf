<?php    
    
    switch ($mode) {
        case 'add':
            $page = 'Novo';
            $title = 'Ano (Adicionar)';
            break;
        case 'edit':
            $page = 'Edição';
            $title = 'Ano (Editar)';
            break;
        case 'view':
            $page = 'Visualização';
            $title = 'Ano (Consultar)';
            break;
    }

    $nav = [
        'Anos' => '/Anos/index',
        'Adicionar'   => '',
    ];
?>

<?= $this->element('breadcrumb', [ 'nav' => $nav ]); ?>


<style>
    .error-message{
        color: #cc0000 !important;
        border-radius: 0 !important;
        border: none !important;
        font-size: 0.8rem;
        font-weight: bold;    
    }

    .input.text.error{
        width: 100%;
    }
</style>

<div class="container-row">
    <div class="col-6 offset-3">

        <?= $this->Form->create($ano, array('class' => 'form-horizontal needs-validation', 'type' => 'post', 'novalidate')) ?>

        <div class="card shadow mb-4">

            <div class="card-header">
                <h6 class="normal strong p-0 m-0 text-primary">
                    <i class="fas fa-id-badge pr-2"></i>
                    <?= $title ?>
                </h6>
            </div>

            <div class="card-body">

                <div class="row">
                    <div class="form-group col-lg-12 col-md-12 col-sm-12 has-validation normal">
                        <label for="username" class="strong">Ano</label>
                        <?= 
                        
                            $this->Form->input('ano',
                                array(
                                    'class'       => 'form-control no-radius normal',
                                    'id'          => 'ano',
                                    'type'        => 'number',
                                    'div'         => false,
                                    'label'       => false,
                                    'placeholder' => 'Informe o ano',
                                    'required'                                            
                                )
                            );                                                                    
                        
                
                        ?>                       
                    </div>
                </div>
                
                <div class="row">
                    <div class="form-group col-lg-12 col-md-12 col-sm-12 normal">
                        <label for="status" class="strong">Status</label>
                        <?=
                        $this->Form->input('status',
                            array(
                                'class'       => 'form-control no-radius normal',
                                'id'          => 'status',
                                'type'        => 'select',
                                'options'     => $aevOptions['status'],
                                'div'         => false,
                                'label'       => false,
                                'required'
                            )
                        )
                        ?>
                    </div>
                </div>               
            
            </div>


            <div class="card-footer bg-light">
                <div class="text-right">

                    <?php if($mode != "view") {?>

                            <button type="submit" class="btn btn-success no-radius normal">
                                <i class="fa fa-check"></i>
                                Salvar
                            </button>

                    <?php } ?>

                    <a class="btn btn-link no-link normal" href="/Anos/index">
                        <i class="fa fa-reply"></i>
                        Voltar
                    </a>

                </div>
            </div>

        </div>
        <?= $this->Form->end() ?>

    </div>
</div>

<script>
$(document).ready(function(){

    <?php if (in_array($mode, ['edit','view'])) { ?>
            $('#username').attr('readonly', 'readonly');
            $('#username').attr('disabled', 'disabled');
    <?php } ?>

    <?php if (in_array($mode, ['view'])) { ?>
        $('input, select, check, radio, textarea').attr('readonly', 'readonly');
        $('input, select, check, radio, textarea').attr('disabled', 'disabled');
    <?php } ?>

});
</script>
