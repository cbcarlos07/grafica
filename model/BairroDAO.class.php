<?php

/**
 * Created by PhpStorm.
 * User: carlos.brito
 * Date: 17/02/2017
 * Time: 14:34
 */
//include "../include/error.php";
include_once ("ConnectionFactory.class.php");

class BairroDAO
{
     private $connection = null;

     public function insert (Bairro $bairro){
         $this->connection =  null;
         $teste = false;

         $this->connection = new ConnectionFactory();
         $this->connection->beginTransaction();
         try{
             $query = "INSERT INTO bairro 
                       (CD_BAIRRO, NM_BAIRRO, CD_CIDADE, CD_ZONA) 
                       VALUES 
                       (NULL, :bairro, :cidade, :zona)";


             $stmt = $this->connection->prepare($query);
             $stmt->bindValue(":bairro", $bairro->getNmBairro(), PDO::PARAM_STR);
             $stmt->bindValue(":cidade",$bairro->getCidade()->getCdCidade(), PDO::PARAM_INT);
             $stmt->bindValue(":zona",$bairro->getZona()->getCdZona(), PDO::PARAM_INT);
             $stmt->execute();
             $this->connection->commit();
             $teste =  true;

             $this->connection =  null;
         }catch(PDOException $exception){
             echo "Erro: ".$exception->getMessage();
         }
         return $teste;
     }

    public function update (Bairro $bairro){
        $this->connection =  null;
        $teste = false;

        $this->connection = new ConnectionFactory();
        $this->connection->beginTransaction();
        try{
            $query = "UPDATE bairro SET 
                       NM_BAIRRO = :bairro, CD_CIDADE = :cidade, CD_ZONA = :zona 
                       WHERE CD_BAIRRO = :codigo";


            $stmt = $this->connection->prepare($query);
           // echo "Cd zona: ".$bairro->getZona()->getCdZona();
            $stmt->bindValue(":bairro", $bairro->getNmBairro(), PDO::PARAM_STR);
            $stmt->bindValue(":cidade",$bairro->getCidade()->getCdCidade(), PDO::PARAM_INT);
            $stmt->bindValue(":zona",$bairro->getZona()->getCdZona(), PDO::PARAM_INT);
            $stmt->bindValue(":codigo",$bairro->getCdBairro(), PDO::PARAM_INT);
            $stmt->execute();
          //
            //
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
            $query = "DELETE FROM bairro WHERE CD_BAIRRO = :codigo";
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

    public function getListByBairro($nome, $inicio, $limite){
        require_once ("services/BairroList.class.php");
        require_once ("beans/Bairro.class.php");
        require_once ("beans/Zona.class.php");
        require_once ("beans/Cidade.class.php");

        $this->connection = null;

        $this->connection = new ConnectionFactory();

        $bairroList = new BairroList();

        try {

                $sql = "SELECT `B`.`CD_BAIRRO`
                              ,`B`.`NM_BAIRRO`
                              ,`B`.`CD_CIDADE`
                              ,`C`.`NM_CIDADE`
                              ,`B`.`CD_ZONA`
                              ,`Z`.`DS_ZONA`
                        FROM `bairro` `B`
                        INNER JOIN `cidade` `C` ON `C`.`CD_CIDADE` = `B`.`CD_CIDADE`
                        INNER JOIN `zona` `Z`   ON `Z`.`CD_ZONA` = `B`.`CD_ZONA`
                        WHERE `B`.`NM_BAIRRO` LIKE :nome
                        ORDER BY B.NM_BAIRRO 
                        LIMIT :inicio, :limite";
                $stmt = $this->connection->prepare($sql);
                $stmt->bindValue(":nome", "%$nome%", PDO::PARAM_STR);
                $stmt->bindValue(":inicio", $inicio, PDO::PARAM_INT);
                $stmt->bindValue(":limite", $limite, PDO::PARAM_INT);

            $stmt->execute();
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $bairro = new Bairro();
                $bairro->setCdBairro($row['CD_BAIRRO']);
                $bairro->setNmBairro($row['NM_BAIRRO']);
                $bairro->setCidade(new Cidade());
                $bairro->getCidade()->setCdCidade($row['CD_CIDADE']);
                $bairro->getCidade()->setNmCidade($row['NM_CIDADE']);
                $bairro->setZona(new Zona());
                $bairro->getZona()->setCdZona($row['CD_ZONA']);
                $bairro->getZona()->setDsZona($row['DS_ZONA']);

                $bairroList->addBairro($bairro);
            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $bairroList;
    }

    public function getListByCidade($nome, $cidade){
        require_once ("../services/BairroList.class.php");
        require_once ("../beans/Bairro.class.php");
        require_once ("../beans/Cidade.class.php");
        require_once ("../beans/Zona.class.php");

        $this->connection = null;

        $this->connection = new ConnectionFactory();

        $bairroList = new BairroList();

        try {

            $sql = "SELECT `B`.`CD_BAIRRO`
                              ,`B`.`NM_BAIRRO`
                              ,`B`.`CD_CIDADE`
                              ,`C`.`NM_CIDADE`
                              ,`B`.`CD_ZONA`
                              ,`Z`.`DS_ZONA`
                        FROM `bairro` `B`
                        INNER JOIN `cidade` `C` ON `C`.`CD_CIDADE` = `B`.`CD_CIDADE`
                        INNER JOIN `zona` `Z`   ON `Z`.`CD_ZONA` = `B`.`CD_ZONA`
                        WHERE `B`.`NM_BAIRRO` LIKE :nome
                          AND `C`.`CD_CIDADE` = :cidade
                          ORDER BY B.NM_BAIRRO ";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(":nome", "%$nome%", PDO::PARAM_STR);
            $stmt->bindValue(":cidade",$cidade, PDO::PARAM_INT);

            $stmt->execute();
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $bairro = new Bairro();
                $bairro->setCdBairro($row['CD_BAIRRO']);
                $bairro->setNmBairro($row['NM_BAIRRO']);
                $bairro->setCidade(new Cidade());
                $bairro->getCidade()->setCdCidade($row['CD_CIDADE']);
                $bairro->getCidade()->setNmCidade($row['NM_CIDADE']);
                $bairro->setZona(new Zona());
                $bairro->getZona()->setCdZona($row['CD_ZONA']);
                $bairro->getZona()->setDsZona($row['DS_ZONA']);

                $bairroList->addBairro($bairro);
            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $bairroList;
    }

    public function getListByZona($nome, $cidade, $zona){
        require_once ("../services/BairroList.class.php");
        require_once ("../beans/Bairro.class.php");
        require_once ("beans/Cidade.class.php");
        require_once ("beans/Zona.class.php");

        $this->connection = null;

        $this->connection = new ConnectionFactory();

        $bairroList = new BairroList();

        try {

            $sql = "SELECT `B`.`CD_BAIRRO`
                              ,`B`.`NM_BAIRRO`
                              ,`B`.`CD_CIDADE`
                              ,`C`.`NM_CIDADE`
                              ,`B`.`CD_ZONA`
                              ,`Z`.`DS_ZONA`
                        FROM `bairro` `B`
                        INNER JOIN `cidade` `C` ON `C`.`CD_CIDADE` = `B`.`CD_CIDADE`
                        INNER JOIN `zona` `Z`   ON `Z`.`CD_ZONA` = `B`.`CD_ZONA`
                        WHERE `B`.`NM_BAIRRO` LIKE :nome
                          AND `C`.`CD_CIDADE` = :cidade
                          AND `Z`.`CD_ZONA` = :zona
                          ORDER BY B.NM_BAIRRO ";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(":nome", "%$nome%", PDO::PARAM_STR);
            $stmt->bindValue(":cidade",$cidade, PDO::PARAM_INT);
            $stmt->bindValue(":zona", $zona, PDO::PARAM_INT);

            $stmt->execute();
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $bairro = new Bairro();
                $bairro->setCdBairro($row['CD_BAIRRO']);
                $bairro->setNmBairro($row['NM_BAIRRO']);
                $bairro->setCidade(new Cidade());
                $bairro->getCidade()->setCdCidade($row['CD_CIDADE']);
                $bairro->getCidade()->setNmCidade($row['NM_CIDADE']);
                $bairro->setZona(new Zona());
                $bairro->getZona()->setCdZona($row['CD_ZONA']);
                $bairro->getZona()->setDsZona($row['DS_ZONA']);

                $bairroList->addBairro($bairro);
            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $bairroList;
    }

    public function getBairro($codigo){
        require_once ("beans/Cidade.class.php");
        require_once ("beans/Zona.class.php");
        $bairro = null;
        $this->connection = null;
        $this->connection =  new ConnectionFactory();
        $sql = "SELECT `B`.`CD_BAIRRO`
                              ,`B`.`NM_BAIRRO`
                              ,`B`.`CD_CIDADE`
                              ,`C`.`NM_CIDADE`
                              ,`B`.`CD_ZONA`
                              ,`Z`.`DS_ZONA`
                        FROM `bairro` `B`
                        INNER JOIN `cidade` `C` ON `C`.`CD_CIDADE` = `B`.`CD_CIDADE`
                        INNER JOIN `zona` `Z`   ON `Z`.`CD_ZONA` = `B`.`CD_ZONA`
                    WHERE `CD_BAIRRO` = :codigo";

        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(":codigo", $codigo, PDO::PARAM_INT);
            $stmt->execute();
            if($row =  $stmt->fetch(PDO::FETCH_ASSOC)){
                $bairro = new Bairro();
                $bairro->setCdBairro($row['CD_BAIRRO']);
                $bairro->setNmBairro($row['NM_BAIRRO']);
                $bairro->setCidade(new Cidade());
                $bairro->getCidade()->setCdCidade($row['CD_CIDADE']);
                $bairro->getCidade()->setNmCidade($row['NM_CIDADE']);
                $bairro->setZona(new Zona());
                $bairro->getZona()->setCdZona($row['CD_ZONA']);
                $bairro->getZona()->setDsZona($row['DS_ZONA']);
            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $bairro;
    }

        public function getTotalBairros(){
        $bairro = 0;
        $this->connection = null;
        $this->connection =  new ConnectionFactory();
        $sql = "SELECT COUNT(*) TOTAL FROM bairro";

        try {
            $stmt = $this->connection->prepare($sql);

            $stmt->execute();
            if($row =  $stmt->fetch(PDO::FETCH_ASSOC)){
                $bairro = $row['TOTAL'];
            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $bairro;
    }
}