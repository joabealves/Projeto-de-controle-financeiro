<?php

require_once 'DAO/EmpresaDAO.php';
UtilDAO::VerificarLogado();

if(isset($_POST['btnGravar'])){

    $nome = $_POST['empresa'];
    $endereco = $_POST['endereco'];
    $telefone = $_POST['telefone'];

    $objdao = new EmpresaDAO();    
    $ret = $objdao->CadastroEmpresa($nome, $telefone, $endereco);

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
                        <h5> Cadastre suas empresas </h5>

                    </div>

                </div>
                <!-- /. ROW  -->
                <hr />

        <form action="nova_empresa.php" method="post">
                <div class="form-group">
                    <label>Empresa * </label>
                    <input name="empresa" class="form-control" placeholder="  Didite o nome da empresa" />
                </div>
                <div class="form-group">
                    <label>Endereço</label>
                    <input name="endereco" class="form-control" placeholder="  Didite aqui.... (opcional)" />
                </div>
                
                <div class="form-group">
                    <label>Telefone</label>
                    <input name="telefone" class="form-control" placeholder=" (DDD) 99999-9999 " />
                </div>
                <iv>
                <button name="btnGravar" class="btn btn-success">GRAVAR</button>                
        </form><!--fechamento formulario-->

            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->




</body>

</html>