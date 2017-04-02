<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 20/02/17
 * Time: 19:04
 */
class CidadeController
{
    public function insert (Cidade $cidade){
        require_once ("../model/CidadeDAO.class.php");
        $cidadeDao = new CidadeDAO();
        $retorno = $cidadeDao->insert($cidade);
        return $retorno;
    }

    public function update (Cidade $cidade){
        require_once ("../model/CidadeDAO.class.php");
        $cidadeDao = new CidadeDAO();
        $retorno = $cidadeDao->update($cidade);
        return $retorno;
    }

    public function delete ($cidade){
        require_once ("../model/CidadeDAO.class.php");
        $cidadeDao = new CidadeDAO();
        $retorno = $cidadeDao->delete($cidade);
        return $retorno;
    }

    public function getList($cidade){
        require_once ("model/CidadeDAO.class.php");
        $cidadeDao = new CidadeDAO();
        $retorno = $cidadeDao->getList($cidade);
        return $retorno;
    }

    public function getLista($cidade){
        require_once ("../model/CidadeDAO.class.php");
        $cidadeDao = new CidadeDAO();
        $retorno = $cidadeDao->getLista($cidade);
        return $retorno;
    }



    public function getCidade($cidade){
        require_once ("model/CidadeDAO.class.php");
        $cidadeDao = new CidadeDAO();
        $retorno = $cidadeDao->getCidade($cidade);
        return $retorno;
    }

}