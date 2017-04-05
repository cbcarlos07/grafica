<?php

/**
 * Created by PhpStorm.
 * User: carlos.brito
 * Date: 17/02/2017
 * Time: 14:34
 */

include_once ("ConnectionFactory.class.php");

class ClienteDAO
{
     private $connection = null;

     public function insert (Cliente $cliente){

         $this->connection =  null;
         $teste = 0;
         $this->connection = new ConnectionFactory();
         $this->connection->beginTransaction();
         try{
             $query = "INSERT INTO cliente 
                       (CD_CLIENTE, NM_RESPONSAVEL, DS_NM_FANTASIA, NR_CPF_CNPJ,  
                       DS_EMAIL, CD_ENDERECO, NR_CASA, DS_COMPLEMENTO, DT_CADASTRO)
                         VALUES ( 
                         NULL, :responsavel, :empresa, :cpfcnpj, :email,
                               :endereco, :numero, :complemento, curdate()
                         )";

             $stmt = $this->connection->prepare($query);


             $stmt->bindValue(":responsavel", $cliente->getNmResponsavel(), PDO::PARAM_STR);
             $stmt->bindValue(":empresa", $cliente->getDsNmFantasia(), PDO::PARAM_STR);
             $stmt->bindValue(":cpfcnpj", $cliente->getNrCpfCnpj(), PDO::PARAM_STR);
             $stmt->bindValue(":email", $cliente->getDsEmail(), PDO::PARAM_STR);
             $stmt->bindValue(":endereco", $cliente->getEndereco()->getCdEndereco(), PDO::PARAM_INT);
             $stmt->bindValue(":numero", $cliente->getNrCasa(), PDO::PARAM_STR);
             $stmt->bindValue(":complemento", $cliente->getDsComplemento(), PDO::PARAM_STR);
             $stmt->execute();
             $teste = $this->connection->lastInsertId();
             $this->connection->commit();




             $this->connection =  null;
         }catch(PDOException $exception){
             echo "Erro: ".$exception->getMessage();
         }
         return $teste;
     }

    public function update (Cliente $cliente){
        $this->connection =  null;
        $teste = false;
        $this->connection = new ConnectionFactory();
        $this->connection->beginTransaction();
        try{
            $query = "UPDATE cliente SET
                        NM_RESPONSAVEL = :responsavel, DS_NM_FANTASIA = :empresa, NR_CPF_CNPJ = :cpfcnpj,  
                       DS_EMAIL = :email, CD_ENDERECO = :endereco, NR_CASA = :numero, 
                       DS_COMPLEMENTO = :complemento, DT_ATUALIZACAO = curdate()
                       WHERE CD_CLIENTE = :codigo";
            //echo "Codigo: ".$cliente->getCdCliente();
            $stmt = $this->connection->prepare($query);
            $stmt->bindValue(":codigo", $cliente->getCdCliente(), PDO::PARAM_INT);
            $stmt->bindValue(":responsavel", $cliente->getNmResponsavel(), PDO::PARAM_STR);
            $stmt->bindValue(":empresa", $cliente->getDsNmFantasia(), PDO::PARAM_STR);
            $stmt->bindValue(":cpfcnpj", $cliente->getNrCpfCnpj(), PDO::PARAM_STR);
            $stmt->bindValue(":email", $cliente->getDsEmail(), PDO::PARAM_STR);
            $stmt->bindValue(":endereco", $cliente->getEndereco()->getCdEndereco(), PDO::PARAM_INT);
            $stmt->bindValue(":numero", $cliente->getNrCasa(), PDO::PARAM_STR);
            $stmt->bindValue(":complemento", $cliente->getDsComplemento(), PDO::PARAM_STR);
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
            $query = "DELETE FROM `cliente` WHERE `CD_CLIENTE` = :codigo";
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
     * @return ClienteList
     */
    public function getList($nome, $inicio, $limite){
        //include "include/error.php";
        require_once ("services/ClienteList.class.php");
        require_once ("beans/Cliente.class.php");
        require_once ("beans/Endereco.class.php");

        $this->connection = null;

        $this->connection = new ConnectionFactory();

        //echo "Inicio: ".$inicio."<br>";
        //echo "Fim: ".$limite."<br>";
        //echo "Nome: ".$nome;
        $clienteList = new ClienteList();
        $stmt = null;
        try {

                $sql = "SELECT C.*
                              ,E.CD_ENDERECO
                              ,E.NR_CEP                             
                        FROM cliente C 
                        INNER JOIN endereco     E  ON E.CD_ENDERECO = C.CD_ENDERECO
                      
                        WHERE C.NM_RESPONSAVEL LIKE :nome
                        ORDER BY C.NM_RESPONSAVEL ASC
                        LIMIT :inicio, :limite
                        ";

                $stmt = $this->connection->prepare($sql);
                $stmt->bindValue(":nome", "%$nome%", PDO::PARAM_STR);
                $stmt->bindValue(":inicio", $inicio, PDO::PARAM_INT);
                $stmt->bindValue(":limite", $limite, PDO::PARAM_INT);

            $stmt->execute();
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $cliente = new Cliente();
                //echo "Cod Cliente: ".$row['CD_CLIENTE'];
                $cliente->setCdCliente($row['CD_CLIENTE']);
                $cliente->setNmResponsavel($row['NM_RESPONSAVEL']);
                $cliente->setDsNmFantasia($row['DS_NM_FANTASIA']);
                $cliente->setNrCpfCnpj($row['NR_CPF_CNPJ']);
                $cliente->setDsEmail($row['DS_EMAIL']);
                $cliente->setEndereco(new Endereco());
                $cliente->getEndereco()->setCdEndereco($row['CD_ENDERECO']);
                $cliente->getEndereco()->setNrCep($row['NR_CEP']);

                $clienteList->addCliente($cliente);
            }

            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $clienteList;
    }

    public function getLista($nome){
        require_once ("../services/ClienteList.class.php");
        require_once ("../beans/Cliente.class.php");

        $this->connection = null;

        $this->connection = new ConnectionFactory();

        $clienteList = new ClienteList();
        $stmt = null;
        try {
            if($nome == ""){
                $sql = "SELECT C.*
                              ,E.CD_ENDERECO
                              ,E.NR_CEP                              
                        FROM cliente C 
                        INNER JOIN endereco     E  ON E.CD_ENDERECO = C.CD_ENDERECO
                        WHERE C.NM_RESPONSAVEL LIKE :nome ";

                $stmt = $this->connection->prepare($sql);
                $stmt->bindValue(":nome", "%$nome%", PDO::PARAM_STR);
            }
            $stmt->execute();
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $cliente = new Cliente();
                //echo "Cod Cliente: ".$row['CD_CLIENTE'];
                $cliente->setCdCliente($row['CD_CLIENTE']);
                $cliente->setNmResponsavel($row['NM_RESPONSAVEL']);
                $cliente->setDsNmFantasia($row['DS_NM_FANTASIA']);
                $cliente->setNrCpfCnpj($row['NR_CPF_CNPJ']);
                $cliente->setDsEmail($row['DS_EMAIL']);
                $cliente->setEndereco(new Endereco());
                $cliente->getEndereco()->setCdEndereco($row['CD_ENDERECO']);
                $cliente->getEndereco()->setNrCep($row['NR_CEP']);
                $clienteList->addCliente($cliente);
            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $clienteList;
    }

    public function getCliente($codigo){
        require_once "beans/Cliente.class.php";
        require_once "beans/Endereco.class.php";
        require_once "beans/TpLogradouro.class.php";
        require_once "beans/Bairro.class.php";
        require_once "beans/Cidade.class.php";
        require_once "beans/Estado.class.php";
        $cliente = null;
        $connection = null;
        $this->connection =  new ConnectionFactory();
        $sql =          "SELECT *
                        FROM cliente C 
                        INNER JOIN endereco      E  ON E.CD_ENDERECO = C.CD_ENDERECO
                        INNER JOIN tp_logradouro T  ON E.CD_TP_LOGRADOURO = T.CD_TP_LOGRADOURO
                        INNER JOIN bairro        B  ON E.CD_BAIRRO = B.CD_BAIRRO
                        INNER JOIN cidade        CI ON B.CD_CIDADE = CI.CD_CIDADE
                        INNER JOIN estado        ES ON CI.CD_ESTADO = ES.CD_ESTADO
                        WHERE C.CD_CLIENTE = :codigo";

        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(":codigo", $codigo, PDO::PARAM_INT);
            $stmt->execute();
            if($row =  $stmt->fetch(PDO::FETCH_ASSOC)){
                $cliente = new Cliente();
                $cliente->setCdCliente($row['CD_CLIENTE']);
                $cliente->setNmResponsavel($row['NM_RESPONSAVEL']);
                $cliente->setDsNmFantasia($row['DS_NM_FANTASIA']);
                $cliente->setNrCpfCnpj($row['NR_CPF_CNPJ']);
                $cliente->setDsEmail($row['DS_EMAIL']);
                $cliente->setEndereco(new Endereco());
                $cliente->getEndereco()->setCdEndereco($row['CD_ENDERECO']);
                $cliente->getEndereco()->setNrCep($row['NR_CEP']);
                $cliente->setDsEmail($row['DS_EMAIL']);

                $cliente->setEndereco(new Endereco());
                $cliente->getEndereco()->setCdEndereco($row['CD_ENDERECO']);
                $cliente->getEndereco()->setNrCep($row['NR_CEP']);
                $cliente->getEndereco()->setDsLogradouro($row['DS_LOGRADOURO']);
                $cliente->setNrCasa($row['NR_CASA']);
                $cliente->setDsComplemento($row['DS_COMPLEMENTO']);

                $cliente->setDtCadastro($row['DT_CADASTRO']);
                $cliente->getEndereco()->setTpLogradouro(new TpLogradouro());
                $cliente->getEndereco()->getTpLogradouro()->setDsTpLogradouro($row['DS_TP_LOGRADOURO']);
                $cliente->getEndereco()->setBairro(new Bairro());
                $cliente->getEndereco()->getBairro()->setNmBairro($row['NM_BAIRRO']);
                $cliente->getEndereco()->getBairro()->setCidade(new Cidade());
                $cliente->getEndereco()->getBairro()->getCidade()->setNmCidade($row['NM_CIDADE']);
                $cliente->getEndereco()->getBairro()->getCidade()->setEstado(new Estado());
                $cliente->getEndereco()->getBairro()->getCidade()->setEstado(new Estado());
                $cliente->getEndereco()->getBairro()->getCidade()->getEstado()->setNmEstado($row['NM_ESTADO']);
            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $cliente;
    }

    public function obterCliente($codigo){
        require_once "../beans/Cliente.class.php";
        require_once "../beans/Endereco.class.php";
        require_once "../beans/TpLogradouro.class.php";
        require_once "../beans/Bairro.class.php";
        require_once "../beans/Cidade.class.php";
        require_once "../beans/Estado.class.php";
        $cliente = null;
        $connection = null;
        $this->connection =  new ConnectionFactory();
        $sql =          "SELECT *
                        FROM cliente C 
                        INNER JOIN endereco      E  ON E.CD_ENDERECO = C.CD_ENDERECO
                        INNER JOIN tp_logradouro T  ON E.CD_TP_LOGRADOURO = T.CD_TP_LOGRADOURO
                        INNER JOIN bairro        B  ON E.CD_BAIRRO = B.CD_BAIRRO
                        INNER JOIN cidade        CI ON B.CD_CIDADE = CI.CD_CIDADE
                        INNER JOIN estado        ES ON CI.CD_ESTADO = ES.CD_ESTADO
                        WHERE C.CD_CLIENTE = :codigo";

        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(":codigo", $codigo, PDO::PARAM_INT);
            $stmt->execute();
            if($row =  $stmt->fetch(PDO::FETCH_ASSOC)){
                $cliente = new Cliente();
                //echo "Cod Cliente: ".$row['CD_CLIENTE'];
                $cliente->setCdCliente($row['CD_CLIENTE']);
                $cliente->setNmResponsavel($row['NM_RESPONSAVEL']);
                $cliente->setDsNmFantasia($row['DS_NM_FANTASIA']);
                $cliente->setNrCpfCnpj($row['NR_CPF_CNPJ']);
                $cliente->setDsEmail($row['DS_EMAIL']);
                $cliente->setEndereco(new Endereco());
                $cliente->getEndereco()->setCdEndereco($row['CD_ENDERECO']);
                $cliente->getEndereco()->setNrCep($row['NR_CEP']);
                $cliente->setEndereco(new Endereco());
                $cliente->getEndereco()->setCdEndereco($row['CD_ENDERECO']);
                $cliente->getEndereco()->setNrCep($row['NR_CEP']);
                $cliente->getEndereco()->setDsLogradouro($row['DS_LOGRADOURO']);
                $cliente->setNrCasa($row['NR_CASA']);
                $cliente->setDsComplemento($row['DS_COMPLEMENTO']);
                $cliente->setDtCadastro($row['DT_CADASTRO']);
                $cliente->getEndereco()->setTpLogradouro(new TpLogradouro());
                $cliente->getEndereco()->getTpLogradouro()->setDsTpLogradouro($row['DS_TP_LOGRADOURO']);
                $cliente->getEndereco()->setBairro(new Bairro());
                $cliente->getEndereco()->getBairro()->setNmBairro($row['NM_BAIRRO']);
                $cliente->getEndereco()->getBairro()->setCidade(new Cidade());
                $cliente->getEndereco()->getBairro()->getCidade()->setNmCidade($row['NM_CIDADE']);
                $cliente->getEndereco()->getBairro()->getCidade()->setEstado(new Estado());
                $cliente->getEndereco()->getBairro()->getCidade()->setEstado(new Estado());
                $cliente->getEndereco()->getBairro()->getCidade()->getEstado()->setNmEstado($row['NM_ESTADO']);
            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $cliente;
    }


    public function getTotalCliente(){
        $cliente = 0;
        $connection = null;
        $this->connection =  new ConnectionFactory();
        $sql =          "SELECT COUNT(*) TOTAL
                        FROM cliente C 
                        ";

        try {
            $stmt = $this->connection->prepare($sql);

            $stmt->execute();
            if($row =  $stmt->fetch(PDO::FETCH_ASSOC)){
                $cliente = $row['TOTAL'];
            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $cliente;
    }
}