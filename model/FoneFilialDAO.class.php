<?php

/**
 * Created by PhpStorm.
 * User: carlos.brito
 * Date: 17/02/2017
 * Time: 14:34
 */
include_once ("ConnectionFactory.class.php");

class FoneFilialDAO
{
     private $connection = null;

     public function insert (FoneFilial $foneFilial){
         $this->connection =  null;
         $teste = false;
         $this->connection = new ConnectionFactory();
         $this->connection->beginTransaction();
         try{
             $query = "INSERT INTO fone_filial 
                      (CD_FILIAL, NR_TELEFONE, OBS_TELEFONE, NM_CONTATO, CD_TIPO_CONTATO) 
                      VALUES 
                      (:filial, :telefone, :observacao, :contato, :tipo )";

             $stmt = $this->connection->prepare($query);
             $stmt->bindValue(":filial", $foneFilial->getFilial()->getCdFilial(), PDO::PARAM_INT);
             $stmt->bindValue(":telefone", $foneFilial->getNrTelefone(), PDO::PARAM_STR);
             $stmt->bindValue(":observacao", $foneFilial->getObsTelefone(), PDO::PARAM_STR);
             $stmt->bindValue(":contato", $foneFilial->getNmContato(), PDO::PARAM_STR);
             $stmt->bindValue(":tipo", $foneFilial->getTipoContato()->getCdTipoContato(), PDO::PARAM_INT);
             $stmt->execute();
             $this->connection->commit();
             $teste =  true;

             $this->connection =  null;
         }catch(PDOException $exception){
             echo "Erro: ".$exception->getMessage();
         }
         return $teste;
     }

    public function update (FoneFilial $foneFilial){

        $this->connection =  null;
        $teste = false;
        $this->connection = new ConnectionFactory();
        $this->connection->beginTransaction();
        try{
            $query = "UPDATE fone_filial SET 
                       NR_TELEFONE = :telefone, OBS_TELEFONE = :observacao, 
                      NM_CONTATO = :contato, CD_TIPO_CONTATO = :tipo 
                      WHERE 
                      CD_FILIAL = :filial";
            $stmt = $this->connection->prepare($query);

            $stmt->bindValue(":filial", $foneFilial->getFilial()->getCdFilial(), PDO::PARAM_INT);
            $stmt->bindValue(":telefone", $foneFilial->getNrTelefone(), PDO::PARAM_STR);
            $stmt->bindValue(":observacao", $foneFilial->getObsTelefone(), PDO::PARAM_STR);
            $stmt->bindValue(":contato", $foneFilial->getNmContato(), PDO::PARAM_STR);
            $stmt->bindValue(":tipo", $foneFilial->getTipoContato()->getCdTipoContato(), PDO::PARAM_INT);
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
            $query = "DELETE FROM fone_filial WHERE CD_FILIAL = :codigo";
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

    public function getList($cdfilial){
        require_once ("services/FoneFilialList.class.php");
        require_once ("beans/FoneFilial.class.php");
        include "beans/TipoContato.class.php";
        $this->connection = null;

        $this->connection = new ConnectionFactory();

        $foneFilialList = new FoneFilialList();

        try {

                $sql = "SELECT *
                          FROM fone_filial E
                          INNER JOIN tipo_contato T ON E.CD_TIPO_CONTATO = T.CD_TIPO_CONTATO
                          WHERE E.CD_FILIAL = :filial
                          ";
                $stmt = $this->connection->prepare($sql);
                $stmt->bindValue(":filial",$cdfilial , PDO::PARAM_INT);

            $stmt->execute();
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $foneFilial = new FoneFilial();
                $foneFilial->setFilial(new Filial());
                $foneFilial->getFilial()->setCdFilial($row['CD_FILIAL']);
                $foneFilial->setNrTelefone($row['NR_TELEFONE']);
                $foneFilial->setObsTelefone($row['OBS_TELEFONE']);
                $foneFilial->setNmContato($row['NM_CONTATO']);
                $foneFilial->setTipoContato(new TipoContato());
                $foneFilial->getTipoContato()->setCdTipoContato($row['CD_TIPO_CONTATO']);
                $foneFilial->getTipoContato()->setDsTipoContato($row['DS_TIPO_CONTATO']);
                $foneFilialList->addFoneFilial($foneFilial);
            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $foneFilialList;
    }


}