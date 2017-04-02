<?php

/**
 * Created by PhpStorm.
 * User: carlos.brito
 * Date: 17/02/2017
 * Time: 14:34
 */
include_once ("ConnectionFactory.class.php");

class ZonaDAO
{
     private $connection = null;

     public function insert (Zona $zona){
         $this->connection =  null;
         $teste = false;
         $this->connection = new ConnectionFactory();
         $this->connection->beginTransaction();
         try{
             $query = "INSERT INTO zona 
                      (CD_ZONA, DS_ZONA) VALUES 
                      (NULL, :zona )";

             $stmt = $this->connection->prepare($query);
             $stmt->bindValue(":zona", $zona->getDsZona(), PDO::PARAM_STR);
             $stmt->execute();
             $this->connection->commit();
             $teste =  true;

             $this->connection =  null;
         }catch(PDOException $exception){
             echo "Erro: ".$exception->getMessage();
         }
         return $teste;
     }

    public function update (Zona $zona){
        $this->connection =  null;
        $teste = false;
        $this->connection = new ConnectionFactory();
        $this->connection->beginTransaction();
        try{
            $query = "UPDATE zona SET 
                      DS_ZONA = :zona
                      WHERE CD_ZONA = :codigo";
            $stmt = $this->connection->prepare($query);
            $stmt->bindValue(":zona", $zona->getDsZona(), PDO::PARAM_STR);
            $stmt->bindValue(":codigo", $zona->getCdZona(), PDO::PARAM_INT);
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
            $query = "DELETE FROM zona WHERE CD_ZONA = :codigo";
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
        require_once ("services/ZonaList.class.php");
        require_once ("beans/Zona.class.php");

        $this->connection = null;

        $this->connection = new ConnectionFactory();

        $zonaList = new ZonaList();

        try {

                $sql = "SELECT *
                          FROM zona E
                          WHERE E.DS_ZONA LIKE :nome";
                $stmt = $this->connection->prepare($sql);
                $stmt->bindValue(":nome", "%$nome%", PDO::PARAM_STR);

            $stmt->execute();
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $zona = new Zona();
                $zona->setCdZona($row['CD_ZONA']);
                $zona->setDsZona($row['DS_ZONA']);
                $zonaList->addZona($zona);
            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $zonaList;
    }

    public function getLista($nome){
        require_once ("../services/ZonaList.class.php");
        require_once ("../beans/Zona.class.php");

        $this->connection = null;

        $this->connection = new ConnectionFactory();

        $zonaList = new ZonaList();

        try {

            $sql = "SELECT *
                          FROM zona E
                          WHERE E.DS_ZONA LIKE :nome";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(":nome", "%$nome%", PDO::PARAM_STR);

            $stmt->execute();
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $zona = new Zona();
                $zona->setCdZona($row['CD_ZONA']);
                $zona->setDsZona($row['DS_ZONA']);
                $zonaList->addZona($zona);
            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $zonaList;
    }

    public function getZona($codigo){
        $zona = null;
        $connection = null;
        $this->connection =  new ConnectionFactory();
        $sql = "SELECT *
                          FROM zona E
                          WHERE E.CD_ZONA = :codigo";

        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(":codigo", $codigo, PDO::PARAM_INT);
            $stmt->execute();
            if($row =  $stmt->fetch(PDO::FETCH_ASSOC)){
                $zona = new Zona();
                $zona->setCdZona($row['CD_ZONA']);
                $zona->setDsZona($row['DS_ZONA']);
            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $zona;
    }
}