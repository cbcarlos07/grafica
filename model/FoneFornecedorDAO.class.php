<?php

/**
 * Created by PhpStorm.
 * User: carlos.brito
 * Date: 17/02/2017
 * Time: 14:34
 */
include_once ("ConnectionFactory.class.php");

class FonefornecedorDAO
{
     private $connection = null;

     public function insert (Fonefornecedor $fonefornecedor){
         $this->connection =  null;
         $teste = false;
         $this->connection = new ConnectionFactory();
         $this->connection->beginTransaction();
         try{
             $query = "INSERT INTO fone_fornecedor 
                      (CD_FORNECEDOR, NR_TELEFONE, OBS_TELEFONE, NM_CONTATO, CD_TIPO_CONTATO) 
                      VALUES 
                      (:fornecedor, :telefone, :observacao, :contato, :tipo )";

             $stmt = $this->connection->prepare($query);
             $stmt->bindValue(":fornecedor", $fonefornecedor->getfornecedor()->getCdfornecedor(), PDO::PARAM_INT);
             $stmt->bindValue(":telefone", $fonefornecedor->getNrTelefone(), PDO::PARAM_STR);
             $stmt->bindValue(":observacao", $fonefornecedor->getObsTelefone(), PDO::PARAM_STR);
             $stmt->bindValue(":contato", $fonefornecedor->getNmContato(), PDO::PARAM_STR);
             $stmt->bindValue(":tipo", $fonefornecedor->getTipoContato()->getCdTipoContato(), PDO::PARAM_INT);
             $stmt->execute();
             $this->connection->commit();
             $teste =  true;

             $this->connection =  null;
         }catch(PDOException $exception){
             echo "Erro: ".$exception->getMessage();
         }
         return $teste;
     }

    public function update (Fonefornecedor $fonefornecedor){

        $this->connection =  null;
        $teste = false;
        $this->connection = new ConnectionFactory();
        $this->connection->beginTransaction();
        try{
            $query = "UPDATE fone_fornecedor SET 
                       NR_TELEFONE = :telefone, OBS_TELEFONE = :observacao, 
                      NM_CONTATO = :contato, CD_TIPO_CONTATO = :tipo 
                      WHERE 
                      CD_FORNECEDOR = :fornecedor";
            $stmt = $this->connection->prepare($query);

            $stmt->bindValue(":fornecedor", $fonefornecedor->getfornecedor()->getCdfornecedor(), PDO::PARAM_INT);
            $stmt->bindValue(":telefone", $fonefornecedor->getNrTelefone(), PDO::PARAM_STR);
            $stmt->bindValue(":observacao", $fonefornecedor->getObsTelefone(), PDO::PARAM_STR);
            $stmt->bindValue(":contato", $fonefornecedor->getNmContato(), PDO::PARAM_STR);
            $stmt->bindValue(":tipo", $fonefornecedor->getTipoContato()->getCdTipoContato(), PDO::PARAM_INT);
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
            $query = "DELETE FROM fone_fornecedor WHERE CD_FORNECEDOR = :codigo";
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

    public function getList($cdFornecedor){
        require_once ("services/FoneFornecedorList.class.php");
        require_once ("beans/FoneFornecedor.class.php");
        include "beans/TipoContato.class.php";
        $this->connection = null;

        $this->connection = new ConnectionFactory();

        $fonefornecedorList = new FonefornecedorList();

        try {

                $sql = "SELECT *
                          FROM fone_fornecedor E
                          INNER JOIN tipo_contato T ON E.CD_TIPO_CONTATO = T.CD_TIPO_CONTATO
                          WHERE E.CD_FORNECEDOR = :fornecedor
                          ";
                $stmt = $this->connection->prepare($sql);
                $stmt->bindValue(":fornecedor",$cdFornecedor , PDO::PARAM_INT);

            $stmt->execute();
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $fonefornecedor = new Fonefornecedor();
                $fonefornecedor->setfornecedor(new fornecedor());
                $fonefornecedor->getfornecedor()->setCdfornecedor($row['CD_FORNECEDOR']);
                $fonefornecedor->setNrTelefone($row['NR_TELEFONE']);
                $fonefornecedor->setObsTelefone($row['OBS_TELEFONE']);
                $fonefornecedor->setNmContato($row['NM_CONTATO']);
                $fonefornecedor->setTipoContato(new TipoContato());
                $fonefornecedor->getTipoContato()->setCdTipoContato($row['CD_TIPO_CONTATO']);
                $fonefornecedor->getTipoContato()->setDsTipoContato($row['DS_TIPO_CONTATO']);
                $fonefornecedorList->addFonefornecedor($fonefornecedor);
            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $fonefornecedorList;
    }


}