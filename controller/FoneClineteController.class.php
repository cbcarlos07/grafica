<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 20/02/17
 * Time: 19:04
 */
class FoneClienteController
{
    public function insert (FoneCliente $foneCliente){
        require_once ("../model/FoneClienteDAO.class.php");
        $foneClienteDao = new FoneClienteDAO();
        $retorno = $foneClienteDao->insert($foneCliente);
        return $retorno;
    }

    public function update (FoneCliente $foneCliente){
        require_once ("../model/FoneClienteDAO.class.php");
        $foneClienteDao = new FoneClienteDAO();
        $retorno = $foneClienteDao->update($foneCliente);
        return $retorno;
    }

    public function delete ($foneCliente){
        require_once ("../model/FoneClienteDAO.class.php");
        $foneClienteDao = new FoneClienteDAO();
        $retorno = $foneClienteDao->delete($foneCliente);
        return $retorno;
    }

    public function getList($foneCliente){
        require_once ("model/FoneClienteDAO.class.php");
        $foneClienteDao = new FoneClienteDAO();
        $retorno = $foneClienteDao->getList($foneCliente);
        return $retorno;
    }


}