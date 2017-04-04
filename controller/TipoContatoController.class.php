<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 20/02/17
 * Time: 19:04
 */
class TipoContatoController
{
    public function insert (TipoContato $tipoContato){
        require_once ("../model/TipoContatoDAO.class.php");
        $tipoContatoDao = new TipoContatoDAO();
        $retorno = $tipoContatoDao->insert($tipoContato);
        return $retorno;
    }

    public function update (TipoContato $tipoContato){
        require_once ("../model/TipoContatoDAO.class.php");
        $tipoContatoDao = new TipoContatoDAO();
        $retorno = $tipoContatoDao->update($tipoContato);
        return $retorno;
    }

    public function delete ($tipoContato){
        require_once ("../model/TipoContatoDAO.class.php");
        $tipoContatoDao = new TipoContatoDAO();
        $retorno = $tipoContatoDao->delete($tipoContato);
        return $retorno;
    }

    public function getList($tipoContato){
        require_once ("model/TipoContatoDAO.class.php");
        $tipoContatoDao = new TipoContatoDAO();
        $retorno = $tipoContatoDao->getList($tipoContato);
        return $retorno;
    }
    public function getLista($tipoContato){
        require_once ("../model/TipoContatoDAO.class.php");
        $tipoContatoDao = new TipoContatoDAO();
        $retorno = $tipoContatoDao->getLista($tipoContato);
        return $retorno;
    }



    public function getTipoContato($tipoContato){
        require_once ("model/TipoContatoDAO.class.php");
        $tipoContatoDao = new TipoContatoDAO();
        $retorno = $tipoContatoDao->getTipoContato($tipoContato);
        return $retorno;
    }

}