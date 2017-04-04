<?php

/**
 * Created by PhpStorm.
 * User: carlos.brito
 * Date: 17/02/2017
 * Time: 14:34
 */
include_once ("ConnectionFactory.class.php");

class PaisDAO
{
     private $connection = null;

     public function insert (Pais $pais){
         $this->connection =  null;
         $teste = false;
         $this->connection = new ConnectionFactory();
         $this->connection->beginTransaction();
         try{
             $query = "INSERT INTO pais 
                       (CD_PAIS, DS_PAIS) VALUES (NULL, :pais)";

             $stmt = $this->connection->prepare($query);
             $stmt->bindValue(":pais", $pais->getDsPais(), PDO::PARAM_STR);
             $stmt->execute();
             $this->connection->commit();
             $teste =  true;

             $this->connection =  null;
         }catch(PDOException $exception){
             echo "Erro: ".$exception->getMessage();
         }
         return $teste;
     }

    public function update (Pais $pais){
        $this->connection =  null;
        $teste = false;
        $this->connection = new ConnectionFactory();
        $this->connection->beginTransaction();
        try{
            $query = "UPDATE pais SET
                      DS_PAIS = :pais WHERE CD_PAIS = :codigo";
            $stmt = $this->connection->prepare($query);
            $stmt->bindValue(":pais", $pais->getDsPais(), PDO::PARAM_STR);
            $stmt->bindValue(":codigo", $pais->getCdPais(), PDO::PARAM_INT);
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
        //echo "<script>alert(".$codigo.");</script>";
        try{
            $query = "DELETE FROM pais WHERE CD_PAIS = :codigo";
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
        require_once ("services/PaisList.class.php");
        require_once ("beans/Pais.class.php");

        $this->connection = null;

        $this->connection = new ConnectionFactory();

        $paisList = new PaisList();

        try {

                $sql = "SELECT * FROM pais WHERE DS_PAIS LIKE :nome";
                $stmt = $this->connection->prepare($sql);
                $stmt->bindValue(":nome", "%$nome%", PDO::PARAM_STR);

            $stmt->execute();
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $pais = new Pais();
                $pais->setCdPais($row['CD_PAIS']);
                $pais->setDsPais($row['DS_PAIS']);

                $paisList->addPais($pais);
            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $paisList;
    }

    public function getLista($nome){
        require_once ("../services/PaisList.class.php");
        require_once ("../beans/Pais.class.php");

        $this->connection = null;

        $this->connection = new ConnectionFactory();

        $paisList = new PaisList();

        try {

                $sql = "SELECT * FROM pais WHERE DS_PAIS LIKE :nome";
                $stmt = $this->connection->prepare($sql);
                $stmt->bindValue(":nome", "%$nome%", PDO::PARAM_STR);

            $stmt->execute();
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $pais = new Pais();
                $pais->setCdPais($row['CD_PAIS']);
                $pais->setDsPais($row['DS_PAIS']);

                $paisList->addPais($pais);
            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $paisList;
    }

    public function getPais($codigo){
        $pais = null;
        $connection = null;
        $this->connection =  new ConnectionFactory();
        $sql = "SELECT * FROM pais WHERE CD_PAIS = :codigo";

        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(":codigo", $codigo, PDO::PARAM_INT);
            $stmt->execute();
            if($row =  $stmt->fetch(PDO::FETCH_ASSOC)){
                $pais = new Pais();
                $pais->setCdPais($row['CD_PAIS']);
                $pais->setDsPais($row['DS_PAIS']);
            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $pais;
    }
}