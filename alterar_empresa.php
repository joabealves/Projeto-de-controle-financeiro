<?php

require_once 'DAO/EmpresaDAO.php';
UtilDAO::VerificarLogado();

$dao = new EmpresaDAO();

if (isset($_GET['cod']) && is_numeric($_GET['cod'])) {

    $idEmpresa = $_GET['cod'];

    $dados = $dao->DetalhaEmpresa($idEmpresa);

    if (count($dados) == 0) {
        header('location:consultar_empresa.php');
        exit;
    }
} else if (isset($_POST['btngravar'])) {
    $idEmp = $_POST['cod'];
    $Nomeempresa = $_POST['empresa'];
    $Telefoneempresa = $_POST['telefone'];
    $Enderecoempresa = $_POST['endereco'];

    $ret = $dao->AlterarEmpresa($idEmp, $Nomeempresa, $Telefoneempresa, $Enderecoempresa);

    header('location:consultar_empresa.php?ret=' . $ret);
    exit;

} else if (isset($_POST['btnExcluir'])) {
    $idEmpresa = $_POST['cod'];
    $ret = $dao->ExcluirEmpresa($idEmpresa);
    header ('location: consultar_empresa.php?ret='. $ret);
    exit;


    
} else {
    header('location:consultar_empresa.php');
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

                        <h2>Alterar empresa</h2>
                        <h5>Aqui você pode alterar ou excluir suas empresas </h5>

                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />

                <form action="alterar_empresa.php" method="post">
                    <input type="hidden" name="cod" value="<?= $dados[0]['id_empresa'] ?>">
                    <div class="form-group">
                        <label>Empresa * </label>
                        <input class="form-control" placeholder="Ex: hipermercado " required name="empresa" value="<?= $dados[0]['nome_empresa'] ?>" />
                    </div>

                    <div class="form-group">
                        <label>Telefone </label>
                        <input class="form-control" placeholder="Ex: (43) 99999-9999 " required name="telefone" value="<?= $dados[0]['telefone_empresa'] ?>" />
                    </div>

                    <div class="form-group">
                        <label>Endereço </label>
                        <input class="form-control" placeholder="Ex: Avevida Nº123  " required name="endereco" value="<?= $dados[0]['endereco_empresa'] ?>" />
                    </div>

                    <button name="btngravar" class="btn btn-success">GRAVAR</button>
                    <Button type="button" data-toggle="modal" data-target="#modalExcluir" class="btn btn-danger">EXCLUIR</button>


                    <div class="modal fade" id="modalExcluir" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel">Confirmação de Exclusão</h4>
                                </div>
                                <div class="modal-body">
                                    Deseja Realmete Excluir essa Empresa: <b><?= $dados[0]['nome_empresa'] ?></b>.
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                                    <button type="submit" name="btnExcluir" class="btn btn-primary">Excluir</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!--fechamteo do formulario-->
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>



</body>

</html>