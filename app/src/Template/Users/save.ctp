<?php    
    
    switch ($mode) {
        case 'add':
            $page = 'Novo';
            $title = 'Usuário (Adicionar)';
            break;
        case 'edit':
            $page = 'Edição';
            $title = 'Usuário (Editar)';
            break;
        case 'view':
            $page = 'Visualização';
            $title = 'Usuário (Consultar)';
            break;
    }

    $nav = [
        'Usuários' => '/Users/index',
        'Adicionar'   => '',
    ];


?>

<?= $this->element('breadcrumb', [ 'nav' => $nav ]); ?>

<div class="container-row">
    <div class="col-6 offset-3">

        <?= $this->Form->create($user, array('class' => 'form-horizontal needs-validation', 'type' => 'post', 'novalidate')) ?>
        <div class="card shadow mb-4">

            <div class="card-header">
                <h6 class="normal strong p-0 m-0 text-primary">
                    <i class="fas fa-id-badge pr-2"></i>
                    <?= $title ?>
                </h6>
            </div>

            <div class="card-body">

                <ul class="nav nav-tabs normal" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">Usuário</a>
                    </li>
                    
                    <?php if($mode == 'edit') { ?>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#password" role="tab" aria-controls="password" aria-selected="false">Senha</a>
                    </li>
                    <?php } ?>
                    
                    <?php if($perfil->cad_users) { ?>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link -disabled" id="messages-tab" data-toggle="tab" href="#settings" role="tab" aria-controls="settings" aria-selected="false">Perfil</a>
                    </li>
                    <?php } ?>
                </ul>

                <div class="tab-content">
                    
                    <!-- Dados -->
                    <div class="tab-pane border-tab p-4 active normal" id="profile" role="tabpanel" aria-labelledby="profile-tab">                        
                        
                        <div class="row">
                            <div class="form-group col-lg-6 col-md-6 col-sm-12 has-validation normal">
                                <label for="username" class="strong">Usuário</label>
                                <?php if($mode == "add") { 
                                
                                    echo $this->Form->input('username',
                                        array(
                                            'class'       => 'form-control no-radius normal',
                                            'id'          => 'username',
                                            'type'        => 'text',
                                            'div'         => false,
                                            'label'       => false,
                                            'placeholder' => 'Informe o Login de acesso',
                                            'required'                                            
                                        )
                                    );                                    
                                
                                }else{
                        
                                    echo __("<label for='' class='form-control no-radius normal disabled'>{$user->username}</label>");
                        
                                } ?>                       

                            </div>
                        </div>                        

                        <div class="row">
                            <div class="form-group col-12 normal">
                                <label for="nome" class="strong">Nome Completo</label>
                                <?=
                                $this->Form->input('nome',
                                    array(
                                        'class'       => 'form-control no-radius normal',
                                        'id'          => 'nome',
                                        'type'        => 'text',
                                        'div'         => false,
                                        'label'       => false,
                                        'placeholder' => 'Infrome o Nome completo',
                                        'required'
                                    )
                                );
                                ?>                                
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-12 normal">
                                <label for="email" class="strong">E-Mail</label>
                                <?=
                                $this->Form->input('email',
                                    array(
                                        'class'       => 'form-control no-radius normal',
                                        'id'          => 'email',
                                        'type'        => 'email',
                                        'div'         => false,                                        
                                        'label'       => false,
                                        'placeholder' => 'Informe o e-mail',
                                        'required'
                                    )
                                )
                                ?>
                            </div>
                        </div>

                        <?php if($perfil->cad_users) { ?>
                        <div class="row">
                            <div class="form-group col-lg-6 col-md-6 col-sm-12 normal">
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
                        <?php } ?>

                    </div>
                    
                    <?php if($mode == 'edit') { ?>
                    <!-- Senha -->
                    <div class="tab-pane border-tab p-4" id="password" role="tabpanel" aria-labelledby="password-tab"> 
                        
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="password" class="strong normal">Nova Senha</label>
                                <?php
                                if ($user_auth['id'] == $user->id || $perfil->admin) { 
                                    echo $this->Form->input('password',
                                        array(
                                            'class'       => 'form-control no-radius normal',
                                            'id'          => 'password',
                                            'type'        => 'password',
                                            'div'         => false,
                                            'label'       => false,
                                            'value'       => '',
                                        )
                                    );
                                }else{
                                    echo '<label class="form-control no-radius label-disabled">***</label>';
                                }                                    
                                ?>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="confirma" class="strong normal">Confirme a Senha</label>
                                <?php
                                if ($user_auth['id'] == $user->id || $perfil->admin) {                                     
                                    echo $this->Form->input('confirma',
                                        array(
                                            'class'       => 'form-control no-radius normal',
                                            'id'          => 'confirma',
                                            'type'        => 'password',
                                            'div'         => false,
                                            'label'       => false,
                                            'value'       => '',
                                        )
                                    );
                                }else{
                                    echo '<label class="form-control no-radius label-disabled">***</label>';
                                }
                                        
                                ?>
                            </div>
                        </div>

                    </div>
                    <?php } ?>

                    <!-- Settings -->
                    <?php if($perfil->cad_users) { ?>
                    <div class="tab-pane border-tab p-4" id="settings" role="tabpanel" aria-labelledby="settings-tab">

                        <div class="row">                            
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-check p-0">                                
                                    <label for="adm" class="form-check-label strong normal mb-2">Perfil do Usuário</label>
                               
                                    <?php                                
                                    $checked = $mode == 'add' ? 'checked' : '';                                
                                    echo $this->Form->input('Perfil.admin', [
                                        'type' => 'radio',                                    
                                        'label' => false,                                        
                                        'options' => [
                                            ['value' => 1, 'text' => __(' Administrador'), ],
                                            ['value' => 0, 'text' => __(' Padrão'), $checked],
                                        ],
                                        'templates' => [
                                            'nestingLabel' => '{{hidden}}{{input}}<label{{attrs}} class="pl-1">{{text}}</label>',
                                            'radioWrapper' => '<div class="normal">{{label}}</div>'
                                        ]
                                    ]);                                
                                    ?>

                                </div>
                            </div>                                                
                        </div>
                        
                        <hr>
                        
                        <p class="strong normal">Módulos Permitidos</p>
                        
                        <div class="row">
                            
                            <p class="strong normal m-1 p-1 text-primary col-12">Sistema</p>

                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="form-check">                                
                                    <?=                                
                                    $this->Form->checkbox('Perfil.cad_users', 
                                            array(                                            
                                                'class'       => 'form-check-input no-radius normal',
                                                'id'          => 'cad_users',
                                                'div'         => false,
                                                'label'       => false,
                                            )
                                        );
                                    ?>                      
                                    <label for="adm" class="form-check-label strong normal">Usuário</label>
                                </div>
                            </div>            
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="form-check">                                
                                    <?=                                
                                    $this->Form->checkbox('Perfil.cad_anos', 
                                            array(                                            
                                                'class'       => 'form-check-input no-radius normal',
                                                'id'          => 'cad_anos',
                                                'div'         => false,
                                                'label'       => false,
                                            )
                                        );
                                    ?>                      
                                    <label for="adm" class="form-check-label strong normal">Anos</label>
                                </div>
                            </div>   
                            <?php if($perfil->admin): ?>
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="form-check">                                
                                    <?=                                
                                    $this->Form->checkbox('Perfil.cad_logs', 
                                            array(                                            
                                                'class'       => 'form-check-input no-radius normal',
                                                'id'          => 'cad_logs',
                                                'div'         => false,
                                                'label'       => false,
                                            )
                                        );
                                    ?>                      
                                    <label for="adm" class="form-check-label strong normal">Logs</label>
                                </div>
                            </div>      
                            <?php endif; ?>                                                                      

                            <p class="strong normal m-1 p-1 text-primary col-12">Cadastro</p>

                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="form-check">                                
                                    <?=                                
                                    $this->Form->checkbox('Perfil.cad_igrejas', 
                                            array(                                            
                                                'class'       => 'form-check-input no-radius normal',
                                                'id'          => 'cad_igrejas',
                                                'div'         => false,
                                                'label'       => false,
                                            )
                                        );
                                    ?>                      
                                    <label for="adm" class="form-check-label strong normal">Localidades</label>
                                </div>
                            </div>                
                        
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="form-check">                                
                                    <?=
                                    $this->Form->checkbox('Perfil.cad_mestrabalho', 
                                            array(                                            
                                                'class'       => 'form-check-input no-radius normal',
                                                'id'          => 'cad_mestrabalho',
                                                'div'         => false,
                                                'label'       => false,                                            
                                            )
                                        );
                                    ?>
                                    <label for="adm" class="form-check-label strong normal">Mês de Trabalho</label>                            
                                </div>
                            </div>
                        
                            <p class="strong normal m-1 p-1 text-primary col-12">Planilhas</p>

                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="form-check">                                
                                    <?=
                                    $this->Form->checkbox('Perfil.cad_planilhas', 
                                            array(                                            
                                                'class'       => 'form-check-input no-radius normal',
                                                'id'          => 'cad_planilhas',
                                                'div'         => false,
                                                'label'       => false,                                            
                                            )
                                        );
                                    ?>
                                    <label for="adm" class="form-check-label strong normal">Lançar</label>
                                </div>                                                                            
                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="form-check">                                
                                    <?=
                                    $this->Form->checkbox('Perfil.imp_planilhas', 
                                            array(                                            
                                                'class'       => 'form-check-input no-radius normal',
                                                'id'          => 'imp_planilhas',
                                                'div'         => false,
                                                'label'       => false,                                            
                                            )
                                        );
                                    ?>
                                    <label for="adm" class="form-check-label strong normal">Importar</label>
                                </div>                                                                            
                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="form-check">                                
                                    <?=
                                    $this->Form->checkbox('Perfil.exp_planilhas', 
                                            array(                                            
                                                'class'       => 'form-check-input no-radius normal',
                                                'id'          => 'exp_planilhas',
                                                'div'         => false,
                                                'label'       => false,                                            
                                            )
                                        );
                                    ?>
                                    <label for="adm" class="form-check-label strong normal">Exportar</label>
                                </div>                                                                            
                            </div>                                                
                        </div>

                    </div>
                    <?php } ?>
                    
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

                    <a class="btn btn-link no-link normal" href="/Users/index">
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
    
    let modoEdit = false;

    <?php if (in_array($mode, ['edit','view'])) { ?>
            $('#username').attr('readonly', 'readonly');
            $('#username').attr('disabled', 'disabled');
            $('#perfil-admin-0').attr('disabled', 'disabled');
            $('#perfil-admin-1').attr('disabled', 'disabled');
    <?php } ?>

    <?php if (in_array($mode, ['view'])) { ?>
        $('input, select, check, radio, textarea').attr('readonly', 'readonly');
        $('input, select, check, radio, textarea').attr('disabled', 'disabled');
    <?php } ?>

    $('#myTab a').on('click', function (event) {
        event.preventDefault()
        $(this).tab('show')
    }); 
    
    function isAdmin(){                
        
        if(modoEdit){
            $('#cad_igrejas').prop( "checked" , true)
            $('#cad_mestrabalho').prop( "checked" , true)
            $('#cad_planilhas').prop( "checked" , true)
            $('#imp_planilhas').prop( "checked" , true)
            $('#exp_planilhas').prop( "checked" , true)
            $('#cad_users').prop( "checked" , true)
            $('#cad_anos').prop( "checked" , true)
            $('#cad_logs').prop( "checked" , true)
            
            $('#cad_igrejas').prop( "disabled" , true)
            $('#cad_mestrabalho').prop( "disabled" , true)
            $('#cad_planilhas').prop( "disabled" , true)
            $('#imp_planilhas').prop( "disabled" , true)
            $('#exp_planilhas').prop( "disabled" , true)
            $('#cad_users').prop( "disabled" , true)
            $('#cad_anos').prop( "disabled" , true)
            $('#cad_logs').prop( "disabled" , true)

        }
        modoEdit = true;
    }
    
    function isCustom(){        
        
        if(modoEdit){
            $('#cad_igrejas').prop( "checked" , false)
            $('#cad_mestrabalho').prop( "checked" , false)
            $('#cad_planilhas').prop( "checked" , false)
            $('#exp_planilhas').prop( "checked" , false)
            $('#imp_planilhas').prop( "checked" , false)                        
            $('#cad_users').prop( "checked" , false)
            $('#cad_anos').prop( "checked" , false)
            $('#cad_logs').prop( "checked" , false)
            
            $('#cad_igrejas').prop( "disabled" , false)
            $('#cad_mestrabalho').prop( "disabled" , false)
            $('#cad_planilhas').prop( "disabled" , false)            
            $('#imp_planilhas').prop( "disabled" , false)
            $('#exp_planilhas').prop( "disabled" , false)
            $('#cad_users').prop( "disabled" , false)
            $('#cad_anos').prop( "disabled" , false)
            $('#cad_logs').prop( "disabled" , false)            

        }
        modoEdit = true;        
    }

    
    $("input[id=perfil-admin-0]").on('change', function() {
        
        if ($(this).val() == true) {
            isAdmin();
        } 
       
        if ($(this).val() == false) {            
            isCustom();
        } 
       
    }).parent().find("input[id=perfil-admin-0]:checked").change();    

    $("input[id=perfil-admin-1]").on('change', function() {
        
        if ($(this).val() == true) {
            isAdmin();
        } 
       
        if ($(this).val() == false) {
           isCustom();
        } 
       
    }).parent().find("input[id=perfil-admin-1]:checked").change();    

    <?php    
    if($mode == "edit" && $user->Perfil->admin == 1) { 
        //echo 'isAdmin()';
    }  
    ?>
});
</script>
