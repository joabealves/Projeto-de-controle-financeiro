<?php

require_once 'DAO/CategoriaDAO.php';
UtilDAO::VerificarLogado();

$dao = new CategoriaDAO(); 

$categorias = $dao->ConsultarCategoria();

// vizualizar como ele esta se comportando  verificar a formatação.
    //echo '<pre>';
   // print_r($categorias);
   // echo '</pre>';

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

                     <h2>Consultar categoria</h2>   
                        <h5>Consulte todas as suas categorias aqui </h5>
                       
                    </div>
                </div>
                 <!-- /. ROW  -->
                 <hr />
                  <!-- Advanced Tables -->
                  <div class="panel panel-default">
                        <div class="panel-heading">
                             Categorias, Caso deseja altera, clique no botão
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Nome da categoria</th>
                                            <th>Ação</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php for($i=0 ; $i<count($categorias); $i++ ){ ?>


                                        <tr class="odd gradeX">
                                            <td><?= $categorias[$i]['nome_categoria']  ?></td>
                                            <td>                                    
                                            <a href="alterar_categoria.php?cod= <?= $categorias[$i]['id_categoria']?>"  class="btn btn-success">Alterar</a>
                                            </td>
                                        </tr>
                                    
                                    <?php }?>
                                        
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                    </div>
                    <!--End Advanced Tables -->
               
    </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
    
   
</body>
</html>
