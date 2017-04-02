<?php

/**
 * Created by PhpStorm.
 * User: carlos.brito
 * Date: 17/02/2017
 * Time: 14:34
 */
include_once ("ConnectionFactory.class.php");

class CidadeDAO
{
     private $connection = null;

     public function insert (Cidade $cidade){
         $this->connection =  null;
         $teste = false;
         $this->connection = new ConnectionFactory();
         $this->connection->beginTransaction();
         try{
             $query = "INSERT INTO cidade 
                       (NM_CIDADE, CD_ESTADO) 
                       VALUES 
                       (:cidade, :estado)";

             $stmt = $this->connection->prepare($query);
             $stmt->bindValue(":cidade", $cidade->getNmCidade(), PDO::PARAM_STR);
             $stmt->bindValue(":estado", $cidade->getEstado()->getCdEstado(), PDO::PARAM_INT);
             $stmt->execute();
             $this->connection->commit();
             $teste =  true;

             $this->connection =  null;
         }catch(PDOException $exception){
             echo "Erro: ".$exception->getMessage();
         }
         return $teste;
     }

    public function update (Cidade $cidade){
        $this->connection =  null;
        $teste = false;
        $this->connection = new ConnectionFactory();
        $this->connection->beginTransaction();
        try{
            $query = "UPDATE cidade SET 
                       NM_CIDADE =  :cidade, CD_ESTADO = :estado
                       WHERE CD_CIDADE = :codigo";
            $stmt = $this->connection->prepare($query);
            $stmt->bindValue(":cidade", $cidade->getNmCidade(), PDO::PARAM_STR);
            $stmt->bindValue(":estado", $cidade->getEstado()->getCdEstado(), PDO::PARAM_INT);
            $stmt->bindValue(":codigo", $cidade->getCdCidade(), PDO::PARAM_INT);
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
            $query = "DELETE FROM cidade WHERE CD_CIDADE = :codigo";
            $stmt = $this->connection->prepare($query);
            $stmt->bindValue(":codigo", $codigo, PDO::PARAM_INT);
            $stmt->execute();
            $this->connection->beginTransaction();
            $teste =  true;

            $this->connection =  null;
        }catch(PDOException $exception){
            echo "Erro: ".$exception->getMessage();
        }
        return $teste;
    }

    public function getList($nome){
        require_once ("services/CidadeList.class.php");
        require_once ("beans/Cidade.class.php");
        require_once ("beans/Estado.class.php");

        $this->connection = null;

        $this->connection = new ConnectionFactory();

        $cidadeList = new CidadeList();

        try {

                $sql = "SELECT C.*, E.NM_ESTADO
                        FROM cidade C 
                        INNER JOIN estado E ON C.CD_ESTADO = E.CD_ESTADO
                        WHERE C.NM_CIDADE LIKE :nome
                        ORDER BY C.NM_CIDADE ASC ";
                $stmt = $this->connection->prepare($sql);
                $stmt->bindValue(":nome", "%$nome%", PDO::PARAM_STR);


            $stmt->execute();
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $cidade = new Cidade();
                $cidade->setCdCidade($row['CD_CIDADE']);
                $cidade->setNmCidade($row['NM_CIDADE']);
                $cidade->setEstado(new Estado());
                $cidade->getEstado()->setCdEstado($row['CD_ESTADO']);
                $cidade->getEstado()->setNmEstado($row['NM_ESTADO']);

                $cidadeList->addCidade($cidade);
            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $cidadeList;
    }

    public function getLista($nome){
        require_once ("../services/CidadeList.class.php");
        require_once ("../beans/Cidade.class.php");
        require_once ("../beans/Estado.class.php");

        $this->connection = null;

        $this->connection = new ConnectionFactory();

        $cidadeList = new CidadeList();

        try {

            $sql = "SELECT C.*, E.NM_ESTADO
                        FROM cidade C 
                        INNER JOIN estado E ON C.CD_ESTADO = E.CD_ESTADO
                        WHERE C.NM_CIDADE LIKE :nome
                        ORDER BY C.NM_CIDADE ASC ";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(":nome", "%$nome%", PDO::PARAM_STR);


            $stmt->execute();
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $cidade = new Cidade();
                $cidade->setCdCidade($row['CD_CIDADE']);
                $cidade->setNmCidade($row['NM_CIDADE']);
                $cidade->setEstado(new Estado());
                $cidade->getEstado()->setCdEstado($row['CD_ESTADO']);
                $cidade->getEstado()->setNmEstado($row['NM_ESTADO']);

                $cidadeList->addCidade($cidade);
            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $cidadeList;
    }

    public function getCidade($codigo){
        require_once ("beans/Estado.class.php");
        $cidade = null;
        $connection = null;
        $this->connection =  new ConnectionFactory();
        $sql = "SELECT C.*, E.NM_ESTADO
                        FROM cidade C 
                        INNER JOIN estado E ON C.CD_ESTADO = E.CD_ESTADO
                        WHERE C.CD_CIDADE = :codigo";

        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(":codigo", $codigo, PDO::PARAM_INT);
            $stmt->execute();
            if($row =  $stmt->fetch(PDO::FETCH_ASSOC)){
                $cidade = new Cidade();
                $cidade->setCdCidade($row['CD_CIDADE']);
                $cidade->setNmCidade($row['NM_CIDADE']);
                $cidade->setEstado(new Estado());
                $cidade->getEstado()->setCdEstado($row['CD_ESTADO']);
                $cidade->getEstado()->setNmEstado($row['NM_ESTADO']);
            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $cidade;
    }
}