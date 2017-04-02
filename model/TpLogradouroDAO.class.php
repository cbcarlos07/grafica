<?php

/**
 * Created by PhpStorm.
 * User: carlos.brito
 * Date: 17/02/2017
 * Time: 14:34
 */
include_once ("ConnectionFactory.class.php");

class TpLogradouroDAO
{
     private $connection = null;

     public function insert (TpLogradouro $ppLogradouro){
         $this->connection =  null;
         $teste = false;
         $this->connection = new ConnectionFactory();
         $this->connection->beginTransaction();
         try{
             $query = "INSERT INTO tp_logradouro 
                      (DS_TP_LOGRADOURO) VALUES (:logradouro)";

             $stmt = $this->connection->prepare($query);
             $stmt->bindValue(":logradouro", $ppLogradouro->getDsTpLogradouro(), PDO::PARAM_STR);
             $stmt->execute();
             $this->connection->commit();
             $teste =  true;

             $this->connection =  null;
         }catch(PDOException $exception){
             echo "Erro: ".$exception->getMessage();
         }
         return $teste;
     }

    public function update (TpLogradouro $ppLogradouro){
        $this->connection =  null;
        $teste = false;
        $this->connection = new ConnectionFactory();
        $this->connection->beginTransaction();
        try{
            $query = "UPDATE tp_logradouro SET 
                      DS_TP_LOGRADOURO = :logradouro
                      WHERE CD_TP_LOGRADOURO = :codigo";
            $stmt = $this->connection->prepare($query);
            $stmt->bindValue(":logradouro", $ppLogradouro->getDsTpLogradouro(), PDO::PARAM_STR);
            $stmt->bindValue(":codigo", $ppLogradouro->getCdTpLogradouro(), PDO::PARAM_INT);
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
            $query = "DELETE FROM tp_logradouro WHERE CD_TP_LOGRADOURO = :codigo";
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

    public function getList($nome){
        require_once ("services/TpLogradouroList.class.php");
        require_once ("beans/TpLogradouro.class.php");

        $this->connection = null;

        $this->connection = new ConnectionFactory();

        $ppLogradouroList = new TpLogradouroList();

        try {

                $sql = "SELECT * FROM tp_logradouro WHERE DS_TP_LOGRADOURO LIKE :nome";
                $stmt = $this->connection->prepare($sql);
                $stmt->bindValue(":nome", "%$nome%", PDO::PARAM_STR);

            $stmt->execute();
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $ppLogradouro = new TpLogradouro();
                $ppLogradouro->setCdTpLogradouro($row['CD_TP_LOGRADOURO']);
                $ppLogradouro->setDsTpLogradouro($row['DS_TP_LOGRADOURO']);

                $ppLogradouroList->addTpLogradouro($ppLogradouro);
            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $ppLogradouroList;
    }

    public function getLista($nome){
        require_once ("../services/TpLogradouroList.class.php");
        require_once ("../beans/TpLogradouro.class.php");

        $this->connection = null;

        $this->connection = new ConnectionFactory();

        $ppLogradouroList = new TpLogradouroList();

        try {

            $sql = "SELECT * FROM tp_logradouro WHERE DS_TP_LOGRADOURO LIKE :nome";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(":nome", "%$nome%", PDO::PARAM_STR);

            $stmt->execute();
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $ppLogradouro = new TpLogradouro();
                $ppLogradouro->setCdTpLogradouro($row['CD_TP_LOGRADOURO']);
                $ppLogradouro->setDsTpLogradouro($row['DS_TP_LOGRADOURO']);

                $ppLogradouroList->addTpLogradouro($ppLogradouro);
            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $ppLogradouroList;
    }

    public function getTpLogradouro($codigo){
        $ppLogradouro = null;
        $connection = null;
        $this->connection =  new ConnectionFactory();
        $sql = "SELECT * FROM tp_logradouro WHERE CD_TP_LOGRADOURO = :codigo";

        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(":codigo", $codigo, PDO::PARAM_INT);
            $stmt->execute();
            if($row =  $stmt->fetch(PDO::FETCH_ASSOC)){
                $ppLogradouro = new TpLogradouro();
                $ppLogradouro->setCdTpLogradouro($row['CD_TP_LOGRADOURO']);
                $ppLogradouro->setDsTpLogradouro($row['DS_TP_LOGRADOURO']);
            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $ppLogradouro;
    }
}