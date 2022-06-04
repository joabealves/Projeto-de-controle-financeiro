<?php

require_once 'DAO/UtilDAO.php';
UtilDAO::VerificarLogado();
require_once 'DAO/MovimentoDAO.php';

$DAO = new MovimentoDAO();

$total_entrada =$DAO->TotalEntrada();
$total_saida =$DAO->TotalSaida();
$movs = $DAO->ultimoslancamentos();


//verificar dados dentro do array.
//echo '<pre>';
//print_r($dados);
//echo '</pre>';
?>





<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
include_once '_head.php';

?>


<body>
    <div id="wrapper">
        <?php
        include_once '_top.php';
        include_once '_menu.php';

        ?>

        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">

                        <?php include_once '_msg.php' ?>
                        <!--aqui e a mansagem do texto-->

                        <h2>Página inicial</h2>
                        <h5>Aqui você acompanha todos os 10 ultimos seus lançamentos </h5>

                    </div>

                </div>
                <!-- /. ROW  -->
                <hr />
                <div class="col-md-6 ">
                    <div class="panel panel-primary text-center no-boder bg-color-green">
                        <div class="panel-body">
                            <i class="fa fa-bar-chart-o fa-5x"></i>
                            <h3><?=$total_entrada[0]['total'] != null ?   number_format( $total_entrada[0]['total'] , 2, ',','.') : '0'?></h3>
                        </div>
                        <div class="panel-footer back-footer-green">
                            Total de entrada 
                        </div>
                    </div>
                </div>
                <div class="col-md-6 ">
                    <div class="panel panel-primary text-center no-boder bg-color-red">
                        <div class="panel-body">
                        <i class="fa fa-bar-chart-o fa-5x"></i>
                            <h3><?=$total_saida[0]['total'] != '' ?   number_format( $total_saida[0]['total'] , 2, ',','.') : '0' ?></h3>
                        </div>
                        <div class="panel-footer back-footer-red">
                            Total de saída
                        </div>
                    </div>

                </div>

                <hr>

                <?php if (count($movs) > 0) {  ?>
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Advanced Tables -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                 Últimos 10 lançamentos do Movimento
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>Data</th>
                                                    <th>Tipo</th>
                                                    <th>Categoria</th>
                                                    <th>Empresa</th>
                                                    <th>Conta</th>
                                                    <th>Valor</th>
                                                    <th>Observação</th>
                                                   
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                
                                                $total= 0;
                                                for ($i = 0; $i < count($movs); $i++) {
                                                    if ($movs[$i]['tipo_movimento'] == 1) {
                                                        $total = $total + $movs[$i]['valor_movimento'];
                                                    } else {
                                                        $total = $total - $movs[$i]['valor_movimento'];
                                                    }
                                                {?>                                            
                                                
                                                
                                                    <tr class="odd gradeX">
                                                        <td><?= $movs[$i]['data_movimento'] ?></td>
                                                        <td><?= $movs[$i]['tipo_movimento'] == 1 ? 'Entrada' : 'Saída' ?></td>
                                                        <td><?= $movs[$i]['nome_categoria'] ?></td>
                                                        <td><?= $movs[$i]['nome_empresa'] ?></td>
                                                        <td><?= $movs[$i]['banco_conta'] ?> /  Ag. <?= $movs[$i]['agencia_conta']?> - Núm. <?= $movs[$i]['numero_conta']?></td>
                                                        <td>R$ <?= number_format($movs[$i]['valor_movimento'], 2, ',', '.') ?></td>
                                                        <td><?= $movs[$i]['obs_movimento'] ?></td>

                                                        
                                                       
                                                       </tr>
                                                    <?php }?>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                        <center>
                                            <label style="color: <?= $total < 0 ? 'red' : 'green' ?>;">TOTAL: R$ <?= number_format($total, 2, ',', '.') ?></label>
                                        </center>
                                    </div>

                                </div>
                            </div>
                            <!--End Advanced Tables -->
                        </div>
                    </div>
                <?php } else {?>

                         <div class= "alert alert-info col-md-12">
                             Não existe nenhum movimento para ser exibido.
                         </div>

                    <?php }?>





            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->




</body>

</html>