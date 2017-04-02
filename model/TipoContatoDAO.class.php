<?php

/**
 * Created by PhpStorm.
 * User: carlos.brito
 * Date: 17/02/2017
 * Time: 14:34
 */
include_once ("ConnectionFactory.class.php");

class TipoContatoDAO
{
     private $connection = null;

     public function insert (TipoContato $tipoContato){
         $this->connection =  null;
         $teste = false;
         $this->connection = new ConnectionFactory();
         $this->connection->beginTransaction();
         try{
             $query = "INSERT INTO tipo_contato 
                      (CD_TIPO_CONTATO, DS_TIPO_CONTATO) VALUES 
                      (NULL, :tipoContato )";

             $stmt = $this->connection->prepare($query);
             $stmt->bindValue(":tipoContato", $tipoContato->getDsTipoContato(), PDO::PARAM_STR);
             $stmt->execute();
             $this->connection->commit();
             $teste =  true;

             $this->connection =  null;
         }catch(PDOException $exception){
             echo "Erro: ".$exception->getMessage();
         }
         return $teste;
     }

    public function update (TipoContato $tipoContato){
        $this->connection =  null;
        $teste = false;
        $this->connection = new ConnectionFactory();
        $this->connection->beginTransaction();
        try{
            $query = "UPDATE tipo_contato SET 
                      DS_TIPO_CONTATO = :tipoContato
                      WHERE CD_TIPO_CONTATO = :codigo";
            $stmt = $this->connection->prepare($query);
            $stmt->bindValue(":tipoContato", $tipoContato->getDsTipoContato(), PDO::PARAM_STR);
            $stmt->bindValue(":codigo", $tipoContato->getCdTipoContato(), PDO::PARAM_INT);
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
            $query = "DELETE FROM tipo_contato WHERE CD_TIPO_CONTATO = :codigo";
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
        require_once ("services/TipoContatoList.class.php");
        require_once ("beans/TipoContato.class.php");

        $this->connection = null;

        $this->connection = new ConnectionFactory();

        $tipoContatoList = new TipoContatoList();

        try {

                $sql = "SELECT *
                          FROM tipo_contato E
                          WHERE E.DS_TIPO_CONTATO LIKE :nome";
                $stmt = $this->connection->prepare($sql);
                $stmt->bindValue(":nome", "%$nome%", PDO::PARAM_STR);

            $stmt->execute();
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $tipoContato = new TipoContato();
                $tipoContato->setCdTipoContato($row['CD_TIPO_CONTATO']);
                $tipoContato->setDsTipoContato($row['DS_TIPO_CONTATO']);
                $tipoContatoList->addTipoContato($tipoContato);
            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $tipoContatoList;
    }

    public function getLista($nome){
        require_once ("../services/TipoContatoList.class.php");
        require_once ("../beans/TipoContato.class.php");

        $this->connection = null;

        $this->connection = new ConnectionFactory();

        $tipoContatoList = new TipoContatoList();

        try {

            $sql = "SELECT *
                          FROM tipo_contato E
                          WHERE E.DS_TIPO_CONTATO LIKE :nome";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(":nome", "%$nome%", PDO::PARAM_STR);

            $stmt->execute();
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $tipoContato = new TipoContato();
                $tipoContato->setCdTipoContato($row['CD_TIPO_CONTATO']);
                $tipoContato->setDsTipoContato($row['DS_TIPO_CONTATO']);
                $tipoContatoList->addTipoContato($tipoContato);
            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $tipoContatoList;
    }

    public function getTipoContato($codigo){
        $tipoContato = null;
        $connection = null;
        $this->connection =  new ConnectionFactory();
        $sql = "SELECT *
                          FROM tipo_contato E
                          WHERE E.CD_TIPO_CONTATO = :codigo";

        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(":codigo", $codigo, PDO::PARAM_INT);
            $stmt->execute();
            if($row =  $stmt->fetch(PDO::FETCH_ASSOC)){
                $tipoContato = new TipoContato();
                $tipoContato->setCdTipoContato($row['CD_TIPO_CONTATO']);
                $tipoContato->setDsTipoContato($row['DS_TIPO_CONTATO']);
            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $tipoContato;
    }
}