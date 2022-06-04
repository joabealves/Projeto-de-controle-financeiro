
<?php

require_once 'DAO/categoriaDAO.php';
UtilDAO::VerificarLogado();

$dao = new categoriaDAO();

if (isset($_GET['cod']) && is_numeric($_GET['cod'])){

    $idCategoria = $_GET['cod'];

  
   $dados = $dao->DetalharCategoria($idCategoria);

   if(count($dados) == 0 ){
       //fazendo a validação do banco de dados para que o usuario nao modifique. 

    header ('loaction: consultar_categoria.php?ret=' . $ret); //aqui volta para a pagina consultar categoria
    exit;
   }


} 
else if(isset($_POST['btnSalvar'])){
    $idCategoria = $_POST['cod'];
    $nomecategoria = $_POST['nomecategoria'];

   $ret = $dao->AlterarCategoria($nomecategoria,$idCategoria);
   header('location:consultar_categoria.php?ret=' . $ret);// aqui vai para a pagina 
   exit;

}   //aqui fecha o salvar 
else if (isset($_POST['btnExcluir'])){
    $idCategoria = $_POST['cod'];

    $ret = $dao->ExcluirCategoria($idCategoria);

    header('location:consultar_categoria.php?ret='. $ret);
    exit;

} // aqui fecha o excluir    
else{
    header ('loaction:consultar_categoria.php?ret=' . $ret); //aqui volta para a pagina consultar categoria
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
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">

                    <?php include_once '_msg.php'?><!--aqui e a mansagem do texto-->
                    
                     <h2>Alterar</h2>   
                        <h5>Aqui você pode alterar ou excluir seu arquivo </h5>
                       
                    </div>
                </div>
                 <!-- /. ROW  -->
                 <hr />
                 <form action="alterar_categoria.php" method="post" >

                 <input  type="hidden" name="cod" value=<?=$dados[0]['id_categoria']?>><!--aqui 
                 fazemos a validação  da url para que nao possa alterar sem atualizar -->

                 <div class="form-group">
                    <label>Alterar </label>
 
                    <input class="form-control" placeholder="Ex: Combustível" id="nomecategoria" value="<?=$dados[0]['nome_categoria'] ?>"  name="nomecategoria" required />
               
                </div>
              
                <button class="btn btn-success" name="btnSalvar">SALVAR</button>
                <Button type="button" data-toggle="modal" data-target="#modalExcluir" class="btn btn-danger" >EXCLUIR</button>

                <div class="modal fade" id="modalExcluir" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Confirmação de Exclusão</h4>
                                        </div>
                                        <div class="modal-body">
                                          Deseja Realmete Excluir essa Categoria: <b><?= $dados[0]['nome_categoria'] ?></b>.
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                                            <button type="submit" name="btnExcluir"  class="btn btn-primary">Excluir</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                </form><!--aqui fecha o form -->


                </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
  
    
   
</body>
</html>
