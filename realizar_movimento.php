<?php

require_once 'DAO/MovimentoDAO.php';
require_once 'DAO/categoriaDAO.php';
require_once 'DAO/EmpresaDAO.php';
require_once 'DAO/ContaDAO.php';
UtilDAO::VerificarLogado();

$objconta = new ContaDAO();
$objEmpresa = new EmpresaDAO();
$daocat = new CategoriaDAO();


//CADASTRO MOVIMENTO
if (isset($_POST['btnLancar'])) {

    $tipo = $_POST['tipo'];

    $data = $_POST['data'];

    $valor = $_POST['valor'];

    $empresa = $_POST['empresa'];

    $categoria = $_POST['categoria'];

    $conta = $_POST['conta'];

    $obs = $_POST['obs'];

    $objdao = new MovimentoDAO();

    $ret = $objdao->CadastroMovimento($tipo, $data, $valor, $empresa, $categoria, $conta, $obs);
    
}

$conta = $objconta->ConsultarConta();
$empresa = $objEmpresa->ConsultarEmpresa();
$categorias = $daocat->ConsultarCategoria();


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


                        <h2> Realizar Movimento</h2>
                        <h5> Aqui você poderar realizar seus movimentos </h5>

                    </div>

                </div>
                <!-- /. ROW  -->
                <hr />

                <form action="realizar_movimento.php" method="post">

                    <div class="col-md-6 ">
                        <div class="form-group">
                            <label>Tipo do movimento*</label>

                            <select class="form-control" name="tipo">
                                <option value="" >TODOS</option>
                                <option value="1" >Entrada</option>
                                <option value="2" >Saída</option>
                            </select>
                            
                        </div>
                        <div class="form-group " id="divData">
                            <label>Data</label>
                            <input type="date" name="data" class="form-control" placeholder=" Data " />
                        </div>

                        <div class="form-group" id="divValor">
                            <label>Valor*</label>
                            <input name="valor" id="valor" class="form-control" placeholder=" Seu valor " />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group" id="divEmpresa">
                            <label>Empresa*</label>
                            <select name="empresa" class="form-control">

                                <option selected>Selecione</option>

                                <?php foreach ($empresa as $item) { ?>
                                    <option value="<?= $item['id_empresa']?>">

                                    <?= $item['nome_empresa'] ?> 

                                    </option><!--aqui fecha a option-->

                                <?php } ?>

                            </select>
                        </div>
                        <div class="form-group">


                            <label>Categoria*</label>
                            <select name="categoria" class="form-control ">
                                <option selected>Selecione</option>

                                <?php foreach ($categorias as $item) { ?>
                                    <option value="<?= $item['id_categoria']?>">  

                                        <?= $item['nome_categoria'] ?> 

                                    </option><!--aqui fecha a option-->
                                <?php } ?>

                            </select>
                        </div>
                        <div class="form-group">
                            <label>Conta*</label>
                            <select name="conta" class="form-control">

                                <option selected>Selecione</option>

                                <?php foreach ($conta as $item) { ?>
                                    <option value="<?= $item['id_conta'] ?>">
                                    <?= 'Banco' . $item['banco_conta']. 'Agência:'. $item['agencia_conta'] . '/ Número' .$item['numero_conta'] . '- Saldo: R$' . $item['saldo_conta']?>
                                        </option><!--aqui fecha a option-->
                                <?php } ?>

                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">

                        <div class="form-group">
                            <label>Observação</label>
                            <textarea name="obs" class="form-control" rows="5" placeholder="Digite aqui sua observações  "></textarea>
                        </div>

                        <iv>
                            <center>
                                <button name="btnLancar" class="btn btn-success">Lançar</button>
                            </center>
                    </div>
                </form>
                <!--fechamento formulario-->


            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->




</body>

</html>