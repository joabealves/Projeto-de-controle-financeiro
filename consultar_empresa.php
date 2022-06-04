<?php
require_once 'DAO/EmpresaDAO.php';
UtilDAO::VerificarLogado();

$objdao= new EmpresaDAO();
$empresas = $objdao->ConsultarEmpresa();

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

                     <h2>Consultar empresa</h2>   
                        <h5>Consulte todas as suas empresas </h5>
                       
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
                                            <th>Nome da empresa</th>
                                            <th>Endereço</th>
                                            <th>Telefone</th>
                                            <th>alterar</th>
                                            

                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php  foreach($empresas as $item) {?>

                                        <tr class="odd gradeX">
                                            <td><?= $item['nome_empresa']?></td>
                                            <td><?= $item['endereco_empresa']?></td>
                                            <td><?= $item['telefone_empresa']?></td>
                                           <td> <a href="alterar_empresa.php?cod=<?= $item['id_empresa']?>" class="btn btn-warning btn-sm">Alterar</a> </td>
                                           
                                    <?php } ?>              
                                            
                                           
                                            
                                        </tr>
                                                                         
                                       
                                        
                                    </tbody>
                                </table>
                            </div>                            
                        </div>
                    </div>
                    <!--End Advanced Tables -->
               
    </div>
        
    
   
</body>
</html>
