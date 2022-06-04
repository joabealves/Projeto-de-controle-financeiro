<?php
require_once 'DAO/UsuarioDAO.php';

if(isset($_POST['btnFinalizar'])){
    $nome =$_POST['nome'];
    $email =$_POST['email'];
    $senha =$_POST['senha'];
    $rsenha =$_POST['rsenha'];

    $objdao = new UsuarioDAO();
    
    $ret = $objdao->CriarCadastro($nome, $email,$senha,$rsenha);
    
}


?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
include_once '_head.php';
?>

<body>
    <div class="container">
        <div class="row text-center  ">
            <div class="col-md-12">
                <br /><br />
                <?php 
                 require_once '_msg.php';
                ?>
                <h2> Controle Financeiro : Cadastro</h2>
               
                <h5>( Faça o seu cadastro! )</h5>
                 <br />
            </div>
        </div>
        <form action="cadastro.php" method="post">
         <div class="row">
               
                <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                        <strong>  Preencher Todos os Campos </strong>  
                            </div>
                            <div class="panel-body">
                                <form role="form">
                                        <br/>

                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-circle-o-notch"  ></i></span>
                                            <input name="nome" type="text" class="form-control" placeholder="Nome" />
                                        </div>
                                    
                                         <div class="form-group input-group">
                                            <span class="input-group-addon">@</span>
                                            <input name="email" type="text" class="form-control" placeholder="Seu E-mail" />
                                        </div>
                                      <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
                                            <input name="senha" type="password" class="form-control" placeholder="Criar senha(Mínimo 6 caracteres) " />
                                        </div>
                                     <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
                                            <input name="rsenha" type="password" class="form-control" placeholder="Confirme Senha" />
                                        </div>
                                     
                                     <button  name="btnFinalizar" class="btn btn-success "> Registrar !</button>
                                    <hr />
                                   Já Possui Cadastro ?  <a href="login.php" > Clique Aqui !</a>
                                    </form>
                            </div>
                           
                        </div>
                    </div>
                
                
        </div>
        </form><!--fechamento do formulario-->
    </div>


  
   
</body>
</html>
