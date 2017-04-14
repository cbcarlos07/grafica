<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 20/02/17
 * Time: 19:04
 */
class FoneDepartamentoController
{
    public function insert (FoneDepartamento $foneDepartamento){
        require_once ("../model/FoneDepartamentoDAO.class.php");
        $foneDepartamentoDao = new FoneDepartamentoDAO();
        $retorno = $foneDepartamentoDao->insert($foneDepartamento);
        return $retorno;
    }

    public function update (FoneDepartamento $foneDepartamento){
        require_once ("../model/FoneDepartamentoDAO.class.php");
        $foneDepartamentoDao = new FoneDepartamentoDAO();
        $retorno = $foneDepartamentoDao->update($foneDepartamento);
        return $retorno;
    }

    public function delete ($foneDepartamento){
        require_once ("../model/FoneDepartamentoDAO.class.php");
        $foneDepartamentoDao = new FoneDepartamentoDAO();
        $retorno = $foneDepartamentoDao->delete($foneDepartamento);
        return $retorno;
    }

    public function getList($foneDepartamento){
        require_once ("model/FoneDepartamentoDAO.class.php");
        $foneDepartamentoDao = new FoneDepartamentoDAO();
        $retorno = $foneDepartamentoDao->getList($foneDepartamento);
        return $retorno;
    }


}