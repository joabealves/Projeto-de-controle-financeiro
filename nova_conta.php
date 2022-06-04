<?php

require_once 'DAO/ContaDAO.php';
UtilDAO::VerificarLogado();

if(isset($_POST['btnGravar'])){
    $banco = $_POST['banco'];
    $agencia = $_POST['agencia'];
    $numeroconta=$_POST['numerocont'];
    $saldo = $_POST['saldo'];

    $objdao = new ContaDAO();

    $ret = $objdao->CadastroConta($banco,$agencia,$numeroconta,$saldo);

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


                    <?php include_once '_msg.php'?><!--aqui e a mansagem do texto-->

                        <h2> Nova empresa</h2>
                        <h5> Cadastre todas as suas contas </h5>

                    </div>

                </div>
                <!-- /. ROW  -->
                <hr />
         <form action="nova_conta.php" method="post">

                <div class="form-group">
                    <label>Nome do  banco* </label>
                    <input name="banco" class="form-control" placeholder=" Seu banco " />
                </div>
                <div class="form-group">
                    <label>Agência*</label>
                    <input name="agencia" class="form-control" placeholder=" Sua agência" />
                </div>
                
                <div class="form-group">
                    <label>Numero da conta*</label>
                    <input name="numerocont" class="form-control" placeholder=" Sua conta " />
                </div>

                <div class="form-group">
                    <label>Saldo*</label>
                    <input name="saldo" class="form-control" placeholder=" Seu saldo é: " />
                </div>
                <iv>
                <button class="btn btn-success" name="btnGravar">GRAVAR</button>

                
        </form><!--fechamento do formulario-->

            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->




</body>

</html>