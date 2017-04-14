<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 20/02/17
 * Time: 19:04
 */
class FoneFilialController
{
    public function insert (FoneFilial $foneFilial){
        require_once ("../model/FoneFilialDAO.class.php");
        $foneFilialDao = new FoneFilialDAO();
        $retorno = $foneFilialDao->insert($foneFilial);
        return $retorno;
    }

    public function update (FoneFilial $foneFilial){
        require_once ("../model/FoneFilialDAO.class.php");
        $foneFilialDao = new FoneFilialDAO();
        $retorno = $foneFilialDao->update($foneFilial);
        return $retorno;
    }

    public function delete ($foneFilial){
        require_once ("../model/FoneFilialDAO.class.php");
        $foneFilialDao = new FoneFilialDAO();
        $retorno = $foneFilialDao->delete($foneFilial);
        return $retorno;
    }

    public function getList($foneFilial){
        require_once ("model/FoneFilialDAO.class.php");
        $foneFilialDao = new FoneFilialDAO();
        $retorno = $foneFilialDao->getList($foneFilial);
        return $retorno;
    }


}