<?php

require_once 'DAO/UsuarioDAO.php';
UtilDAO::VerificarLogado();

$objdao = new UsuarioDAO();

if(isset($_POST['btnGravar'])){
    $nome = $_POST['nome1'];
    $email = $_POST['email'];

    $ret = $objdao->GravarMeusDados($nome, $email);
}


$dados= $objdao->CarregarMeusDados();

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

                    <?php include_once '_msg.php'?><!--aqui e a mansagem do texto-->

                        <h2>Meus Dados</h2>
                        <h5>Nesta, página você poderar alterar seus dados </h5>

                    </div>

                </div>
                <!-- /. ROW  -->
                <hr />

                <form method="post" action="meus_dados.php">
                <div class="form-group">
                    <label>Nome </label>
                    <input class="form-control" placeholder="Digite seu nome..."  name="nome1" value="<?= $dados[0]['nome_usuario']?>" required />
                </div>
                <div class="form-group">
                    <label>E-mail</label>
                    <input class="form-control" placeholder="Digite Seu e-mail...." name="email" value="<?= $dados[0]['email_usuario']?>" required />
                </div>
                <button type="submit"  class="btn btn-success btn-lg" name="btnGravar">Gravar</button>
                </form><!--aqui fecha o form-->

                
             

            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->




</body>

</html>