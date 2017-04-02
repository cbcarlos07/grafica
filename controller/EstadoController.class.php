<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 20/02/17
 * Time: 19:04
 */
class EstadoController
{
    public function insert (Estado $estado){
        require_once ("../model/EstadoDAO.class.php");
        $estadoDao = new EstadoDAO();
        $retorno = $estadoDao->insert($estado);
        return $retorno;
    }

    public function update (Estado $estado){
        require_once ("../model/EstadoDAO.class.php");
        $estadoDao = new EstadoDAO();
        $retorno = $estadoDao->update($estado);
        return $retorno;
    }

    public function delete ($estado){
        require_once ("../model/EstadoDAO.class.php");
        $estadoDao = new EstadoDAO();
        $retorno = $estadoDao->delete($estado);
        return $retorno;
    }

    public function getList($estado){
        require_once ("model/EstadoDAO.class.php");
        $estadoDao = new EstadoDAO();
        $retorno = $estadoDao->getList($estado);
        return $retorno;
    }

    public function getLista($estado){
        require_once ("../model/EstadoDAO.class.php");
        $estadoDao = new EstadoDAO();
        $retorno = $estadoDao->getLista($estado);
        return $retorno;
    }



    public function getEstado($estado){
        require_once ("model/EstadoDAO.class.php");
        $estadoDao = new EstadoDAO();
        $retorno = $estadoDao->getEstado($estado);
        return $retorno;
    }

}