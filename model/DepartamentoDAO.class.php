<?php

/**
 * Created by PhpStorm.
 * User: carlos.brito
 * Date: 17/02/2017
 * Time: 14:34
 */
//include "../include/error.php";
include_once ("ConnectionFactory.class.php");

class DepartamentoDAO
{
     private $connection = null;

     public function insert (Departamento $departamento){
         $this->connection =  null;
         $teste = 0;

         $this->connection = new ConnectionFactory();
         $this->connection->beginTransaction();
         try{
             $query = "INSERT INTO departamento 
                       (CD_DEPARTAMENTO, NM_RESPONSAVEL, DS_DEPARTAMENTO, CD_FILIAL, DS_EMAIL)
                       VALUES 
                       (NULL, :responsavel, :departamento,  :filial, :email)";


             $stmt = $this->connection->prepare($query);
             $stmt->bindValue(":responsavel", $departamento->getNmResponsavel(), PDO::PARAM_STR);
             $stmt->bindValue(":departamento",$departamento->getDsDepartamento(), PDO::PARAM_STR);
             $stmt->bindValue(":filial",$departamento->getFilial()->getCdFilial(), PDO::PARAM_INT);
             $stmt->bindValue(":email",$departamento->getDsEmail(), PDO::PARAM_STR);
             $stmt->execute();
             $teste =  $this->connection->lastInsertId();
             $this->connection->commit();


             $this->connection =  null;
         }catch(PDOException $exception){
             echo "Erro: ".$exception->getMessage();
         }
         return $teste;
     }

    public function update (Departamento $departamento){
        $this->connection =  null;
        $teste = false;

        $this->connection = new ConnectionFactory();
        $this->connection->beginTransaction();
        try{
            $query = "UPDATE departamento SET 
                       CD_FILIAL = :filial 
                      ,NM_RESPONSAVEL =  :responsavel
                      ,DS_DEPARTAMENTO =  :departamento
                      ,DS_EMAIL = :email
                       WHERE 
                       CD_DEPARTAMENTO = :codigo";


            $stmt = $this->connection->prepare($query);
            $stmt->bindValue(":responsavel", $departamento->getNmResponsavel(), PDO::PARAM_STR);
            $stmt->bindValue(":departamento",$departamento->getDsDepartamento(), PDO::PARAM_STR);
            $stmt->bindValue(":filial",$departamento->getFilial()->getCdFilial(), PDO::PARAM_INT);
            $stmt->bindValue(":codigo",$departamento->getCdDepartamento(), PDO::PARAM_INT);
            $stmt->bindValue(":email",$departamento->getDsEmail(), PDO::PARAM_STR);
            $stmt->execute();

              $this->connection->commit();
            $teste =  true;
          //  print_r($stmt);

            $this->connection =  null;
        }catch(PDOException $exception){
            echo "Erro: ".$exception->getMessage();
        }
        return $teste;
    }

    public function delete ($codigo){
        $this->connection =  null;
        $teste = false;
        $this->connection = new     ConnectionFactory();
        $this->connection->beginTransaction();
        try{
            $query = "DELETE FROM departamento WHERE CD_DEPARTAMENTO = :codigo";
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

    public function getList($filial, $nmdepartamento, $inicio, $limite){
        require_once ("services/DepartamentolList.class.php");
        require_once ("beans/Departamento.class.php");
        require_once ("beans/Filial.class.php");

        $this->connection = null;

        $this->connection = new ConnectionFactory();

        $departamentoList = new DepartamentoList();

        try {

                $sql = "SELECT F.*
                        FROM departamento F
                        WHERE F.CD_FILIAL = :filial
                        AND   F.DS_DEPARTAMENTO LIKE :departamento
                        LIMIT :inicio, :limite";
                $stmt = $this->connection->prepare($sql);
                $stmt->bindValue(":filial", $filial, PDO::PARAM_INT);
                $stmt->bindValue(":departamento", "%$nmdepartamento%", PDO::PARAM_STR);
                $stmt->bindValue(":inicio", $inicio, PDO::PARAM_INT);
                $stmt->bindValue(":limite", $limite, PDO::PARAM_INT);

            $stmt->execute();
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $departamento = new Departamento();
                $departamento->setCdDepartamento($row['CD_DEPARTAMENTO']);
                $departamento->setFilial(new Filial());
                $departamento->getFilial()->setCdFilial($row['CD_FILIAL']);
                $departamento->setDsDepartamento($row['DS_DEPARTAMENTO']);
                $departamento->setNmResponsavel($row['NM_RESPONSAVEL']);

                $departamentoList->addDepartamento($departamento);
            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $departamentoList;
    }

    public function getListaDepartamento($filial){
        require_once ("services/DepartamentolList.class.php");
        require_once ("beans/Departamento.class.php");
        require_once ("beans/Filial.class.php");

        $this->connection = null;

        $this->connection = new ConnectionFactory();

        $departamentoList = new DepartamentoList();

        try {

            $sql = "SELECT F.*
                        FROM departamento F
                        WHERE F.CD_FILIAL = :filial";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(":filial", $filial, PDO::PARAM_INT);

            $stmt->execute();
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $departamento = new Departamento();
                $departamento->setCdDepartamento($row['CD_DEPARTAMENTO']);
                $departamento->setFilial(new Filial());
                $departamento->getFilial()->setCdFilial($row['CD_FILIAL']);
                $departamento->setDsDepartamento($row['DS_DEPARTAMENTO']);
                $departamento->setNmResponsavel($row['NM_RESPONSAVEL']);

                $departamentoList->addDepartamento($departamento);
            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $departamentoList;
    }

    public function getLista($filial){
        require_once ("../services/DepartamentoList.class.php");
        require_once ("../beans/Departamento.class.php");
        require_once ("../beans/Filial.class.php");

        $this->connection = null;

        $this->connection = new ConnectionFactory();

        $departamentoList = new DepartamentoList();

        try {

            $sql = "SELECT F.*
                        FROM departamento F
                        WHERE F.CD_FILIAL = :filial";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(":filial", $filial, PDO::PARAM_INT);


            $stmt->execute();
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $departamento = new Departamento();
                $departamento->setCdDepartamento($row['CD_DEPARTAMENTO']);
                $departamento->setFilial(new Filial());
                $departamento->getFilial()->setCdFilial($row['CD_FILIAL']);
                $departamento->setDsDepartamento($row['DS_DEPARTAMENTO']);
                $departamento->setNmResponsavel($row['NM_RESPONSAVEL']);

                $departamentoList->addDepartamento($departamento);
            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $departamentoList;
    }

    public function getDepartamento($codigo){
        require_once ("beans/Filial.class.php");
        require_once ("beans/Departamento.class.php");
        $departamento = null;
        $this->connection = null;
        $this->connection =  new ConnectionFactory();
        $sql = "SELECT F.*
                        FROM departamento F
                        WHERE F.CD_DEPARTAMENTO = :codigo";

        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(":codigo", $codigo, PDO::PARAM_INT);
            $stmt->execute();
            if($row =  $stmt->fetch(PDO::FETCH_ASSOC)){
                $departamento = new Departamento();
                $departamento->setCdDepartamento($row['CD_DEPARTAMENTO']);
                $departamento->setFilial(new Filial());
                $departamento->getFilial()->setCdFilial($row['CD_FILIAL']);
                $departamento->setDsDepartamento($row['DS_DEPARTAMENTO']);
                $departamento->setNmResponsavel($row['NM_RESPONSAVEL']);
                $departamento->setDsEmail($row['DS_EMAIL']);
            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $departamento;
    }

   public function getTotalDepartamentos($filial){
        $departamento = 0;
        $this->connection = null;
        $this->connection =  new ConnectionFactory();
        $sql = "SELECT COUNT(*) TOTAL FROM departamento WHERE CD_FILIAL = :filial";

        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(":filial", $filial, PDO::PARAM_INT);
            $stmt->execute();
            if($row =  $stmt->fetch(PDO::FETCH_ASSOC)){
                $departamento = $row['TOTAL'];
            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $departamento;
    }
}