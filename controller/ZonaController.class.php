<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 20/02/17
 * Time: 19:04
 */
class ZonaController
{
    public function insert (Zona $zona){
        require_once ("../model/ZonaDAO.class.php");
        $zonaDao = new ZonaDAO();
        $retorno = $zonaDao->insert($zona);
        return $retorno;
    }

    public function update (Zona $zona){
        require_once ("../model/ZonaDAO.class.php");
        $zonaDao = new ZonaDAO();
        $retorno = $zonaDao->update($zona);
        return $retorno;
    }

    public function delete ($zona){
        require_once ("../model/ZonaDAO.class.php");
        $zonaDao = new ZonaDAO();
        $retorno = $zonaDao->delete($zona);
        return $retorno;
    }

    public function getList($zona){
        require_once ("model/ZonaDAO.class.php");
        $zonaDao = new ZonaDAO();
        $retorno = $zonaDao->getList($zona);
        return $retorno;
    }
    public function getLista($zona){
        require_once ("../model/ZonaDAO.class.php");
        $zonaDao = new ZonaDAO();
        $retorno = $zonaDao->getLista($zona);
        return $retorno;
    }



    public function getZona($zona){
        require_once ("model/ZonaDAO.class.php");
        $zonaDao = new ZonaDAO();
        $retorno = $zonaDao->getZona($zona);
        return $retorno;
    }

}