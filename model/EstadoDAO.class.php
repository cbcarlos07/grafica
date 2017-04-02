<?php

/**
 * Created by PhpStorm.
 * User: carlos.brito
 * Date: 17/02/2017
 * Time: 14:34
 */
include_once ("ConnectionFactory.class.php");

class EstadoDAO
{
     private $connection = null;

     public function insert (Estado $estado){
         $this->connection =  null;
         $teste = false;
         $this->connection = new ConnectionFactory();
         try{
             $query = "INSERT INTO estado 
                      (CD_ESTADO, NM_ESTADO, DS_UF, CD_PAIS) VALUES 
                      (NULL, :estado, :uf, :pais)";

             $stmt = $this->connection->prepare($query);
             $this->connection->beginTransaction();
             $stmt->bindValue(":estado", $estado->getNmEstado(), PDO::PARAM_STR);
             $stmt->bindValue(":uf", $estado->getDsUF(), PDO::PARAM_STR);
             $stmt->bindValue(":pais", $estado->getPais()->getCdPais(), PDO::PARAM_INT);
             $stmt->execute();
             $this->connection->commit();
             $teste =  true;

             $this->connection =  null;
         }catch(PDOException $exception){
             echo "Erro: ".$exception->getMessage();
         }
         return $teste;
     }

    public function update (Estado $estado){
        $this->connection =  null;
        $teste = false;
        $this->connection = new ConnectionFactory();
        $this->connection->beginTransaction();

        try{
            $query = "UPDATE estado SET 
                      NM_ESTADO = :estado, DS_UF = :uf, CD_PAIS = :pais
                      WHERE CD_ESTADO = :codigo";
            $stmt = $this->connection->prepare($query);
            $stmt->bindValue(":estado", $estado->getNmEstado(), PDO::PARAM_STR);
            $stmt->bindValue(":uf", $estado->getDsUF(), PDO::PARAM_STR);
            $stmt->bindValue(":pais", $estado->getPais()->getCdPais(), PDO::PARAM_INT);
            $stmt->bindValue(":codigo", $estado->getCdEstado(), PDO::PARAM_INT);
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
            $query = "DELETE FROM estado WHERE CD_ESTADO = :codigo";
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
        require_once ("services/EstadoList.class.php");
        require_once ("beans/Estado.class.php");
        require_once ("beans/Pais.class.php");

        $this->connection = null;

        $this->connection = new ConnectionFactory();

        $estadoList = new EstadoList();

        try {

                $sql = "SELECT E.*
                              ,P.DS_PAIS
                          FROM estado E
                          INNER JOIN pais P ON E.CD_PAIS = P.CD_PAIS
                          WHERE E.NM_ESTADO LIKE :nome
                          ORDER BY NM_ESTADO ASC";
                $stmt = $this->connection->prepare($sql);
                $stmt->bindValue(":nome", "%$nome%", PDO::PARAM_STR);

            $stmt->execute();
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $estado = new Estado();
                $estado->setCdEstado($row['CD_ESTADO']);
                $estado->setNmEstado($row['NM_ESTADO']);
                $estado->setDsUF($row['DS_UF']);
                $estado->setPais(new Pais());
                $estado->getPais()->setCdPais($row['CD_PAIS']);
                $estado->getPais()->setDsPais($row['DS_PAIS']);
                $estadoList->addEstado($estado);
            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $estadoList;
    }

    public function getLista($nome){
        require_once ("../services/EstadoList.class.php");
        require_once ("../beans/Estado.class.php");
        require_once ("../beans/Pais.class.php");

        $this->connection = null;

        $this->connection = new ConnectionFactory();

        $estadoList = new EstadoList();

        try {

            $sql = "SELECT E.*
                              ,P.DS_PAIS
                          FROM estado E
                          INNER JOIN pais P ON E.CD_PAIS = P.CD_PAIS
                          WHERE E.NM_ESTADO LIKE :nome
                          ORDER BY NM_ESTADO ASC";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(":nome", "%$nome%", PDO::PARAM_STR);

            $stmt->execute();
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $estado = new Estado();
                $estado->setCdEstado($row['CD_ESTADO']);
                $estado->setNmEstado($row['NM_ESTADO']);
                $estado->setDsUF($row['DS_UF']);
                $estado->setPais(new Pais());
                $estado->getPais()->setCdPais($row['CD_PAIS']);
                $estado->getPais()->setDsPais($row['DS_PAIS']);
                $estadoList->addEstado($estado);
            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $estadoList;
    }

    public function getEstado($codigo){
        require_once ("beans/Pais.class.php");
        $estado = null;
        $connection = null;
        $this->connection =  new ConnectionFactory();
        $sql = "SELECT E.*
                              ,P.DS_PAIS
                          FROM estado E
                          INNER JOIN pais P ON E.CD_PAIS = P.CD_PAIS
                          WHERE E.CD_ESTADO = :codigo";

        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(":codigo", $codigo, PDO::PARAM_INT);
            $stmt->execute();
            if($row =  $stmt->fetch(PDO::FETCH_ASSOC)){
                $estado = new Estado();
                $estado->setCdEstado($row['CD_ESTADO']);
                $estado->setNmEstado($row['NM_ESTADO']);
                $estado->setDsUF($row['DS_UF']);
                $estado->setPais(new Pais());
                $estado->getPais()->setCdPais($row['CD_PAIS']);
                $estado->getPais()->setDsPais($row['DS_PAIS']);
            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $estado;
    }
}