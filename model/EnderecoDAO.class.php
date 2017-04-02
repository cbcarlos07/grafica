<?php

/**
 * Created by PhpStorm.
 * User: carlos.brito
 * Date: 17/02/2017
 * Time: 14:34
 */
include_once ("ConnectionFactory.class.php");

class EnderecoDAO
{
     private $connection = null;

     public function insert (Endereco $endereco){
         $this->connection =  null;
         $teste = false;
         $this->connection = new ConnectionFactory();
         $this->connection->beginTransaction();
         try{
             $query = "INSERT INTO endereco 
                       (DS_LOGRADOURO, CD_TP_LOGRADOURO, NR_CEP, CD_BAIRRO) 
                       VALUES 
                       (:logradouro, :tipo, :cep, :bairro)";

             $stmt = $this->connection->prepare($query);
             $stmt->bindValue(":logradouro", $endereco->getDsLogradouro(), PDO::PARAM_STR);
             $stmt->bindValue(":tipo", $endereco->getTpLogradouro()->getCdTpLogradouro(), PDO::PARAM_STR);
             $stmt->bindValue(":cep", $endereco->getNrCep(), PDO::PARAM_STR);
             $stmt->bindValue(":bairro", $endereco->getBairro()->getCdBairro(), PDO::PARAM_INT);
             $stmt->execute();
             $this->connection->commit();
             $teste =  true;

             $this->connection =  null;
         }catch(PDOException $exception){
             echo "Erro: ".$exception->getMessage();
         }
         return $teste;
     }

    public function update (Endereco $endereco){
        $this->connection =  null;
        $teste = false;
        $this->connection = new ConnectionFactory();
        $this->connection->beginTransaction();

        try{
            $query = "UPDATE endereco SET 
                        NR_CEP = :cep, DS_LOGRADOURO = :logradouro, CD_TP_LOGRADOURO = :tipo,  CD_BAIRRO = :bairro
                       WHERE 
                       CD_ENDERECO = :codigo";
            $stmt = $this->connection->prepare($query);
            $stmt->bindValue(":logradouro", $endereco->getDsLogradouro(), PDO::PARAM_STR);
            $stmt->bindValue(":tipo", $endereco->getTpLogradouro()->getCdTpLogradouro(), PDO::PARAM_INT);
            $stmt->bindValue(":cep", $endereco->getNrCep(), PDO::PARAM_STR);
            $stmt->bindValue(":bairro", $endereco->getBairro()->getCdBairro(), PDO::PARAM_INT);
            $stmt->bindValue(":codigo", $endereco->getCdEndereco(), PDO::PARAM_INT);
            $stmt->execute();
            $this->connection->commit();
            $teste =  true;

            $this->connection =  null;
        }catch(PDOException $exception){
            echo "Erro: ".$exception->getMessage();
        }
        return $teste;
    }

    public function delete ($codigo){
        $this->connection =  null;
        $teste = false;
        $this->connection = new ConnectionFactory();
        $this->connection->beginTransaction();
        try{
            $query = "DELETE FROM endereco WHERE CD_ENDERECO = :codigo";
            $stmt = $this->connection->prepare($query);
            $stmt->bindValue(":codigo", $codigo, PDO::PARAM_INT);
            $stmt->execute();
            $this->connection->commit();
            $teste =  true;

            $this->connection =  null;
        }catch(PDOException $exception){
            echo "Erro: ".$exception->getMessage();
        }
        return $teste;
    }

    public function getList($cep, $cidade){
        require_once ("services/EnderecoList.class.php");
        require_once ("beans/Endereco.class.php");
        require_once ("beans/Bairro.class.php");
        require_once ("beans/TpLogradouro.class.php");

        $this->connection = null;

        $this->connection = new ConnectionFactory();

        $enderecoList = new EnderecoList();

        try {
            if($cidade == 0){
                $sql = "SELECT E.*
                              ,B.NM_BAIRRO
                              ,L.DS_TP_LOGRADOURO
                        FROM endereco E
                        INNER JOIN bairro B ON B.CD_BAIRRO = E.CD_BAIRRO
                        INNER JOIN tp_logradouro L ON L.CD_TP_LOGRADOURO = E.CD_TP_LOGRADOURO
                        WHERE E.NR_CEP LIKE :cep
                        ORDER BY E.NR_CEP";
                $stmt = $this->connection->prepare($sql);
                $stmt->bindValue(":cep", "%$cep%", PDO::PARAM_STR);
            }else{
                $sql = "SELECT E.*
                              ,B.NM_BAIRRO
                              ,L.DS_TP_LOGRADOURO
                        FROM endereco E
                        INNER JOIN bairro B ON B.CD_BAIRRO = E.CD_BAIRRO
                        INNER JOIN tp_logradouro L ON L.CD_TP_LOGRADOURO = E.CD_TP_LOGRADOURO
                        WHERE E.NR_CEP LIKE :cep
                          AND B.CD_CIDADE = :cidade
                        ORDER BY E.NR_CEP";
                $stmt = $this->connection->prepare($sql);
                $stmt->bindValue(":cep", "%$cep%", PDO::PARAM_STR);
                $stmt->bindValue(":cidade", $cidade, PDO::PARAM_INT);
            }

            $stmt->execute();
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $endereco = new Endereco();
                $endereco->setCdEndereco($row['CD_ENDERECO']);
                $endereco->setDsLogradouro($row['DS_LOGRADOURO']);
                $endereco->setTpLogradouro(new TpLogradouro());
                $endereco->getTpLogradouro()->setCdTpLogradouro($row['CD_TP_LOGRADOURO']);
                $endereco->getTpLogradouro()->setDsTpLogradouro($row['DS_TP_LOGRADOURO']);
                $endereco->setNrCep($row['NR_CEP']);
                $endereco->setBairro(new Bairro());
                $endereco->getBairro()->setCdBairro($row['CD_BAIRRO']);
                $endereco->getBairro()->setNmBairro($row['NM_BAIRRO']);
                $enderecoList->addEndereco($endereco);
            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $enderecoList;
    }

    public function getEndereco($cep){
        require_once ("beans/Endereco.class.php");
        require_once ("beans/Bairro.class.php");
        require_once ("beans/TpLogradouro.class.php");
        require_once ("beans/Cidade.class.php");
        $endereco = null;
        $connection = null;
        $this->connection =  new ConnectionFactory();
        $sql = "SELECT E.*
                  ,B.NM_BAIRRO
                  ,L.DS_TP_LOGRADOURO
                  ,B.CD_CIDADE
            FROM endereco E
            INNER JOIN bairro B ON B.CD_BAIRRO = E.CD_BAIRRO
            INNER JOIN tp_logradouro L ON L.CD_TP_LOGRADOURO = E.CD_TP_LOGRADOURO
            WHERE E.CD_ENDERECO = :cep";

        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(":cep", $cep, PDO::PARAM_INT);
            $stmt->execute();
            if($row =  $stmt->fetch(PDO::FETCH_ASSOC)){
                $endereco = new Endereco();
                $endereco->setCdEndereco($row['CD_ENDERECO']);
                $endereco->setDsLogradouro($row['DS_LOGRADOURO']);
                $endereco->setTpLogradouro(new TpLogradouro());
                $endereco->getTpLogradouro()->setCdTpLogradouro($row['CD_TP_LOGRADOURO']);
                $endereco->getTpLogradouro()->setDsTpLogradouro($row['DS_TP_LOGRADOURO']);
                $endereco->setNrCep($row['NR_CEP']);
                $endereco->setBairro(new Bairro());
                $endereco->getBairro()->setCdBairro($row['CD_BAIRRO']);
                $endereco->getBairro()->setNmBairro($row['NM_BAIRRO']);
                $endereco->getBairro()->setCidade(new Cidade());
                $endereco->getBairro()->getCidade()->setCdCidade($row['CD_CIDADE']);
            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $endereco;
    }

    public function getEnderecoById($id){
        require_once ("../beans/Endereco.class.php");
        require_once ("../beans/Bairro.class.php");
        require_once ("../beans/TpLogradouro.class.php");
        require_once ("../beans/Cidade.class.php");
        $endereco = null;
        $connection = null;
        $this->connection =  new ConnectionFactory();
        $sql = "SELECT E.*
                  ,B.NM_BAIRRO
                  ,L.DS_TP_LOGRADOURO
                  ,B.CD_CIDADE
            FROM endereco E
            INNER JOIN bairro B ON B.CD_BAIRRO = E.CD_BAIRRO
            INNER JOIN tp_logradouro L ON L.CD_TP_LOGRADOURO = E.CD_TP_LOGRADOURO
            WHERE E.CD_ENDERECO = :CDENDERECO";

        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(":CDENDERECO", $id, PDO::PARAM_INT);
            $stmt->execute();
            if($row =  $stmt->fetch(PDO::FETCH_ASSOC)){
                $endereco = new Endereco();
                $endereco->setCdEndereco($row['CD_ENDERECO']);
                $endereco->setDsLogradouro($row['DS_LOGRADOURO']);
                $endereco->setTpLogradouro(new TpLogradouro());
                $endereco->getTpLogradouro()->setCdTpLogradouro($row['CD_TP_LOGRADOURO']);
                $endereco->getTpLogradouro()->setDsTpLogradouro($row['DS_TP_LOGRADOURO']);
                $endereco->setNrCep($row['NR_CEP']);
                $endereco->setBairro(new Bairro());
                $endereco->getBairro()->setCdBairro($row['CD_BAIRRO']);
                $endereco->getBairro()->setNmBairro($row['NM_BAIRRO']);
                $endereco->getBairro()->setCidade(new Cidade());
                $endereco->getBairro()->getCidade()->setCdCidade($row['CD_CIDADE']);
            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $endereco;
    }

    public function getEnderecoByCep($cep){
        require_once ("../beans/Endereco.class.php");
        require_once ("../beans/Bairro.class.php");
        require_once ("../beans/TpLogradouro.class.php");
        require_once ("../beans/Cidade.class.php");
        $endereco = null;
        $connection = null;
        $this->connection =  new ConnectionFactory();
        $sql = "SELECT E.*
                  ,B.NM_BAIRRO
                  ,L.DS_TP_LOGRADOURO
                  ,B.CD_CIDADE
            FROM endereco E
            INNER JOIN bairro B ON B.CD_BAIRRO = E.CD_BAIRRO
            INNER JOIN tp_logradouro L ON L.CD_TP_LOGRADOURO = E.CD_TP_LOGRADOURO
            WHERE E.NR_CEP = :cep";

        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(":cep", $cep, PDO::PARAM_INT);
            $stmt->execute();
            if($row =  $stmt->fetch(PDO::FETCH_ASSOC)){
                $endereco = new Endereco();
                $endereco->setCdEndereco($row['CD_ENDERECO']);
                $endereco->setDsLogradouro($row['DS_LOGRADOURO']);
                $endereco->setTpLogradouro(new TpLogradouro());
                $endereco->getTpLogradouro()->setCdTpLogradouro($row['CD_TP_LOGRADOURO']);
                $endereco->getTpLogradouro()->setDsTpLogradouro($row['DS_TP_LOGRADOURO']);
                $endereco->setNrCep($row['NR_CEP']);
                $endereco->setBairro(new Bairro());
                $endereco->getBairro()->setCdBairro($row['CD_BAIRRO']);
                $endereco->getBairro()->setNmBairro($row['NM_BAIRRO']);
                $endereco->getBairro()->setCidade(new Cidade());
                $endereco->getBairro()->getCidade()->setCdCidade($row['CD_CIDADE']);
            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $endereco;
    }
}