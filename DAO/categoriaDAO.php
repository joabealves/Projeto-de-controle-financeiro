<?php


require_once 'Conexao.php';
require_once 'UtilDAO.php';


class CategoriaDAO extends Conexao {

    public function CadastrarCategoria($nome){
        if(trim($nome)==''){
            return 0;
        }  
          //Criar uma variavel que recebera o obj de conexao retornado
          $conexao = parent::retornarConexao();
          //Criar uma variavel que guardara o comando SQL que DEVERA SER EXECUTADO
          $comando_sql =  'insert into tb_categoria(id_usuario, nome_categoria) values(?, ?)';
          //Criar um obj que sera configurado com todas as informações para ser levado para o Banco de Dados
          $sql = new PDOStatement();
          //Criar um obj SQL (cria na linha de cima) guardara o obj de conexão JUNTO como a preparação do comando que deverá ser executado
          $sql = $conexao->prepare($comando_sql);
          //Avalia de tem ? no $comando_sql. Se estiver, configura os bindValues
          $sql->bindValue(1, UtilDAO::CodigoLogado());
          $sql->bindValue(2, $nome);
          try {
              $sql->execute();
              return 1;
          } catch (Exception $ex) {
             echo $ex->getMessage();
              return -1;
          }
    }

    public function AlterarCategoria($nome,$idCategoria){


            if(trim($nome)==''|| $idCategoria==''){
                return 0;

            }
            $Conexao = parent::retornarConexao();

            $comando_sql = 'update tb_categoria
                          set nome_categoria = ?  
                          where id_categoria = ?
                          and id_usuario = ?';
        
           $sql =  new PDOStatement();

           $sql = $Conexao->prepare($comando_sql);

           $sql ->bindValue(1,$nome);
           $sql->bindValue(2,$idCategoria);
           $sql->bindValue(3,UtilDAO::CodigoLogado());

           try{
               $sql->execute();
                     return 1;

           }catch (exception $ex){
           
          echo $ex->getMessage();
                    return -1;
           }

    }
    public function ExcluirCategoria($idCategoria){

        if($idCategoria  == ''){
            return 0;
        }

        $Conexao =  parent::retornarConexao();

        $comando_sql = 'delete 
                        from tb_categoria 
                        where id_categoria = ?
                        and id_usuario = ?';
        
        $sql= new PDOStatement();
        $sql = $Conexao->prepare($comando_sql);

        $sql->bindValue(1,$idCategoria);

        $sql->bindValue(2,UtilDAO::CodigoLogado());

        try{
            $sql->execute();
            return 1;

        }catch(exception $ex){
            echo $ex->getMessage();
            return -4;
        }
        
    }
        
        public function ConsultarCategoria(){

        $Conexao = parent::retornarConexao();
        
        $comando_sql = 'select id_categoria, nome_categoria
                            from tb_categoria
                            where id_usuario= ?
                            order by nome_categoria ASC';

        $sql = new PDOStatement();

        $sql = $Conexao->prepare($comando_sql);

        $sql->bindValue(1, UtilDAO::CodigoLogado());

        $sql->setFetchMode(PDO::FETCH_ASSOC);//aqui e o modo de pesquisa 

        $sql->execute();

        return $sql->fetchAll();

    }// aqui estamos chama a funcão da categoria 
    public function DetalharCategoria($idCategoria){
        
        $Conexao = parent::retornarConexao();
        $comando_sql ='select id_categoria,
                                nome_categoria
                                from tb_categoria
                                where id_categoria=?
                                and id_usuario=?';
        // quando filtramos a pesquisa por id ele nao se repete e filtra apenas os dados .
        $sql = new PDOStatement();
        $sql = $Conexao->prepare($comando_sql);
        $sql->bindValue(1,$idCategoria);
        $sql->bindValue(2,UtilDAO::CodigoLogado());

        $sql->setFetchMode(PDO::FETCH_ASSOC);// modo de pesquisa

        $sql->execute();

        return $sql->fetchAll();


    }
}

?>
