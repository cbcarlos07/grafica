<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 20/02/17
 * Time: 19:04
 */
class TpLogradouroController
{
    public function insert (TpLogradouro $tpLogradouro){
        require_once ("../model/TpLogradouroDAO.class.php");
        $tpLogradouroDao = new TpLogradouroDAO();
        $retorno = $tpLogradouroDao->insert($tpLogradouro);
        return $retorno;
    }

    public function update (TpLogradouro $tpLogradouro){
        require_once ("../model/TpLogradouroDAO.class.php");
        $tpLogradouroDao = new TpLogradouroDAO();
        $retorno = $tpLogradouroDao->update($tpLogradouro);
        return $retorno;
    }

    public function delete ($tpLogradouro){
        require_once ("../model/TpLogradouroDAO.class.php");
        $tpLogradouroDao = new TpLogradouroDAO();
        $retorno = $tpLogradouroDao->delete($tpLogradouro);
        return $retorno;
    }

    public function getList($tpLogradouro){
        require_once ("model/TpLogradouroDAO.class.php");
        $tpLogradouroDao = new TpLogradouroDAO();
        $retorno = $tpLogradouroDao->getList($tpLogradouro);
        return $retorno;
    }

    public function getLista($tpLogradouro){
        require_once ("../model/TpLogradouroDAO.class.php");
        $tpLogradouroDao = new TpLogradouroDAO();
        $retorno = $tpLogradouroDao->getLista($tpLogradouro);
        return $retorno;
    }



    public function getTpLogradouro($tpLogradouro){
        require_once ("model/TpLogradouroDAO.class.php");
        $tpLogradouroDao = new TpLogradouroDAO();
        $retorno = $tpLogradouroDao->getTpLogradouro($tpLogradouro);
        return $retorno;
    }

}