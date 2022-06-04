<?php
require_once 'Conexao.php';
require_once 'UtilDAO.php';

class MovimentoDAO extends Conexao
{
    public function CadastroMovimento($tipo, $data, $valor, $empresa, $categoria, $conta, $obs)
    {
        if ($tipo == '' || ltrim(trim($data)) == '' || ltrim(trim($empresa)) == '' || ltrim(trim($categoria)) == '' || ltrim(trim($conta)) == '') {
            return 0;
        }
        $conexao = parent::retornarConexao();
        $comando_sql = 'insert into tb_movimento
                        ( 
                          tipo_movimento,
                          data_movimento,
                          valor_movimento,
                          obs_movimento,
                          id_empresa, 
                          id_conta,
                          id_categoria, 
                          id_usuario) 
                          values (?,?,?,?,?,?,?,?)';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
       
        $sql->bindValue(1, $tipo);
        $sql->bindValue(2, $data);
        $sql->bindValue(3, $valor);
        $sql->bindValue(4, $obs);
        $sql->bindValue(5, $empresa);
        $sql->bindValue(6, $conta);
        $sql->bindValue(7, $categoria);        
        $sql->bindValue(8, UtilDAO::CodigoLogado());

        $conexao->beginTransaction();

        try {
            //Insere na tabela MOVIMENTO
            $sql->execute();
            if ($tipo == 1) {
                $comando_sql = 'update tb_conta
                                set saldo_conta = saldo_conta + ?
                                where id_conta = ?';
            } elseif ($tipo == 2) {
                $comando_sql = 'update tb_conta
                                set saldo_conta = saldo_conta - ?
                                where id_conta = ?';
            }
            $sql = $conexao->prepare($comando_sql);
            $sql->bindValue(1, $valor);
            $sql->bindValue(2, $conta);

            //Atualiza o saldo da conta
            $sql->execute();
            $conexao->commit();
            return 1;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            $conexao->rollBack();
            return -1;
        }
    }
public function ExcluirMovimento($idMovimento, $idConta, $valor, $tipo){
    if($idMovimento == '' || $idConta == '' || $valor == '' || $tipo == '') {
        return 0;
    }
    $conexao = parent::retornarConexao();
    $comando_sql = 'delete from tb_movimento where id_movimento =  ?';
    $sql = new PDOStatement();
    $sql = $conexao->prepare($comando_sql);
    $sql->bindValue(1, $idMovimento);
    $conexao->beginTransaction();
    try {
        //Deleta o registro
        $sql->execute();
        if($tipo == 1){
            $comando_sql = 'update tb_conta 
                            set saldo_conta = saldo_conta - ?
                            where id_conta = ?';
        }else if($tipo == 2) {
            $comando_sql = 'update tb_conta 
                            set saldo_conta = saldo_conta + ?
                            where id_conta = ?';    
        }
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, $valor);
        $sql->bindValue(2, $idConta);
        //Atualiza o saldo 
        $sql->execute();

        $conexao->commit();

        return 1;
        
    } catch (Exception $ex) {
        $conexao->rollBack();
        echo $ex->getMessage();
        return -1;
    }

}
    public function FiltrarMovimento($tipo, $dt_inicial, $dt_final) {
        if(trim($dt_inicial) =='' || trim($dt_final) == '' ){
            return 0;            
        } 

        $conexao = parent::retornarConexao();

        $comando_sql = 'select  
                                id_movimento,                                
                                tipo_movimento,
                                date_format(data_movimento, "%d/%m/%Y") as data_movimento,
                                valor_movimento,
                                nome_categoria,
                                nome_empresa,
                                banco_conta,
                                numero_conta,
                                agencia_conta,
                                obs_movimento
                        from tb_movimento
                        inner join tb_categoria
                                on tb_categoria.id_categoria = tb_movimento.id_categoria
                        inner join tb_empresa
                                on tb_empresa.id_empresa = tb_empresa.id_empresa 
                       inner join tb_conta
                                on tb_conta.id_conta = tb_movimento.id_conta
                          where tb_movimento.id_usuario = ?
                          and tb_movimento.data_movimento between ? and ?';

        if($tipo != 0) {
            $comando_sql = $comando_sql . 'and tipo_movimento = ?';
        }
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, UtilDAO::CodigoLogado());
        $sql->bindValue(2, $dt_inicial);
        $sql->bindValue(3, $dt_final);
       

        if($tipo != 0 ) {

            $sql->bindValue(4, $tipo);
        }
        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql->execute();

        return $sql->fetchAll();
    }


    public function  TotalEntrada(){
        $conexao = parent::retornarConexao();
        $comando_sql ='select sum(valor_movimento) as total
                         from  tb_movimento
                         where tipo_movimento = 1
                         and id_usuario = ?';
        
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1,UtilDAO::CodigoLogado());
        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql-> execute();

        return $sql->fetchAll();




    }
    public function  TotalSaida(){
        $conexao = parent::retornarConexao();
        $comando_sql ='select sum(valor_movimento) as total
                         from  tb_movimento
                         where tipo_movimento = 2
                         and id_usuario = ?';
        
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1,UtilDAO::CodigoLogado());
        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql-> execute();

        return $sql->fetchAll();




    }

    public function ultimoslancamentos() {
       

        $conexao = parent::retornarConexao();


        $comando_sql = 'select  
                                id_movimento,                                
                                tipo_movimento,
                                date_format(data_movimento, "%d/%m/%Y") as data_movimento,
                                valor_movimento,
                                nome_categoria,
                                nome_empresa,
                                banco_conta,
                                numero_conta,
                                agencia_conta,
                                obs_movimento
                        from tb_movimento
                        inner join tb_categoria
                                on tb_categoria.id_categoria = tb_movimento.id_categoria
                        inner join tb_empresa
                                on tb_empresa.id_empresa = tb_empresa.id_empresa 
                       inner join tb_conta
                                on tb_conta.id_conta = tb_movimento.id_conta
                          
                        where tb_movimento.id_usuario = ?
                        order by  tb_movimento.id_movimento DESC limit 10 ';

        
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, UtilDAO::CodigoLogado());  

       
        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql->execute();
        
        return $sql->fetchAll();
    }
}
