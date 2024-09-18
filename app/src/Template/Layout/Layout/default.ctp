<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'Sistema de Apoio';
$usuario         = $this->request->session()->read('logado');
$perfil          = $this->request->session()->read('perfil');

if($this->request->session()->read('mes') == null){
    $mes = "--/----";    
}else{
    $mesEnt = $this->request->session()->read('mes');        
    $mes = "{$mesEnt->mes}/{$mesEnt->ano}";
}

if($this->request->session()->read('meses') == null){
    $meses = [];
}else{
    $meses = $this->request->session()->read('meses');            
}

?>

<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>
        <?= $cakeDescription ?>
    </title>

    <?= $this->Html->meta('icon') ?>

    <!-- Custom fonts for this template-->
    <?= $this->Html->css('fontawesome-free/css/all.min.css') ?>
    <?= $this->Html->css('fontawesome-free/css/fontawesome.min.css') ?>        
    <?php #$this->Html->css('font-awesome-4.7.0/css/font-awesome.min.css') ?>    
    
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    
    <?= $this->Html->css('bootstrap.min') ?>
    <?= $this->Html->css('sb-admin-2.css') ?>
    <?= $this->Html->css('sb-add.css') ?>
    <?= $this->Html->css('typeahead.css') ?>

    <!-- Date Picker -->
    <?= $this->Html->css('date-picker/bootstrap-datepicker.css') ?>
    <?= $this->Html->css('date-picker/bootstrap-datepicker3.css') ?>

    <!-- Bootstrap core JavaScript-->
    <?= $this->Html->script('vendor/jquery/jquery.min.js') ?>
    <?= $this->Html->script('vendor/bootstrap/js/bootstrap.bundle.min.js') ?>

    <!-- Core plugin JavaScript-->
    <?= $this->Html->script('vendor/jquery-easing/jquery.easing.min.js') ?>


    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>

    <?php // Info controller $this->fetch('title') ?>
</head>
<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar :: col [1/2] -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/Dashboard/index">
                <div class="sidebar-brand-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-bank" viewBox="0 0 16 16">
                        <path d="m8 0 6.61 3h.89a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5H15v7a.5.5 0 0 1 .485.38l.5 2a.498.498 0 0 1-.485.62H.5a.498.498 0 0 1-.485-.62l.5-2A.501.501 0 0 1 1 13V6H.5a.5.5 0 0 1-.5-.5v-2A.5.5 0 0 1 .5 3h.89L8 0ZM3.777 3h8.447L8 1 3.777 3ZM2 6v7h1V6H2Zm2 0v7h2.5V6H4Zm3.5 0v7h1V6h-1Zm2 0v7H12V6H9.5ZM13 6v7h1V6h-1Zm2-1V4H1v1h14Zm-.39 9H1.39l-.25 1h13.72l-.25-1Z"/>
                    </svg>
                </div>
                <div class="sidebar-brand-text mx-3">SA 1.0</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="/Dashboard/index">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-speedometer2" viewBox="0 0 16 16">
                        <path d="M8 4a.5.5 0 0 1 .5.5V6a.5.5 0 0 1-1 0V4.5A.5.5 0 0 1 8 4zM3.732 5.732a.5.5 0 0 1 .707 0l.915.914a.5.5 0 1 1-.708.708l-.914-.915a.5.5 0 0 1 0-.707zM2 10a.5.5 0 0 1 .5-.5h1.586a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 10zm9.5 0a.5.5 0 0 1 .5-.5h1.5a.5.5 0 0 1 0 1H12a.5.5 0 0 1-.5-.5zm.754-4.246a.389.389 0 0 0-.527-.02L7.547 9.31a.91.91 0 1 0 1.302 1.258l3.434-4.297a.389.389 0 0 0-.029-.518z"/>
                        <path fill-rule="evenodd" d="M0 10a8 8 0 1 1 15.547 2.661c-.442 1.253-1.845 1.602-2.932 1.25C11.309 13.488 9.475 13 8 13c-1.474 0-3.31.488-4.615.911-1.087.352-2.49.003-2.932-1.25A7.988 7.988 0 0 1 0 10zm8-7a7 7 0 0 0-6.603 9.329c.203.575.923.876 1.68.63C4.397 12.533 6.358 12 8 12s3.604.532 4.923.96c.757.245 1.477-.056 1.68-.631A7 7 0 0 0 8 3z"/>
                    </svg>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Menu
            </div>

            <!-- Nav Item - Utilities Collapse Menu -->
            <?php           
            if($perfil->cad_users || $perfil->cad_anos || $perfil->cad_logs){ ?>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <!--svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-excel-fill" viewBox="0 0 16 16">
                        <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM5.884 6.68 8 9.219l2.116-2.54a.5.5 0 1 1 .768.641L8.651 10l2.233 2.68a.5.5 0 0 1-.768.64L8 10.781l-2.116 2.54a.5.5 0 0 1-.768-.641L7.349 10 5.116 7.32a.5.5 0 1 1 .768-.64z"/>
                    </svg-->
                    <i class="fas fa-cog text-white"></i>
                    <span>Sistema</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Ações:</h6>
                        <?php if($perfil->cad_users){ ?>
                            <a class="collapse-item" href="/Users/index">Usuários</a>
                        <?php } ?>
                        <?php if($perfil->cad_anos){ ?>
                            <a class="collapse-item" href="/Anos/index">Anos</a>
                        <?php } ?>                        
                        <?php if($perfil->cad_logs): ?>
                            <a class="collapse-item" href="/UsersLogs/index">Logs</a>
                        <?php endif; ?>
                    </div>
                </div>
            </li>
            <?php } ?>

            <!-- Nav Item - Pages Collapse Menu -->
            <?php if($perfil->admin || $perfil->cad_igrejas || $perfil->cad_mestrabalho){ ?>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-inbox-fill" viewBox="0 0 16 16">
                        <path d="M4.98 4a.5.5 0 0 0-.39.188L1.54 8H6a.5.5 0 0 1 .5.5 1.5 1.5 0 1 0 3 0A.5.5 0 0 1 10 8h4.46l-3.05-3.812A.5.5 0 0 0 11.02 4H4.98zm-1.17-.437A1.5 1.5 0 0 1 4.98 3h6.04a1.5 1.5 0 0 1 1.17.563l3.7 4.625a.5.5 0 0 1 .106.374l-.39 3.124A1.5 1.5 0 0 1 14.117 13H1.883a1.5 1.5 0 0 1-1.489-1.314l-.39-3.124a.5.5 0 0 1 .106-.374l3.7-4.625z"/>
                    </svg>
                    <span>Cadastro</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Sistema:</h6>       
                        <?php if($perfil->cad_igrejas){ ?>
                            <a class="collapse-item" href="/Localidades">Localidades</a>
                        <?php } ?>
                        <?php if($perfil->cad_mestrabalho){ ?>
                            <a class="collapse-item" href="/Ncs">Mês de Trabalho</a>
                        <?php } ?>
                    </div>
                </div>                
            </li>
            <?php } ?>
            
            <!-- Nav Item - Utilities Collapse Menu -->
            <?php if($perfil->cad_planilhas){ ?>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePlanilha"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-excel-fill" viewBox="0 0 16 16">
                        <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM5.884 6.68 8 9.219l2.116-2.54a.5.5 0 1 1 .768.641L8.651 10l2.233 2.68a.5.5 0 0 1-.768.64L8 10.781l-2.116 2.54a.5.5 0 0 1-.768-.641L7.349 10 5.116 7.32a.5.5 0 1 1 .768-.64z"/>
                    </svg>
                    <span>Planilha</span>
                </a>
                <div id="collapsePlanilha" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Ações:</h6>
                        <?php if($perfil->cad_planilhas): ?>
                            <a class="collapse-item" href="/Planilhas/index">Lançar</a>
                        <?php endif; ?>
                        <?php if($perfil->exp_planilhas): ?>
                            <a class="collapse-item" href="/Planilhas/export">Exportar</a>
                        <?php endif; ?>
                        <?php if($perfil->imp_planilhas): ?>
                            <a class="collapse-item" href="/Planilhas/import">Importar</a>
                        <?php endif; ?>
                    </div>
                </div>
            </li>
            <?php } ?>
            
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper :: col [2/2] -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar p-0 static-top shadow">                    

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        
                        <li class="nav-item dropdown no-arrow text-white" style="background-color: #9EC5FE">
                                
                            <div class="d-flex dropdown-toggle" id="alertsDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                <div class="d-flex align-items-center p-1" style="cursor: pointer">
                                    <i class="fa fa-calendar fa-fw"></i>
                                </div>

                                <div class="d-flex px-1" style="cursor: pointer">
                                    <div class="d-flex flex-column normal text-center m-auto" style="color: #052C65">                                        
                                        <p class="m-0 small text-primary-500">Mês de Trabalho</p>
                                        <p class="m-0 strong"><?= $mes ?></p>
                                    </div>
                                </div>

                                <div class="d-flex align-items-center p-1">                                    
                                    <a class="nav-link p-0 " href="#" role="button">
                                        <?php #if(sizeof($meses) > 0) { ?>
                                        <i class="fa fa-caret-down fa-fw text-white"></i>
                                        <?php #} ?>
                                    </a>
                                </div>

                            </div>                                
                            
                            <!-- Dropdown - Alerts -->
                            <?php if(sizeof($meses) > 0) { ?>
                            <div class="dropdown-menu dropdown-menu-right no-radius shadow animated--grow-in border-1 mes-padrao-scrollbar" aria-labelledby="alertsDropdown">                                
                                <?php foreach($meses as $item) { ?>
                                <a class="dropdown-item d-flex align-items-center" href="/ncs/padrao/<?= $item->id ?>">
                                    <div class="mr-3">                                        
                                        <i class="fa fa-arrow-right fa-fw text-gray-500"></i>
                                    </div>                                         
                                    <span class="strong">
                                        <?= "{$item->mes}/{$item->ano}" ?>
                                    </span>
                                </a>
                                <?php } ?>
                            </div>
                            <?php } ?>
                        </li>

                        <!--div class="topbar-divider d-none d-sm-block mx-2"></div-->

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 pl-4 d-none d-lg-inline text-gray-600 small"><?= $usuario ?></span>
                                <?= $this->Html->image('undraw_profile.svg', ["class"=>"img-profile rounded-circle"]) ?>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right no-radius border-1 shadow animated--grow-in" aria-labelledby="userDropdown">                                
                                <a class="dropdown-item" href="/Users/perfil">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-800"></i>
                                    Perfil
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="/Users/logout" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-danger"></i>
                                    Sair
                                </a>                                
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid p-0">
                    <?= $this->fetch('content') ?>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="exampleModalLabel">Atenção</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Tem certeza que deseja sair do sistema ?</div>
                <div class="modal-footer">

                    <a class="btn btn-success no-radius normal" href="/Users/logout">
                        <i class="fa fa-check"></i>
                        Sair
                    </a>

                    
                    <button class="btn btn-link no-link text-primary normal" type="button" data-dismiss="modal">
                        <i class="fa fa-reply"></i>
                        Cancelar
                    </button>
                    
                </div>
            </div>
        </div>
    </div>

</body>
</html>

<!-- Custom scripts for all pages-->
<?= $this->Html->script('sb-admin-2.js') ?>
<!-- JQ Mask -->
<?= $this->Html->script('mask/jquery.mask.min.js') ?>
<!-- Date-Picker -->
<?= $this->Html->script('date-picker/js/bootstrap-datepicker.js') ?>
<?= $this->Html->script('date-picker/locales/bootstrap-datepicker.pt-BR.min.js') ?>

<!-- Teste -->
<?= $this->Html->script('typeahead.js') ?>

<script>
    // Validações de Formulario Bootstrap
    
    (function() {
      'use strict';
      window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');        
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
          form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
              event.preventDefault();
              event.stopPropagation();
            }
            form.classList.add('was-validated');
          }, false);
        });
      }, false);
    })();

</script>