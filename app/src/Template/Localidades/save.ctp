<?php
switch ($mode) {
    case 'add':
        $page = 'Novo';
        $title = 'Nova Localidade';
        break;
    case 'edit':
        $page = 'Editar';
        $title = 'Alterar Localidade';
        break;
    case 'view':
        $page = 'Dados';
        $title = 'Visualizar';
        break;
}

$nav = [
    'Localidades' => '/Places/index',
    'Adicionar' => '',
];

$session = $this->request->session()->read('localidade');

if($session != null){
  $localidade = $session;
}

?>

<?= $this->element('breadcrumb', ['nav' => $nav]); ?>

<div class="container-row">
    <div class="col-4 offset-4">
        
        <?= $this->Form->create($localidade, array('class' => 'form-horizontal needs-validation', 'type' => 'post', 'novalidate')) ?>
        
        <div class="card shadow border-1 no-radius mb-4">

            <div class="card-header py-3">
                <h6 class="normal strong p-0 m-0 text-primary">
                    <i class="fas fa-map-marker-alt"></i>
                    <?= $title ?>
                </h6>
            </div>

            <div class="card-body normal">

                <div class="row">
                    <div class="form-group col-lg-4 col-md-4 col-sm-6 col-sx-12">
                        <label for="codigo" class="strong">Código</label>
                        <?php
                        if ($mode != "add") {
                            echo __("<label class='form-control disabled no-radius normal'>{$localidade->codigo}</label>");
                        } else {
                            echo
                            $this->Form->input('codigo',
                                    array(
                                        'class'       => 'form-control no-radius normal',
                                        'id'          => 'codigo',
                                        'placeholder' => '21-0000',
                                        'type'        => 'text',
                                        'div'         => false,
                                        'label'       => false,
                                        'required'
                                    )
                            );
                        }
                        ?>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-12">
                        <label for="nome" class="strong">Localidade</label>
                        <?=
                        $this->Form->input('nome',
                                array(
                                    'class'       => 'form-control no-radius normal',
                                    'id'          => 'nome',
                                    'placeholder' => 'Nome Completo da Localidade',
                                    'type'        => 'text',
                                    'div'         => false,
                                    'label'       => false,
                                    'required'
                                )
                        )
                        ?>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-lg-6 col-md-6 col-sm-12">
                        <label for="setor" class="strong">Setor</label>
                        <?=
                        $this->Form->input('setor',
                                array(
                                    'class'       => 'form-control text-center no-radius normal',
                                    'id'          => 'setor',
                                    'placeholder' => __(''),
                                    'type'        => 'select',
                                    'options'     => ['' => ''] + $aevOptions['setores'],
                                    'div'         => false,
                                    'label'       => false,
                                    'required'
                                )
                        )
                        ?>
                    </div>
                    <div class="form-group col-lg-6 col-md-6 col-sm-12">
                        <label for="status" class="strong">Status</label>
                        <?=
                        $this->Form->input('status',
                                array(
                                    'class' => 'form-control text-center no-radius normal',
                                    'id' => 'status',
                                    'placeholder' => __(''),
                                    'type' => 'select',
                                    'options' => $aevOptions['status'],
                                    'div' => false,
                                    'label' => false,
                                    'required'
                                )
                        )
                        ?>
                    </div>
                </div>

                <?php if (in_array($mode, ['view'])) { ?>

                    <div class="row">
                        <div class="form-group col-lg-6 col-md-6 col-sm-12">
                            <label for="created" class="font-weight-bold">Criando</label>
                            <?=
                            $this->Form->input('created',
                                    array(
                                        'class' => 'form-control',
                                        'id' => 'created',
                                        'type' => 'text',
                                        'div' => false,
                                        'label' => false,
                                        'value' => strlen($localidade->created) > 0 ? $localidade->created->format('d/m/Y H:i:s') : "00/00/0000 00:00:00",
                                    )
                            )
                            ?>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-12">
                            <label for="modified" class="font-weight-bold">Modificado</label>
                            <?=
                            $this->Form->input('modified',
                                    array(
                                        'class' => 'form-control',
                                        'id' => 'modified',
                                        'type' => 'text',
                                        'div' => false,
                                        'label' => false,
                                        'value' => strlen($localidade->modified) > 0 ? $localidade->modified->format('d/m/Y H:i:s') : "00/00/0000 00:00:00",
                                    )
                            )
                            ?>
                        </div>

                    </div>

                <?php } ?>

            </div>

            <div class="card-footer bg-light">
                <div class="text-right">

                    <?php if ($mode != "view") { ?>

                        <button type="submit" class="btn btn-success no-radius normal">
                            <i class="fa fa-check"></i>
                            Salvar
                        </button>

                    <?php } ?>


                    <a class="btn btn-link no-link normal" href="/Localidades/index">
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
    $(document).ready(function () {

        $('#codigo').mask('00-0000');

<?php if (in_array($mode, ['edit', 'view'])) { ?>
            $('#codigo').attr('readonly', 'readonly');
            $('#codigo').attr('disabled', 'disabled');
<?php } ?>

<?php if (in_array($mode, ['view'])) { ?>
            $('input, select, check, radio, textarea').attr('readonly', 'readonly');
            $('input, select, check, radio, textarea').attr('disabled', 'disabled');
<?php } ?>

    });
</script>
