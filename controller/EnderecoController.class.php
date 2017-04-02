<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 20/02/17
 * Time: 19:04
 */
class EnderecoController
{
    public function insert (Endereco $endereco){
        require_once ("../model/EnderecoDAO.class.php");
        $enderecoDao = new EnderecoDAO();
        $retorno = $enderecoDao->insert($endereco);
        return $retorno;
    }

    public function update (Endereco $endereco){
        require_once ("../model/EnderecoDAO.class.php");
        $enderecoDao = new EnderecoDAO();
        $retorno = $enderecoDao->update($endereco);
        return $retorno;
    }

    public function delete ($endereco){
        require_once ("../model/EnderecoDAO.class.php");
        $enderecoDao = new EnderecoDAO();
        $retorno = $enderecoDao->delete($endereco);
        return $retorno;
    }

    public function getList($endereco, $cidade){
        require_once ("model/EnderecoDAO.class.php");
        $enderecoDao = new EnderecoDAO();
        $retorno = $enderecoDao->getList($endereco, $cidade);
        return $retorno;
    }



    public function getEndereco($endereco){
        require_once ("model/EnderecoDAO.class.php");
        $enderecoDao = new EnderecoDAO();
        $retorno = $enderecoDao->getEndereco($endereco);
        return $retorno;
    }

    public function getEnderecoById($endereco){
        require_once ("../model/EnderecoDAO.class.php");
        $enderecoDao = new EnderecoDAO();
        $retorno = $enderecoDao->getEnderecoById($endereco);
        return $retorno;
    }

    public function getEnderecoByCep($cep){
        require_once ("../model/EnderecoDAO.class.php");
        $enderecoDao = new EnderecoDAO();
        $retorno = $enderecoDao->getEnderecoByCep($cep);
        return $retorno;
    }

}