<?php
require_once 'DAO/UsuarioDAO.php';

if(isset($_POST['btnAcessar'])){
    $email = $_POST['email1'];
    $senha = $_POST['senha1'];

    $objdao = new UsuarioDAO();
    
    $ret = $objdao->ValidarLogin($email, $senha);
    
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
   
<?php
include_once '_head.php';
?>
</head>
<body>
    <div class="container">
        <div class="row text-center ">
            <div class="col-md-12">
                <br /><br />
                <?php include_once '_msg.php'?>

                <h2>  Controle Financeiro</h2>
               
                <h5>( Login e Senha )</h5>
                 <br />
            </div>
        </div>
         <div class="row ">
               
                  <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                        <strong>   Acessar </strong>  
                            </div>

                        <form action="login.php" method="post">

                            <div class="panel-body">
                                <form role="form">

                               
                                       <br />

                                     <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-tag"  ></i></span>
                                            <input name="email1" type="text" class="form-control" placeholder="Your Username " />
                                        </div>
                                                                              <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
                                            <input name='senha1' type="password" class="form-control"  placeholder="Your Password" />
                                        </div>
                                    

                                        <button  name="btnAcessar" class="btn btn-primary "> Acessar </button>
                                             <hr />
                                     Caso não tenha cadastro ? <a href="cadastro.php">Clique Aqui ! </a>
                                </form>
                            </div>
                           
                        </div>
                    </div>
                
                
        </div>
    </div>



   
</body>
</html>
