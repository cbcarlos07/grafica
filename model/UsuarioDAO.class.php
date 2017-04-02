<?php

/**
 * Created by PhpStorm.
 * User: carlos.brito
 * Date: 17/02/2017
 * Time: 14:34
 */
include_once ("ConnectionFactory.class.php");

class UsuarioDAO
{
     private $connection = null;

     public function insert (Usuario $usuario){
         $this->connection =  null;
         $teste = false;
         $this->connection = new ConnectionFactory();
         $this->connection->beginTransaction();
         try{
             $query = "INSERT INTO usuario 
                      (CD_USUARIO, NM_USUARIO, NM_SOBRENOME, DS_LOGIN, DS_SENHA, SN_ATIVO, CD_CARGO, NR_CPF, NR_RG, DS_FOTO, SN_SENHA_ATUAL) VALUES 
                      (NULL, :usuario, :sobrenome, :login , MD5(:senha), :ativo, :cargo, :cpf, :rg, :foto, :atual)";

             $stmt = $this->connection->prepare($query);
             $stmt->bindValue(":usuario", $usuario->getNmUsuario(), PDO::PARAM_STR);
             $stmt->bindValue(":sobrenome", $usuario->getNmSobrenome(), PDO::PARAM_STR);
             $stmt->bindValue(":login", $usuario->getDsLogin(), PDO::PARAM_STR);
             $stmt->bindValue(":senha", $usuario->getDsSenha(), PDO::PARAM_STR);
             $stmt->bindValue(":ativo", $usuario->getSnAtivo(), PDO::PARAM_STR);
             $stmt->bindValue(":cargo", $usuario->getCargo()->getCdCargo(), PDO::PARAM_INT);
             $stmt->bindValue(":cpf", $usuario->getNrCPF(), PDO::PARAM_STR);
             $stmt->bindValue(":rg", $usuario->getNrRg(), PDO::PARAM_STR);
             $stmt->bindValue(":foto", $usuario->getDsFoto(), PDO::PARAM_STR);
             $stmt->bindValue(":atual", $usuario->getSnSenhaAtual(), PDO::PARAM_STR);
             $stmt->execute();
             $this->connection->commit();
             $teste =  true;

             $this->connection =  null;
         }catch(PDOException $exception){
             echo "Erro: ".$exception->getMessage();
         }
         return $teste;
     }

    public function update (Usuario $usuario){
        $this->connection =  null;
        $teste = false;
        $this->connection = new ConnectionFactory();
        $this->connection->beginTransaction();
        try{
            $query = "UPDATE usuario SET 
                      NM_USUARIO = :usuario, NM_SOBRENOME = :sobrenome, DS_LOGIN = :login, DS_SENHA = MD5(:senha)
                      , SN_ATIVO = :ativo, CD_CARGO = :cargo, NR_CPF = :cpf, NR_RG = :rg, DS_FOTO = :foto
                      ,SN_SENHA_ATUAL = :atual
                      WHERE CD_USUARIO = :codigo";
            $stmt = $this->connection->prepare($query);
            $stmt->bindValue(":usuario", $usuario->getNmUsuario(), PDO::PARAM_STR);
            $stmt->bindValue(":sobrenome", $usuario->getNmSobrenome(), PDO::PARAM_STR);
            $stmt->bindValue(":login", $usuario->getDsLogin(), PDO::PARAM_STR);
            $stmt->bindValue(":senha", $usuario->getDsSenha(), PDO::PARAM_STR);
            $stmt->bindValue(":ativo", $usuario->getSnAtivo(), PDO::PARAM_STR);
            $stmt->bindValue(":cargo", $usuario->getCargo()->getCdCargo(), PDO::PARAM_INT);
            $stmt->bindValue(":cpf", $usuario->getNrCPF(), PDO::PARAM_STR);
            $stmt->bindValue(":rg", $usuario->getNrRg(), PDO::PARAM_STR);
            $stmt->bindValue(":foto", $usuario->getDsFoto(), PDO::PARAM_STR);
            $stmt->bindValue(":codigo", $usuario->getCdUsuario(), PDO::PARAM_INT);
            $stmt->bindValue(":atual", $usuario->getSnSenhaAtual(), PDO::PARAM_STR);
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
            $query = "DELETE FROM usuario WHERE CD_USUARIO = :codigo";
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
        require_once ("services/UsuarioList.class.php");
        require_once ("beans/Usuario.class.php");
        require_once ("beans/Cargo.class.php");

        $this->connection = null;

        $this->connection = new ConnectionFactory();

        $usuarioList = new UsuarioList();

        try {

                $sql = "SELECT E.*
                              ,C.DS_CARGO
                          FROM usuario E
                          INNER JOIN cargo C ON C.CD_CARGO = E.CD_CARGO
                          WHERE E.NM_USUARIO LIKE :nome";
                $stmt = $this->connection->prepare($sql);
                $stmt->bindValue(":nome", "%$nome%", PDO::PARAM_STR);

            $stmt->execute();
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $usuario = new Usuario();
                $usuario->setCdUsuario($row['CD_USUARIO']);
                $usuario->setNmUsuario($row['NM_USUARIO']);
                $usuario->setNmSobrenome($row['NM_SOBRENOME']);
                $usuario->setDsLogin($row['DS_LOGIN']);
                $usuario->setDsSenha($row['DS_SENHA']);
                $usuario->setSnAtivo($row['SN_ATIVO']);
                $usuario->setCargo(new Cargo());
                $usuario->getCargo()->setCdCargo($row['CD_CARGO']);
                $usuario->getCargo()->setDsCargo($row['DS_CARGO']);
                $usuario->setDsFoto($row['DS_FOTO']);
                $usuarioList->addUsuario($usuario);
            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $usuarioList;
    }

    public function getLista($nome){
        require_once ("../services/UsuarioList.class.php");
        require_once ("../beans/Usuario.class.php");

        $this->connection = null;

        $this->connection = new ConnectionFactory();

        $usuarioList = new UsuarioList();

        try {

            $sql = "SELECT *
                          FROM usuario E
                          JOIN cargo C USING (CD_CARGO)
                          WHERE E.NM_USUARIO LIKE :nome";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(":nome", "%$nome%", PDO::PARAM_STR);

            $stmt->execute();
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $usuario = new Usuario();
                $usuario->setCdUsuario($row['CD_USUARIO']);
                $usuario->setNmUsuario($row['NM_USUARIO']);
                $usuario->setNmSobrenome($row['NM_SOBRENOME']);
                $usuario->setDsLogin($row['DS_LOGIN']);
                $usuario->setDsSenha($row['DS_SENHA']);
                $usuario->setSnAtivo($row['SN_ATIVO']);
                $usuario->setCargo(new Cargo());
                $usuario->getCargo()->setCdCargo($row['CD_CARGO']);
                $usuario->getCargo()->setDsCargo($row['DS_CARGO']);
                $usuario->setDsFoto($row['DS_FOTO']);
                $usuarioList->addUsuario($usuario);
            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $usuarioList;
    }

    public function getUsuario($codigo){
        require_once "beans/Usuario.class.php";
        require_once "beans/Cargo.class.php";
        $usuario = null;
        $connection = null;
        $this->connection =  new ConnectionFactory();
        $sql = "SELECT *
                FROM usuario E
                INNER JOIN cargo ON E.CD_CARGO = cargo.CD_CARGO       
                WHERE E.CD_USUARIO= :codigo";

        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(":codigo", $codigo, PDO::PARAM_INT);
            $stmt->execute();
            if($row =  $stmt->fetch(PDO::FETCH_ASSOC)){
                $usuario = new Usuario();
                $usuario->setCdUsuario($row['CD_USUARIO']);
                $usuario->setNmUsuario($row['NM_USUARIO']);
                $usuario->setNmSobrenome($row['NM_SOBRENOME']);
                $usuario->setDsLogin($row['DS_LOGIN']);
                $usuario->setDsSenha($row['DS_SENHA']);
                $usuario->setSnAtivo($row['SN_ATIVO']);
                $usuario->setNrCPF($row['NR_CPF']);
                $usuario->setNrRg($row['NR_RG']);
                $usuario->setCargo(new Cargo());
                $usuario->getCargo()->setCdCargo($row['CD_CARGO']);
                $usuario->getCargo()->setDsCargo($row['DS_CARGO']);
                $usuario->setDsFoto($row['DS_FOTO']);
            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $usuario;
    }

    public function getLoginUser($username, $password){
        require_once "../beans/Usuario.class.php";
        require_once "../beans/Cargo.class.php";
        $usuario = null;
        $connection = null;
        $this->connection =  new ConnectionFactory();
        $sql = "SELECT *
                          FROM usuario E
                          INNER JOIN cargo ON E.CD_CARGO = cargo.CD_CARGO
                          WHERE E.DS_LOGIN = :login
                          
                          AND   E.DS_SENHA = MD5(:senha)";

        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(":login", $username, PDO::PARAM_STR);
            $stmt->bindValue(":senha", $password, PDO::PARAM_STR);
            $stmt->execute();
            if($row =  $stmt->fetch(PDO::FETCH_ASSOC)){
                $usuario = new Usuario();
                $usuario->setCdUsuario($row['CD_USUARIO']);
                $usuario->setNmUsuario($row['NM_USUARIO']);
                $usuario->setNmSobrenome($row['NM_SOBRENOME']);
                $usuario->setDsLogin($row['DS_LOGIN']);
                $usuario->setDsSenha($row['DS_SENHA']);
                $usuario->setSnAtivo($row['SN_ATIVO']);
                $usuario->setNrCPF($row['NR_CPF']);
                $usuario->setNrRg($row['NR_RG']);
                $usuario->setCargo(new Cargo());
                $usuario->getCargo()->setCdCargo($row['CD_CARGO']);
                $usuario->getCargo()->setDsCargo($row['DS_CARGO']);
                $usuario->setDsFoto($row['DS_FOTO']);
                $usuario->setSnSenhaAtual($row['SN_SENHA_ATUAL']);
            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $usuario;
    }

    public function getLoginUserBool($username, $password){
        require_once "../beans/Usuario.class.php";
        require_once "../beans/Cargo.class.php";
        $usuario = false;
        $connection = null;
        $this->connection =  new ConnectionFactory();
        $sql = "SELECT *
                          FROM usuario E
                          INNER JOIN cargo ON E.CD_CARGO = cargo.CD_CARGO
                          WHERE E.DS_LOGIN = :login
                          
                          AND   E.DS_SENHA = MD5(:senha)";

        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(":login", $username, PDO::PARAM_STR);
            $stmt->bindValue(":senha", $password, PDO::PARAM_STR);
            $stmt->execute();
            if($row =  $stmt->fetch(PDO::FETCH_ASSOC)){
                $usuario = true;
            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $usuario;
    }

}