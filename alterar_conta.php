<?php

require_once 'DAO/contaDAO.php';
UtilDAO::VerificarLogado();

$dao = new ContaDAO();



if (isset($_GET['cod']) && is_numeric($_GET['cod'])) {

    $idConta = $_GET['cod'];
    $dados = $dao->DetalharConta($idConta);
    if (count($dados) == 0) {
        header('location:consultar_conta.php');
        exit;
    }
} else if (isset($_POST['btnSalvar'])) {

    $idConta = $_POST['cod'];
    $banco = $_POST['banco'];
    $numero = $_POST['numero'];
    $agencia = $_POST['agencia'];
    $saldo = $_POST['saldo'];

    $ret = $dao->AlterarConta($idConta, $banco, $agencia, $numero, $saldo);

    header('location:consultar_conta.php?ret=' . $ret);
    exit;
} else if (isset($_POST['btnExcluir'])) {
    $idConta = $_POST['cod'];
    $ret = $dao->ExcluirConta($idConta);

    header('location: consultar_conta.php?ret=' . $ret);
    exit;
}
 else {
    header('loacation: consultar_conta.php');
    exit;
}

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

                        <h2> Alterar conta </h2>
                        <h5> Aqui você poderar alterar suas contas </h5>

                    </div>

                </div>
                <!-- /. ROW  -->
                <hr />

                <form action="alterar_conta.php" method="POST">
                    <input type="hidden" name="cod" value="<?= $dados[0]['id_conta'] ?>">

                    <div class="form-group">
                        <label>Nome do banco* </label>
                        <input class="form-control" placeholder=" Seu banco " id="banco" name="banco" value="<?= $dados[0]['banco_conta'] ?>" />
                    </div>
                    <div class="form-group">
                        <label>Agência*</label>
                        <input class="form-control" placeholder=" Sua agência" id="agencia" name="agencia" value="<?= $dados[0]['agencia_conta'] ?>" />
                    </div>

                    <div class="form-group">
                        <label>Numero da conta*</label>
                        <input class="form-control" placeholder=" Sua conta " id="numero" name="numero" value="<?= $dados[0]['numero_conta'] ?>" />
                    </div>

                    <div class="form-group">
                        <label>Saldo*</label>
                        <input class="form-control" placeholder=" Seu saldo é: " id="saldo" name="saldo" value="<?= $dados[0]['saldo_conta'] ?>" />
                    </div>
                    <iv>
                        <button class="btn btn-success" name="btnSalvar">GRAVAR</button>
                        <Button type="button" data-toggle="modal" data-target="#modalExcluir" class="btn btn-danger">EXCLUIR</button>


                        <div class="modal fade" id="modalExcluir" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title" id="myModalLabel">Confirmação de Exclusão</h4>
                                    </div>
                                    <div class="modal-body">
                                        Deseja Realmete Excluir a conta <b><?= $dados[0]['banco_conta'] ?>/ Agencia: <?= $dados[0]['agencia_conta'] ?> -Conta:<?= $dados[0]['numero_conta'] ?> ?</b>.
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                                        <button type="submit" name="btnExcluir" class="btn btn-primary">Excluir</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                </form>
                <!--formulario fecha aqui-->


            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->




</body>

</html>