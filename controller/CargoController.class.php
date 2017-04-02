<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 20/02/17
 * Time: 19:04
 */
class CargoController
{
    public function insert (Cargo $cargo){
        require_once ("../model/CargoDAO.class.php");
        $cargoDao = new CargoDAO();
        $retorno = $cargoDao->insert($cargo);
        return $retorno;
    }

    public function update (Cargo $cargo){
        require_once ("../model/CargoDAO.class.php");
        $cargoDao = new CargoDAO();
        $retorno = $cargoDao->update($cargo);
        return $retorno;
    }

    public function delete ($cargo){
        require_once ("../model/CargoDAO.class.php");
        $cargoDao = new CargoDAO();
        $retorno = $cargoDao->delete($cargo);
        return $retorno;
    }

    public function getListByCargo ($cargo){
        require_once ("model/CargoDAO.class.php");
        $cargoDao = new CargoDAO();
        $retorno = $cargoDao->getListByCargo($cargo);
        return $retorno;
    }

    public function getListaByCargo ($cargo){
        require_once ("../model/CargoDAO.class.php");
        $cargoDao = new CargoDAO();
        $retorno = $cargoDao->getListaByCargo($cargo);
        return $retorno;
    }



    public function getCargo($cargo){
        require_once ("model/CargoDAO.class.php");
        $cargoDao = new CargoDAO();
        $retorno = $cargoDao->getCargo($cargo);
        return $retorno;
    }

}