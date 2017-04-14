<?php

/**
 * Created by PhpStorm.
 * User: carlos.brito
 * Date: 17/02/2017
 * Time: 14:34
 */
include_once ("ConnectionFactory.class.php");

class FoneDepartamentoDAO
{
     private $connection = null;

     public function insert (FoneDepartamento $foneDepartamento){
         $this->connection =  null;
         $teste = false;
         $this->connection = new ConnectionFactory();
         $this->connection->beginTransaction();
         try{
             $query = "INSERT INTO fone_departamento 
                      (CD_DEPARTAMENTO, NR_TELEFONE, OBS_TELEFONE, NM_CONTATO, CD_TIPO_CONTATO) 
                      VALUES 
                      (:departamento, :telefone, :observacao, :contato, :tipo )";

             $stmt = $this->connection->prepare($query);
             $stmt->bindValue(":departamento", $foneDepartamento->getDepartamento()->getCdDepartamento(), PDO::PARAM_INT);
             $stmt->bindValue(":telefone", $foneDepartamento->getNrTelefone(), PDO::PARAM_STR);
             $stmt->bindValue(":observacao", $foneDepartamento->getObsTelefone(), PDO::PARAM_STR);
             $stmt->bindValue(":contato", $foneDepartamento->getNmContato(), PDO::PARAM_STR);
             $stmt->bindValue(":tipo", $foneDepartamento->getTipoContato()->getCdTipoContato(), PDO::PARAM_INT);
             $stmt->execute();
             $this->connection->commit();
             $teste =  true;

             $this->connection =  null;
         }catch(PDOException $exception){
             echo "Erro: ".$exception->getMessage();
         }
         return $teste;
     }

    public function update (FoneDepartamento $foneDepartamento){

        $this->connection =  null;
        $teste = false;
        $this->connection = new ConnectionFactory();
        $this->connection->beginTransaction();
        try{
            $query = "UPDATE fone_departamento SET 
                       NR_TELEFONE = :telefone, OBS_TELEFONE = :observacao, 
                      NM_CONTATO = :contato, CD_TIPO_CONTATO = :tipo 
                      WHERE 
                      CD_DEPARTAMENTO = :departamento";
            $stmt = $this->connection->prepare($query);

            $stmt->bindValue(":departamento", $foneDepartamento->getDepartamento()->getCdDepartamento(), PDO::PARAM_INT);
            $stmt->bindValue(":telefone", $foneDepartamento->getNrTelefone(), PDO::PARAM_STR);
            $stmt->bindValue(":observacao", $foneDepartamento->getObsTelefone(), PDO::PARAM_STR);
            $stmt->bindValue(":tipo", $foneDepartamento->getTipoContato()->getCdTipoContato(), PDO::PARAM_INT);
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
            $query = "DELETE FROM fone_departamento WHERE CD_DEPARTAMENTO = :codigo";
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

    public function getList($cddepartamento){
        require_once ("services/FoneDepartamentoList.class.php");
        require_once ("beans/FoneDepartamento.class.php");
        include "beans/TipoContato.class.php";
        $this->connection = null;

        $this->connection = new ConnectionFactory();

        $foneDepartamentoList = new FoneDepartamentoList();
      //  echo "Departamento: ".$cddepartamento;

        try {

                $sql = "SELECT *
                          FROM fone_departamento E
                          INNER JOIN tipo_contato T ON E.CD_TIPO_CONTATO = T.CD_TIPO_CONTATO
                          WHERE E.CD_DEPARTAMENTO = :departamento
                          ";
                $stmt = $this->connection->prepare($sql);
                $stmt->bindValue(":departamento",$cddepartamento , PDO::PARAM_INT);

            $stmt->execute();
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $foneDepartamento = new FoneDepartamento();
                $foneDepartamento->setDepartamento(new Departamento());
                $foneDepartamento->getDepartamento()->setCdDepartamento($row['CD_DEPARTAMENTO']);
                $foneDepartamento->setNrTelefone($row['NR_TELEFONE']);
                $foneDepartamento->setObsTelefone($row['OBS_TELEFONE']);
                $foneDepartamento->setTipoContato(new TipoContato());
                $foneDepartamento->getTipoContato()->setCdTipoContato($row['CD_TIPO_CONTATO']);
                $foneDepartamento->getTipoContato()->setDsTipoContato($row['DS_TIPO_CONTATO']);
                $foneDepartamentoList->addFoneDepartamento($foneDepartamento);
            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $foneDepartamentoList;
    }


}