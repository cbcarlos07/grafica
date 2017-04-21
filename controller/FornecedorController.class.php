<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 20/02/17
 * Time: 19:04
 */
class FornecedorController
{
    public function insert (Fornecedor $fornecedor){
        require_once ("../model/FornecedorDAO.class.php");
        $fornecedorDao = new FornecedorDAO();
        $retorno = $fornecedorDao->insert($fornecedor);
        return $retorno;
    }

    public function update (Fornecedor $fornecedor){
        require_once ("../model/FornecedorDAO.class.php");
        $fornecedorDao = new FornecedorDAO();
        $retorno = $fornecedorDao->update($fornecedor);
        return $retorno;
    }

    public function delete ($fornecedor){
        require_once ("../model/FornecedorDAO.class.php");
        $fornecedorDao = new FornecedorDAO();
        $retorno = $fornecedorDao->delete($fornecedor);
        return $retorno;
    }

    public function getList($fornecedor, $inicio, $limite){
        require_once ("model/FornecedorDAO.class.php");
        $fornecedorDao = new FornecedorDAO();
        $retorno = $fornecedorDao->getList($fornecedor, $inicio, $limite);
        return $retorno;
    }

    public function getLista($fornecedor){
        require_once ("../model/FornecedorDAO.class.php");
        $fornecedorDao = new FornecedorDAO();
        $retorno = $fornecedorDao->getLista($fornecedor);
        return $retorno;
    }



    public function getFornecedor($fornecedor){
        require_once ("model/FornecedorDAO.class.php");
        $fornecedorDao = new FornecedorDAO();
        $retorno = $fornecedorDao->getFornecedor($fornecedor);
        return $retorno;
    }

    public function obterFornecedor($fornecedor){
        require_once ("../model/FornecedorDAO.class.php");
        $fornecedorDao = new FornecedorDAO();
        $retorno = $fornecedorDao->obterFornecedor($fornecedor);
        return $retorno;
    }

    public function getTotalFornecedor(){
        require_once ("model/FornecedorDAO.class.php");
        $fornecedorDao = new FornecedorDAO();
        $retorno = $fornecedorDao->getTotalFornecedor();
        return $retorno;
    }

}