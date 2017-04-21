<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 20/02/17
 * Time: 19:04
 */
class FoneFornecedorController
{
    public function insert (FoneFornecedor $foneFornecedor){
        require_once ("../model/FoneFornecedorDAO.class.php");
        $foneFornecedorDao = new FoneFornecedorDAO();
        $retorno = $foneFornecedorDao->insert($foneFornecedor);
        return $retorno;
    }

    public function update (FoneFornecedor $foneFornecedor){
        require_once ("../model/FoneFornecedorDAO.class.php");
        $foneFornecedorDao = new FoneFornecedorDAO();
        $retorno = $foneFornecedorDao->update($foneFornecedor);
        return $retorno;
    }

    public function delete ($foneFornecedor){
        require_once ("../model/FoneFornecedorDAO.class.php");
        $foneFornecedorDao = new FoneFornecedorDAO();
        $retorno = $foneFornecedorDao->delete($foneFornecedor);
        return $retorno;
    }

    public function getList($foneFornecedor){
        require_once ("model/FoneFornecedorDAO.class.php");
        $foneFornecedorDao = new FoneFornecedorDAO();
        $retorno = $foneFornecedorDao->getList($foneFornecedor);
        return $retorno;
    }


}