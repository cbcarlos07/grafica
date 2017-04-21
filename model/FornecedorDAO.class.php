<?php

/**
 * Created by PhpStorm.
 * User: carlos.brito
 * Date: 17/02/2017
 * Time: 14:34
 */

include_once ("ConnectionFactory.class.php");

class FornecedorDAO
{
     private $connection = null;

     public function insert (Fornecedor $fornecedor){

         $this->connection =  null;
         $teste = 0;
         $this->connection = new ConnectionFactory();
         $this->connection->beginTransaction();
         try{
             $query = "INSERT INTO fornecedor 
                       (CD_FORNECEDOR, DS_NM_FANTASIA, DS_RAZAO_SOCIAL, NR_CPF_CNPJ,  
                       DS_EMAIL, NR_CEP, NR_CASA, DS_COMPLEMENTO, DT_CADASTRO)
                         VALUES ( 
                         NULL, :fantasia, :razao, :cpfcnpj, :email,
                               :endereco, :numero, :complemento, curdate()
                         )";

             $stmt = $this->connection->prepare($query);


             $stmt->bindValue(":razao", $fornecedor->getDsRazaoSocial(), PDO::PARAM_STR);
             $stmt->bindValue(":fantasia", $fornecedor->getDsNmFantasia(), PDO::PARAM_STR);
             $stmt->bindValue(":cpfcnpj", $fornecedor->getNrCpfCnpj(), PDO::PARAM_STR);
             $stmt->bindValue(":email", $fornecedor->getDsEmail(), PDO::PARAM_STR);
             $stmt->bindValue(":endereco", $fornecedor->getNrCep(), PDO::PARAM_INT);
             $stmt->bindValue(":numero", $fornecedor->getNrCasa(), PDO::PARAM_STR);
             $stmt->bindValue(":complemento", $fornecedor->getDsComplemento(), PDO::PARAM_STR);
             $stmt->execute();
             $teste = $this->connection->lastInsertId();
             $this->connection->commit();




             $this->connection =  null;
         }catch(PDOException $exception){
             echo "Erro: ".$exception->getMessage();
         }
         return $teste;
     }

    public function update (Fornecedor $fornecedor){
        $this->connection =  null;
        $teste = false;
        $this->connection = new ConnectionFactory();
        $this->connection->beginTransaction();
        try{
            $query = "UPDATE fornecedor SET
                        DS_NM_FANTASIA = :fantasia, DS_RAZAO_SOCIAL = :razao, NR_CPF_CNPJ = :cpfcnpj,  
                       DS_EMAIL = :email, NR_CEP = :endereco, NR_CASA = :numero, 
                       DS_COMPLEMENTO = :complemento, DT_ATUALIZACAO = curdate()
                       WHERE CD_FORNECEDOR = :codigo";
            //echo "Codigo: ".$fornecedor->getCdFornecedor();
            $stmt = $this->connection->prepare($query);
            $stmt->bindValue(":codigo", $fornecedor->getCdFornecedor(), PDO::PARAM_INT);
            $stmt->bindValue(":razao", $fornecedor->getDsRazaoSocial(), PDO::PARAM_STR);
            $stmt->bindValue(":fantasia", $fornecedor->getDsNmFantasia(), PDO::PARAM_STR);
            $stmt->bindValue(":cpfcnpj", $fornecedor->getNrCpfCnpj(), PDO::PARAM_STR);
            $stmt->bindValue(":email", $fornecedor->getDsEmail(), PDO::PARAM_STR);
            $stmt->bindValue(":endereco", $fornecedor->getNrCep(), PDO::PARAM_INT);
            $stmt->bindValue(":numero", $fornecedor->getNrCasa(), PDO::PARAM_STR);
            $stmt->bindValue(":complemento", $fornecedor->getDsComplemento(), PDO::PARAM_STR);
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
            $query = "DELETE FROM `fornecedor` WHERE `CD_FORNECEDOR` = :codigo";
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

    /**
     * @param $nome
     * @return FornecedorList
     */
    public function getList($nome, $inicio, $limite){
        //include "include/error.php";
        require_once ("services/FornecedorList.class.php");
        require_once ("beans/Fornecedor.class.php");

        $this->connection = null;

        $this->connection = new ConnectionFactory();

        //echo "Inicio: ".$inicio."<br>";
        //echo "Fim: ".$limite."<br>";
        //echo "Nome: ".$nome;
        $fornecedorList = new FornecedorList();
        $stmt = null;
        try {

                $sql = "SELECT C.*                             
                        FROM fornecedor C 
                      
                        WHERE C.DS_NM_FANTASIA LIKE :nome
                        ORDER BY C.DS_NM_FANTASIA ASC
                        LIMIT :inicio, :limite
                        ";

                $stmt = $this->connection->prepare($sql);
                $stmt->bindValue(":nome", "%$nome%", PDO::PARAM_STR);
                $stmt->bindValue(":inicio", $inicio, PDO::PARAM_INT);
                $stmt->bindValue(":limite", $limite, PDO::PARAM_INT);

            $stmt->execute();
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $fornecedor = new Fornecedor();
                //echo "Cod Fornecedor: ".$row['CD_FORNECEDOR'];
                $fornecedor->setCdFornecedor($row['CD_FORNECEDOR']);
                $fornecedor->setDsNmFantasia($row['DS_NM_FANTASIA']);
                $fornecedor->setDsRazaoSocial($row['DS_RAZAO_SOCIAL']);
                $fornecedor->setNrCpfCnpj($row['NR_CPF_CNPJ']);
                $fornecedor->setDsEmail($row['DS_EMAIL']);
                $fornecedor->setNrCep($row['NR_CEP']);

                $fornecedorList->addFornecedor($fornecedor);
            }

            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $fornecedorList;
    }

    public function getLista($nome){
        require_once ("../services/FornecedorList.class.php");
        require_once ("../beans/Fornecedor.class.php");

        $this->connection = null;

        $this->connection = new ConnectionFactory();

        $fornecedorList = new FornecedorList();
        $stmt = null;
        try {
            if($nome == ""){
                $sql = "SELECT C.*                             
                        FROM fornecedor C 
                        WHERE C.DS_NM_FANTASIA LIKE :nome ";

                $stmt = $this->connection->prepare($sql);
                $stmt->bindValue(":nome", "%$nome%", PDO::PARAM_STR);
            }
            $stmt->execute();
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $fornecedor = new Fornecedor();
                //echo "Cod Fornecedor: ".$row['CD_FORNECEDOR'];
                $fornecedor->setCdFornecedor($row['CD_FORNECEDOR']);
                $fornecedor->setDsNmFantasia($row['DS_NM_FANTASIA']);
                $fornecedor->setDsRazaoSocial($row['DS_RAZAO_SOCIAL']);
                $fornecedor->setNrCpfCnpj($row['NR_CPF_CNPJ']);
                $fornecedor->setDsEmail($row['DS_EMAIL']);
                $fornecedor->setNrCep($row['NR_CEP']);
                $fornecedorList->addFornecedor($fornecedor);
            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $fornecedorList;
    }

    public function getFornecedor($codigo){
        require_once "beans/Fornecedor.class.php";
        $fornecedor = null;
        $connection = null;
        $this->connection =  new ConnectionFactory();
        $sql =          "SELECT *
                        FROM fornecedor C 
                        WHERE C.CD_FORNECEDOR = :codigo";

        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(":codigo", $codigo, PDO::PARAM_INT);
            $stmt->execute();
            if($row =  $stmt->fetch(PDO::FETCH_ASSOC)){
                $fornecedor = new Fornecedor();
                $fornecedor->setCdFornecedor($row['CD_FORNECEDOR']);
                $fornecedor->setDsNmFantasia($row['DS_NM_FANTASIA']);
                $fornecedor->setDsRazaoSocial($row['DS_RAZAO_SOCIAL']);
                $fornecedor->setNrCpfCnpj($row['NR_CPF_CNPJ']);
                $fornecedor->setDsEmail($row['DS_EMAIL']);
                $fornecedor->setNrCep($row['NR_CEP']);
                $fornecedor->setDsEmail($row['DS_EMAIL']);


                $fornecedor->setNrCasa($row['NR_CASA']);
                $fornecedor->setDsComplemento($row['DS_COMPLEMENTO']);

                $fornecedor->setDtCadastro($row['DT_CADASTRO']);

            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $fornecedor;
    }

    public function obterFornecedor($codigo){
        require_once "../beans/Fornecedor.class.php";
        require_once "../beans/Cidade.class.php";
        $fornecedor = null;
        $connection = null;
        $this->connection =  new ConnectionFactory();
        $sql =          "SELECT *
                        FROM fornecedor C 
                        WHERE C.CD_FORNECEDOR = :codigo";

        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(":codigo", $codigo, PDO::PARAM_INT);
            $stmt->execute();
            if($row =  $stmt->fetch(PDO::FETCH_ASSOC)){
                $fornecedor = new Fornecedor();
                //echo "Cod Fornecedor: ".$row['CD_FORNECEDOR'];
                $fornecedor->setCdFornecedor($row['CD_FORNECEDOR']);
                $fornecedor->setDsNmFantasia($row['DS_NM_FANTASIA']);
                $fornecedor->setDsRazaoSocial($row['DS_RAZAO_SOCIAL']);
                $fornecedor->setNrCpfCnpj($row['NR_CPF_CNPJ']);
                $fornecedor->setDsEmail($row['DS_EMAIL']);
                $fornecedor->setNrCep($row['NR_CEP']);
                $fornecedor->setNrCasa($row['NR_CASA']);
                $fornecedor->setDsComplemento($row['DS_COMPLEMENTO']);
                $fornecedor->setDtCadastro($row['DT_CADASTRO']);
            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $fornecedor;
    }


    public function getTotalFornecedor(){
        $fornecedor = 0;
        $connection = null;
        $this->connection =  new ConnectionFactory();
        $sql =          "SELECT COUNT(*) TOTAL
                        FROM fornecedor C 
                        ";

        try {
            $stmt = $this->connection->prepare($sql);

            $stmt->execute();
            if($row =  $stmt->fetch(PDO::FETCH_ASSOC)){
                $fornecedor = $row['TOTAL'];
            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $fornecedor;
    }
}