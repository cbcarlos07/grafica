<?php

/**
 * Created by PhpStorm.
 * User: carlos.brito
 * Date: 17/02/2017
 * Time: 14:34
 */
//include "../include/error.php";
include_once ("ConnectionFactory.class.php");

class FilialDAO
{
     private $connection = null;

     public function insert (Filial $filial){
         $this->connection =  null;
         $teste = 0;

         $this->connection = new ConnectionFactory();
         $this->connection->beginTransaction();
         try{
             $query = "INSERT INTO filial 
                       (CD_FILIAL, CD_CLIENTE,  NM_RESPONSAVEL, DS_NM_FANTASIA, NR_CEP, NR_CASA, DS_COMPLEMENTO
                       ,DS_EMAIL, NR_CPF_CNPJ)
                       VALUES 
                       (NULL,  :cliente, :responsavel, :empresa, :cep, :casa, :complemento, :email, :cpfcnpj)";


             $stmt = $this->connection->prepare($query);
             $stmt->bindValue(":cliente", $filial->getCliente()->getCdCliente(), PDO::PARAM_INT);
             $stmt->bindValue(":responsavel", $filial->getNmResponsavel(), PDO::PARAM_STR);
             $stmt->bindValue(":empresa",$filial->getDsNmFantasia(), PDO::PARAM_STR);
             $stmt->bindValue(":cep",$filial->getNrCep(), PDO::PARAM_STR);
             $stmt->bindValue(":casa",$filial->getNrCasa(), PDO::PARAM_STR);
             $stmt->bindValue(":complemento",$filial->getDsComplemento(), PDO::PARAM_STR);
             $stmt->bindValue(":email",$filial->getDsEmail(), PDO::PARAM_STR);
             $stmt->bindValue(":cpfcnpj",$filial->getNrCpfCnpj(), PDO::PARAM_STR);
             $stmt->execute();
             $teste =  $this->connection->lastInsertId();
             $this->connection->commit();


             $this->connection =  null;
         }catch(PDOException $exception){
             echo "Erro: ".$exception->getMessage();
         }
         return $teste;
     }

    public function update (Filial $filial){
        $this->connection =  null;
        $teste = false;

        $this->connection = new ConnectionFactory();
        $this->connection->beginTransaction();
        try{
            $query = "UPDATE filial SET 
                       CD_CLIENTE = :cliente 
                      ,NM_RESPONSAVEL =  :responsavel
                      ,DS_NM_FANTASIA =  :empresa
                      ,NR_CEP = :cep
                      ,NR_CASA = :casa
                      ,DS_COMPLEMENTO = :complemento
                      ,DS_EMAIL = :email
                      ,NR_CPF_CNPJ = :cpfcnpj
                       WHERE 
                       CD_FILIAL = :codigo";


            $stmt = $this->connection->prepare($query);
            $stmt->bindValue(":cliente",$filial->getCliente()->getCdCliente(),PDO::PARAM_INT);
            $stmt->bindValue(":responsavel", $filial->getNmResponsavel(), PDO::PARAM_STR);
            $stmt->bindValue(":empresa",$filial->getDsNmFantasia(), PDO::PARAM_STR);
            $stmt->bindValue(":cep",$filial->getNrCep(), PDO::PARAM_STR);
            $stmt->bindValue(":casa",$filial->getNrCasa(), PDO::PARAM_STR);
            $stmt->bindValue(":complemento",$filial->getDsComplemento(), PDO::PARAM_STR);
            $stmt->bindValue(":email",$filial->getDsEmail(), PDO::PARAM_STR);
            $stmt->bindValue(":cpfcnpj",$filial->getNrCpfCnpj(), PDO::PARAM_STR);
            $stmt->bindValue(":codigo",$filial->getCdFilial(),PDO::PARAM_INT);
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
            $query = "DELETE FROM filial WHERE CD_FILIAL = :codigo";
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

    public function getList($cliente, $empresa, $inicio, $limite){
        require_once ("services/FilialList.class.php");
        require_once ("beans/Filial.class.php");
        require_once ("beans/Cliente.class.php");

        $this->connection = null;

        $this->connection = new ConnectionFactory();

        $filialList = new FilialList();

        try {

                $sql = "SELECT F.*
                        FROM filial F
                        WHERE F.CD_CLIENTE = :cliente
                        AND   F.DS_NM_FANTASIA LIKE :empresa
                        LIMIT :inicio, :limite";
                $stmt = $this->connection->prepare($sql);
                $stmt->bindValue(":cliente", $cliente, PDO::PARAM_INT);
                $stmt->bindValue(":empresa", "%$empresa%", PDO::PARAM_STR);
                $stmt->bindValue(":inicio", $inicio, PDO::PARAM_INT);
                $stmt->bindValue(":limite", $limite, PDO::PARAM_INT);

            $stmt->execute();
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $filial = new Filial();
                $filial->setCdFilial($row['CD_FILIAL']);
                $filial->setCliente(new Cliente());
                $filial->getCliente()->setCdCliente($row['CD_CLIENTE']);
                $filial->setNmResponsavel($row['NM_RESPONSAVEL']);
                $filial->setDsNmFantasia($row['DS_NM_FANTASIA']);
                $filial->setNrCep($row['NR_CEP']);
                $filial->setNrCasa($row['NR_CASA']);
                $filial->setDsComplemento($row['DS_COMPLEMENTO']);
                $filial->setDsEmail($row['DS_EMAIL']);
                $filial->setNrCpfCnpj($row['NR_CPF_CNPJ']);

                $filialList->addFilial($filial);
            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $filialList;
    }

    public function getLista($cliente){
        require_once ("../services/FilialList.class.php");
        require_once ("../beans/Filial.class.php");
        require_once ("../beans/Cliente.class.php");

        $this->connection = null;

        $this->connection = new ConnectionFactory();

        $filialList = new FilialList();

        try {

            $sql = "SELECT F.*
                        FROM filial F
                        WHERE F.CD_CLIENTE = :cliente";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(":cliente", $cliente, PDO::PARAM_INT);

            $stmt->execute();
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $filial = new Filial();
                $filial->setCdFilial($row['CD_FILIAL']);
                $filial->setCliente(new Cliente());
                $filial->getCliente()->setCdCliente($row['CD_CLIENTE']);
                $filial->setNmResponsavel($row['NM_RESPONSAVEL']);
                $filial->setDsNmFantasia($row['DS_NM_FANTASIA']);
                $filial->setNrCep($row['NR_CEP']);
                $filial->setNrCasa($row['NR_CASA']);
                $filial->setDsComplemento($row['DS_COMPLEMENTO']);
                $filial->setDsEmail($row['DS_EMAIL']);
                $filial->setNrCpfCnpj($row['NR_CPF_CNPJ']);

                $filialList->addFilial($filial);
            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $filialList;
    }

    public function getFilial($codigo){
        require_once ("beans/Cliente.class.php");
        require_once ("beans/Filial.class.php");
        $filial = null;
        $this->connection = null;
        $this->connection =  new ConnectionFactory();
        $sql = "SELECT F.*
                        FROM filial F
                        WHERE F.CD_FILIAL = :codigo";

        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(":codigo", $codigo, PDO::PARAM_INT);
            $stmt->execute();
            if($row =  $stmt->fetch(PDO::FETCH_ASSOC)){
                $filial = new Filial();
                $filial->setCdFilial($row['CD_FILIAL']);
                $filial->setCliente(new Cliente());
                $filial->getCliente()->setCdCliente($row['CD_CLIENTE']);
                $filial->setNmResponsavel($row['NM_RESPONSAVEL']);
                $filial->setDsNmFantasia($row['DS_NM_FANTASIA']);
                $filial->setNrCep($row['NR_CEP']);
                $filial->setNrCasa($row['NR_CASA']);
                $filial->setDsComplemento($row['DS_COMPLEMENTO']);
                $filial->setDsEmail($row['DS_EMAIL']);
                $filial->setNrCpfCnpj($row['NR_CPF_CNPJ']);
            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $filial;
    }

   public function getTotalFilials($cliente){
        $filial = 0;
        $this->connection = null;
        $this->connection =  new ConnectionFactory();
        $sql = "SELECT COUNT(*) TOTAL FROM filial WHERE CD_CLIENTE = :cliente";

        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(":cliente", $cliente, PDO::PARAM_INT);
            $stmt->execute();
            if($row =  $stmt->fetch(PDO::FETCH_ASSOC)){
                $filial = $row['TOTAL'];
            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $filial;
    }
}