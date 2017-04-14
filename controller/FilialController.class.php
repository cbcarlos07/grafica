<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 20/02/17
 * Time: 19:04
 */
class FilialController
{
    public function insert (Filial $filial){
        require_once ("../model/FilialDAO.class.php");
        $filialDao = new FilialDAO();
        $retorno = $filialDao->insert($filial);
        return $retorno;
    }

    public function update (Filial $filial){
        require_once ("../model/FilialDAO.class.php");
        $filialDao = new FilialDAO();
        $retorno = $filialDao->update($filial);
        return $retorno;
    }

    public function delete ($filial){
        require_once ("../model/FilialDAO.class.php");
        $filialDao = new FilialDAO();
        $retorno = $filialDao->delete($filial);
        return $retorno;
    }

    public function getList($cliente, $filial, $inicio, $limite){
        require_once ("model/FilialDAO.class.php");
        $filialDao = new FilialDAO();
        $retorno = $filialDao->getList($cliente, $filial, $inicio, $limite);
        return $retorno;
    }

    public function getLista($cliente, $filial, $inicio, $limite){
        require_once ("../model/FilialDAO.class.php");
        $filialDao = new FilialDAO();
        $retorno = $filialDao->getLista($cliente, $filial, $inicio, $limite);
        return $retorno;
    }



    public function getFilial($filial){
        require_once ("model/FilialDAO.class.php");
        $filialDao = new FilialDAO();
        $retorno = $filialDao->getFilial($filial);
        return $retorno;
    }

    public function obterFilial($filial){
        require_once ("../model/FilialDAO.class.php");
        $filialDao = new FilialDAO();
        $retorno = $filialDao->obterFilial($filial);
        return $retorno;
    }

    public function getTotalFilial($cliente){
        require_once ("model/FilialDAO.class.php");
        $filialDao = new FilialDAO();
        $retorno = $filialDao->getTotalFilials($cliente);
        return $retorno;
    }

}