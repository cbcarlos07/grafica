<?php

/**
 * Created by PhpStorm.
 * User: carlos.brito
 * Date: 17/02/2017
 * Time: 14:34
 */
include_once ("ConnectionFactory.class.php");

class FoneClienteDAO
{
     private $connection = null;

     public function insert (FoneCliente $foneCliente){
         $this->connection =  null;
         $teste = false;
         $this->connection = new ConnectionFactory();
         $this->connection->beginTransaction();
         try{
             $query = "INSERT INTO fone_cliente 
                      (CD_CLIENTE, NR_TELEFONE, OBS_TELEFONE, NM_CONTATO, CD_TIPO_CONTATO) 
                      VALUES 
                      (:cliente, :telefone, :observacao, :contato, :tipo )";

             $stmt = $this->connection->prepare($query);
             $stmt->bindValue(":cliente", $foneCliente->getCliente()->getCdCliente(), PDO::PARAM_INT);
             $stmt->bindValue(":telefone", $foneCliente->getNrTelefone(), PDO::PARAM_STR);
             $stmt->bindValue(":observacao", $foneCliente->getObsTelefone(), PDO::PARAM_STR);
             $stmt->bindValue(":contato", $foneCliente->getNmContato(), PDO::PARAM_STR);
             $stmt->bindValue(":tipo", $foneCliente->getTipoContato()->getCdTipoContato(), PDO::PARAM_INT);
             $stmt->execute();
             $this->connection->commit();
             $teste =  true;

             $this->connection =  null;
         }catch(PDOException $exception){
             echo "Erro: ".$exception->getMessage();
         }
         return $teste;
     }

    public function update (FoneCliente $foneCliente){

        $this->connection =  null;
        $teste = false;
        $this->connection = new ConnectionFactory();
        $this->connection->beginTransaction();
        try{
            $query = "UPDATE fone_cliente SET 
                       NR_TELEFONE = :telefone, OBS_TELEFONE = :observacao, 
                      NM_CONTATO = :contato, CD_TIPO_CONTATO = :tipo 
                      WHERE 
                      CD_CLIENTE = :cliente";
            $stmt = $this->connection->prepare($query);

            $stmt->bindValue(":cliente", $foneCliente->getCliente()->getCdCliente(), PDO::PARAM_INT);
            $stmt->bindValue(":telefone", $foneCliente->getNrTelefone(), PDO::PARAM_STR);
            $stmt->bindValue(":observacao", $foneCliente->getObsTelefone(), PDO::PARAM_STR);
            $stmt->bindValue(":tipo", $foneCliente->getTipoContato()->getCdTipoContato(), PDO::PARAM_INT);
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
            $query = "DELETE FROM fone_cliente WHERE CD_CLIENTE = :codigo";
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

    public function getList($cdcliente){
        require_once ("services/FoneClienteList.class.php");
        require_once ("beans/FoneCliente.class.php");
        include "beans/TipoContato.class.php";
        $this->connection = null;

        $this->connection = new ConnectionFactory();

        $foneClienteList = new FoneClienteList();

        try {

                $sql = "SELECT *
                          FROM fone_cliente E
                          INNER JOIN tipo_contato T ON E.CD_TIPO_CONTATO = T.CD_TIPO_CONTATO
                          WHERE E.CD_CLIENTE = :cliente
                          ";
                $stmt = $this->connection->prepare($sql);
                $stmt->bindValue(":cliente",$cdcliente , PDO::PARAM_INT);

            $stmt->execute();
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $foneCliente = new FoneCliente();
                $foneCliente->setCliente(new Cliente());
                $foneCliente->getCliente()->setCdCliente($row['CD_CLIENTE']);
                $foneCliente->setNrTelefone($row['NR_TELEFONE']);
                $foneCliente->setObsTelefone($row['OBS_TELEFONE']);
                $foneCliente->setTipoContato(new TipoContato());
                $foneCliente->getTipoContato()->setCdTipoContato($row['CD_TIPO_CONTATO']);
                $foneCliente->getTipoContato()->setDsTipoContato($row['DS_TIPO_CONTATO']);
                $foneClienteList->addFoneCliente($foneCliente);
            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $foneClienteList;
    }


}