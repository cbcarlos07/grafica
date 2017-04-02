<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 20/02/17
 * Time: 19:04
 */
class BairroController
{
    public function insert (Bairro $bairro){
        require_once ("../model/BairroDAO.class.php");
        $bairroDao = new BairroDAO();
        $retorno = $bairroDao->insert($bairro);
        return $retorno;
    }

    public function update (Bairro $bairro){
        require_once ("../model/BairroDAO.class.php");
        $bairroDao = new BairroDAO();
        $retorno = $bairroDao->update($bairro);
        return $retorno;
    }

    public function delete ($bairro){
        require_once ("../model/BairroDAO.class.php");
        $bairroDao = new BairroDAO();
        $retorno = $bairroDao->delete($bairro);
        return $retorno;
    }

    public function getListByBairro ($bairro, $inicio, $limite){
        require_once ("model/BairroDAO.class.php");
        $bairroDao = new BairroDAO();
        $retorno = $bairroDao->getListByBairro($bairro, $inicio, $limite);
        return $retorno;
    }

    public function getListByCidade($bairro, $cidade){
        require_once ("../model/BairroDAO.class.php");
        $bairroDao = new BairroDAO();
        $retorno = $bairroDao->getListByCidade($bairro, $cidade);
        return $retorno;
    }

    public function getListByZona($bairro, $cidade, $zona){
        require_once ("../model/BairroDAO.class.php");
        $bairroDao = new BairroDAO();
        $retorno = $bairroDao->getListByZona($bairro, $cidade, $zona);
        return $retorno;
    }

    public function getBairro($bairro){
        require_once ("model/BairroDAO.class.php");
        $bairroDao = new BairroDAO();
        $retorno = $bairroDao->getBairro($bairro);
        return $retorno;
    }

    public function getTotalBairros(){
        require_once ("model/BairroDAO.class.php");
        $bairroDao = new BairroDAO();
        $retorno = $bairroDao->getTotalBairros();
        return $retorno;
    }

}