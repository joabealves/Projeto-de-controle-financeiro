<?php
require_once 'Conexao.php';
require_once 'UtilDAO.php';

class ContaDAO extends Conexao {

    public function CadastroConta($banco, $agencia, $numeroconta, $saldo)
    {
        if (ltrim(trim($banco)) == '' || ltrim(trim($agencia)) == '' || ltrim(trim($numeroconta)) == '' ) {
            return 0;
        }

        $conexao = parent::retornarConexao();
        $comando_sql = 'insert into tb_conta( banco_conta,
                         agencia_conta, numero_conta,
                          saldo_conta,id_usuario)
                         values (?, ?, ?, ?, ?)';
        $sql =  new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, $banco);
        $sql->bindValue(2, $agencia);
        $sql->bindValue(3, $numeroconta);
        $sql->bindValue(4, $saldo);
        $sql->bindValue(5,UtilDAO::CodigoLogado());
     

        try {
            $sql->execute();
            return 1;

        } catch (Exception $ex) {

            $ex->getMessage();
            return -1;
        }
    }   
    public function DetalharConta($idConta) {
        $conexao = parent::retornarConexao();
        $comando_sql = 'select id_conta,
                        banco_conta, 
                        agencia_conta,
                        numero_conta,
                        saldo_conta
                        from tb_conta
                        where id_conta = ?
                        and id_usuario =?';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, $idConta);       
        $sql->bindValue(2, UtilDAO::CodigoLogado());
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();
        return $sql->fetchAll();
    }
    public function AlterarConta($idConta, $banco, $agencia, $numero_conta, $saldo){
        if (ltrim(trim($banco)) == '' || ltrim(trim($agencia)) == '' || ltrim(trim($numero_conta)) == '' || ltrim(trim($saldo)) == '') {
            return 0;
        }
        $conexao = parent::retornarConexao();
        $comando_sql = 'update tb_conta
                        set banco_conta = ?, 
                        agencia_conta = ?,
                        numero_conta = ?,
                        saldo_conta = ?
                        where id_conta = ?
                        and id_usuario = ?';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, $idConta);                 
        $sql->bindValue(2, $banco);                 
        $sql->bindValue(3, $agencia);                 
        $sql->bindValue(4, $numero_conta);                 
        $sql->bindValue(5, $saldo);                 
        $sql->bindValue(6, UtilDAO::CodigoLogado()); 
        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            return -1;
        }                
    }
    public function ExcluirConta($idConta) {
        if ($idConta == '') {
            return 0;
       }
        $conexao = parent::retornarConexao();
        $comando_sql = 'delete from tb_conta
                        where id_conta = ?
                        and id_usuario = ?';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, $idConta);
        $sql->bindValue(2, UtilDAO::CodigoLogado());
        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            return -4;
        } 
    }
    public function ConsultarConta(){
        $conexao = parent::retornarConexao();

        $comando_sql = 'select id_conta, banco_conta, agencia_conta, numero_conta, saldo_conta
                        from tb_conta
                        where id_usuario = ?';
        $sql = new PDOStatement();

        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, UtilDAO::CodigoLogado());
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();
        return $sql->fetchAll();
    }
}
