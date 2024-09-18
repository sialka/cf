<?php
    $nav = [
        'Usuarios' => ''
    ];

    echo $this->element('breadcrumb'); 
     
    echo $this->Html->script('chart/Chart.js');    
    
?>

<style>
    @media (min-width: 768px) {
      .chart-pie {
        height: calc(26rem - 43px) !important;
      }
    }
</style>

<!-- Content Row -->
<div class="container-row">

    <div class="row col-12 d-block m-auto text-center">
        <h1 class='h3 mb-4 dashboard-title'>
            <?= $title; ?>
        </h1>
    </div>
    
    <div class="row">
        
        <div class="col-4">
            
            <div class="ml-4">
                
                <div class="col-12 p-0 mb-1">
                    <div class="card border-left-primary shadow h-100">
                        <a href="/Dashboard/resumo/setor0" style="text-decoration: none" class="btn-light">
                            <div class="card-body p-3">

                                <!-- Administracao - Info Gastos -->
                                <div class="d-flex justify-content-between pt-1">
                                    <div class="h5 font-weight-bold text-primary text-uppercase">Administração</div>                            
                                    <div class="h5 font-weight-bold text-gray-800">R$ <?= number_format($saldos['saldos']['setor0'], 2, ',', '.'); ?></div> 
                                </div>                        
                                <!-- Administracao - Progress Bar -->                    
                                <div class="row no-gutters align-items-center mt-2">
                                    <div class="col-auto">
                                        <div class="h5 m-0 mr-3 font-weight-bold text-xs text-gray-800"><?= $saldos['porcentagens']['setor0']?> %</div>
                                        <div class="h5 m-0 mr-3 font-weight-bold text-xs text-gray-800">
                                            <i class="fa fa-share"></i>
                                            <?= $saldos['lancamentos']['setor0']?> lançamentos
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="progress progress-sm mr-2">
                                            <div class="progress-bar bg-info" role="progressbar" style="width: <?= $saldos['porcentagens']['setor0'] ?>%" aria-valuenow="<?= $saldos['porcentagens']['setor0'] ?>" aria-valuemin="0" aria-valuemax="100"></div>                                        
                                        </div>                            
                                    </div>                        
                                </div>

                            </div>
                        </a>
                    </div>
                </div>                        

                <div class="col-12 p-0 mb-1">
                    <div class="card border-left-success shadow h-100">
                        <a href="/Dashboard/resumo/setor1" style="text-decoration: none" class="btn-light">
                            <div class="card-body p-3">                        

                                <!-- Setor I - Info Gastos -->
                                <div class="d-flex justify-content-between pt-1">
                                    <div class="h5 font-weight-bold text-success text-uppercase">1 - Centro</div>
                                    <div class="h5 font-weight-bold text-gray-800">R$ <?= number_format($saldos['saldos']['setor1'], 2, ',', '.'); ?></div>                                
                                </div>
                                <!-- Setor I - Progress Bar -->                    
                                <div class="row no-gutters align-items-center mt-2">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-xs text-gray-800"><?= $saldos['porcentagens']['setor1']?> %</div>
                                        <div class="h5 m-0 mr-3 font-weight-bold text-xs text-gray-800">
                                            <i class="fa fa-share"></i>
                                            <?= $saldos['lancamentos']['setor1']?> lançamentos
                                        </div>                                                                        
                                    </div>
                                    <div class="col">
                                        <div class="progress progress-sm mr-2">
                                            <div class="progress-bar bg-info" role="progressbar" style="width: <?= $saldos['porcentagens']['setor1'] ?>%" aria-valuenow="<?= $saldos['porcentagens']['setor0'] ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>                            
                                    </div>                        
                                </div>     

                            </div>
                        </a>
                    </div>
                </div>                       
                
                <div class="col-12 p-0 mb-1">                    
                    <div class="card border-left-info shadow h-100">
                        <a href="/Dashboard/resumo/setor2" style="text-decoration: none" class="btn-light">    
                            <div class="card-body p-3">                        

                                <!-- Setor II - Info Gastos -->
                                <div class="d-flex justify-content-between pt-1">
                                    <div class="h5 font-weight-bold text-info text-uppercase">2 - Aeroporto</div>                                    
                                    <div class="h5 font-weight-bold text-gray-800">R$ <?= number_format($saldos['saldos']['setor2'], 2, ',', '.'); ?></div>
                                </div>
                                <!-- Setor II - Progress Bar -->                    
                                <div class="row no-gutters align-items-center mt-2">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-xs text-gray-800"><?= $saldos['porcentagens']['setor2']?> %</div>
                                        <div class="h5 m-0 mr-3 font-weight-bold text-xs text-gray-800">
                                            <i class="fa fa-share"></i>
                                            <?= $saldos['lancamentos']['setor2']?> lançamentos
                                        </div>                                    
                                    </div>
                                    <div class="col">
                                        <div class="progress progress-sm mr-2">
                                            <div class="progress-bar bg-info" role="progressbar" style="width: <?= $saldos['porcentagens']['setor2'] ?>%" aria-valuenow="<?= $saldos['porcentagens']['setor0'] ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>                            
                                    </div>                        
                                </div>      

                            </div>
                        </a>
                    </div>                    
                </div>                       
                
                <div class="col-12 p-0 mb-1">
                    <div class="card border-left-danger shadow h-100">
                        <a href="/Dashboard/resumo/setor3" style="text-decoration: none" class="btn-light">
                            <div class="card-body p-3">

                                <!-- Setor III - Info Gastos -->
                                <div class="d-flex justify-content-between pt-1">                                
                                    <div class="h5 p-0 font-weight-bold text-danger text-uppercase">3 - Bonsucesso</div>
                                    <div class="h5 m-0 p-0 font-weight-bold text-gray-800">R$ <?= number_format($saldos['saldos']['setor3'], 2, ',', '.'); ?></div>
                                </div>

                                <!-- Setor III - Progress Bar -->                    
                                <div class="row no-gutters align-items-center mt-2">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-xs text-gray-800"><?= $saldos['porcentagens']['setor3']?> %</div>
                                        <div class="h5 m-0 mr-3 font-weight-bold text-xs text-gray-800">
                                            <i class="fa fa-share"></i>
                                            <?= $saldos['lancamentos']['setor3']?> lançamentos
                                        </div>                                    
                                    </div>
                                    <div class="col">
                                        <div class="progress progress-sm mr-2">
                                            <div class="progress-bar bg-info" role="progressbar" style="width: <?= $saldos['porcentagens']['setor3'] ?>%" aria-valuenow="<?= $saldos['porcentagens']['setor0'] ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>                            
                                    </div>                        
                                </div>  

                            </div>
                        </a>
                    </div>
                </div>                        

                <div class="col-12 p-0 mb-1">
                    <div class="card border-left-warning shadow h-100">
                        <a href="/Dashboard/resumo/setor4" style="text-decoration: none" class="btn-light">
                            <div class="card-body p-3">

                                <!-- Setor IV - Info Gastos -->
                                <div class="d-flex justify-content-between pt-1">                                
                                    <div class="h5 p-0 font-weight-bold text-warning text-uppercase">4 - Pimentas</div>
                                    <div class="h5 m-0 p-0 font-weight-bold text-gray-800">R$ <?= number_format($saldos['saldos']['setor4'], 2, ',', '.'); ?></div>
                                </div>
                                <!-- Setor IV - Progress Bar -->                    
                                <div class="row no-gutters align-items-center mt-2">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-xs text-gray-800"><?= $saldos['porcentagens']['setor4']?> %</div>
                                        <div class="h5 m-0 mr-3 font-weight-bold text-xs text-gray-800">
                                            <i class="fa fa-share"></i>
                                            <?= $saldos['lancamentos']['setor4']?> lançamentos
                                        </div>                                    
                                    </div>
                                    <div class="col">
                                        <div class="progress progress-sm mr-2">
                                            <div class="progress-bar bg-info" role="progressbar" style="width: <?= $saldos['porcentagens']['setor4'] ?>%" aria-valuenow="<?= $saldos['porcentagens']['setor0'] ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>                            
                                    </div>                        
                                </div>                        

                            </div>
                        </a>
                    </div>
                </div>        
        
            </div>
            
        </div>
    
        <div class="col-8">
            <div class="mr-4">

                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Gráfico</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-pie">                            
                            <canvas id="myPieChart" -width="400" -height="400" -style="display: block; width: 486px; height: 253px;" -class="chartjs-render-monitor"></canvas>
                        </div>
                    </div>
                </div>        

            </div>
        </div>
        
    </div>

</div>

<script>
    
// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Pie Chart Example
var ctx = document.getElementById("myPieChart");
var myPieChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: ["Administração", "1 - Centro", "2 - Aeroporto", "3 - Bonsucesso", "4 - Pimentas"],
    datasets: [{
      data: [
        <?= $saldos['saldos']['setor0'] ?>, 
        <?= $saldos['saldos']['setor1'] ?>,
        <?= $saldos['saldos']['setor2'] ?>,
        <?= $saldos['saldos']['setor3'] ?>,
        <?= $saldos['saldos']['setor4'] ?>,
      ],
      backgroundColor: ['#0d6efd', '#1CC88A', '#36B9CC', '#dc3545', '#ffc107'],
      hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: true,
      caretPadding: 5,
    },
    legend: {
      display: true
    },
    cutoutPercentage: 50,
    responsive: true,
    title: {
        display: false,
        text: 'Chart'
    }
  },
});

    
</script>