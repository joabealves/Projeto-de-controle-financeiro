<?php

require_once 'DAO/ContaDAO.php';
UtilDAO::VerificarLogado();

$dao = new ContaDAO();

$contas = $dao->ConsultarConta();


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


                        <h2>Consultar empresa</h2>
                        <h5>Consulte todas suas contas aqui </h5>

                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <!-- Advanced Tables -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        consultar
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Nome da conta</th>
                                        <th>Agência</th>
                                        <th>Numero da conta</th>
                                        <th>Saldo</th>
                                        <th>alterar conta</th>



                                    </tr>
                                </thead>
                                <tbody>

                                    <?php foreach ($contas as $item) { ?>
                                        <tr class="odd gradeX">
                                            <td><?= $item['banco_conta'] ?></td>
                                            <td><?= $item['agencia_conta'] ?></td>
                                            <td><?= $item['numero_conta'] ?></td>
                                            <td>R$ <?= $item['saldo_conta'] ?></td>
                                            <td> <a href="alterar_conta.php?cod=<?= $item['id_conta'] ?>" class="btn btn-warning btn-sm">Alterar</a> </td>



                                        </tr>
                                    <?php  } ?>


                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                <!--End Advanced Tables -->

            </div>



</body>

</html>