<?php

require_once 'DAO/categoriaDAO.php';
UtilDAO::VerificarLogado();

if(isset($_POST['btnGravar'])){
    
    $nome = $_POST['novacategoria'];
    $objdao = new CategoriaDAO();
    
    $ret = $objdao->CadastrarCategoria($nome);

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

                        <h2>Nova Categoria </h2>
                        <h5>Aqui você poderá cadastrar todas as suas categoria </h5>

                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <form action="nova_categoria.php" method="post">
                <div class="form-group">
                    <label>Nome da categoria </label>
                    <input class="form-control" placeholder="Ex: Conta de luz" name="novacategoria" required />
                </div>
                <button class="btn btn-success" name="btnGravar">GRAVAR</button>

                </form><!--fechamento do formulario-->

            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>



</body>

</html>