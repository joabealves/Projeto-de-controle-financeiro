<?php

// estamos verificamos se existe parametros passado pela url 

if(isset($_GET['ret'])){
    $ret = $_GET['ret'];
}


if (isset($ret)){

    switch($ret){
        case 0:
        echo'<div class= "alert alert-warning">
            Preencher o(s) campo(s) obrigatorio(s)
            </div>';
            break;
        case 1:
            echo'<div class= "alert alert-success">
            Ação realizada com sucesso
            </div>';
            break;
     case -1:
            echo'<div class= "alert alert-danger">
            Ocorreu um erro na operação. Tente mais tarde!
            </div>';
            break;
     case -2:
           echo'<div class= "alert alert-danger">
           A senha deverar conter no mínimo 6 caracteres
           </div>';
           break;
    case -3:
            echo'<div class= "alert alert-danger">
            A senha e o Repetir senha não  conferem
            </div>';
            break;
   case -4:
                echo'<div class= "alert alert-danger">
               O regitro não poderá ser excluido pois está em uso!
                </div>';
                break;
 case -5:
         echo'<div class= "alert alert-danger">
               Email já cadastrado !
               </div>';
          break;          
 case -6:
            echo'<div class= "alert alert-danger">
                  Usuario não encontrado !
                  </div>';
             break;  
                        

    }
}