<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 20/02/17
 * Time: 19:04
 */
class DepartamentoController
{
    public function insert (Departamento $departamento){
        require_once ("../model/DepartamentoDAO.class.php");
        $departamentoDao = new DepartamentoDAO();
        $retorno = $departamentoDao->insert($departamento);
        return $retorno;
    }

    public function update (Departamento $departamento){
        require_once ("../model/DepartamentoDAO.class.php");
        $departamentoDao = new DepartamentoDAO();
        $retorno = $departamentoDao->update($departamento);
        return $retorno;
    }

    public function delete ($departamento){
        require_once ("../model/DepartamentoDAO.class.php");
        $departamentoDao = new DepartamentoDAO();
        $retorno = $departamentoDao->delete($departamento);
        return $retorno;
    }

    public function getList($cliente, $departamento, $inicio, $limite){
        require_once ("model/DepartamentoDAO.class.php");
        $departamentoDao = new DepartamentoDAO();
        $retorno = $departamentoDao->getList($cliente, $departamento, $inicio, $limite);
        return $retorno;
    }

    public function getLista($cliente, $departamento, $inicio, $limite){
        require_once ("../model/DepartamentoDAO.class.php");
        $departamentoDao = new DepartamentoDAO();
        $retorno = $departamentoDao->getLista($cliente, $departamento, $inicio, $limite);
        return $retorno;
    }



    public function getDepartamento($departamento){
        require_once ("model/DepartamentoDAO.class.php");
        $departamentoDao = new DepartamentoDAO();
        $retorno = $departamentoDao->getDepartamento($departamento);
        return $retorno;
    }

    public function obterDepartamento($departamento){
        require_once ("../model/DepartamentoDAO.class.php");
        $departamentoDao = new DepartamentoDAO();
        $retorno = $departamentoDao->obterDepartamento($departamento);
        return $retorno;
    }

    public function getTotalDepartamento($cliente){
        require_once ("model/DepartamentoDAO.class.php");
        $departamentoDao = new DepartamentoDAO();
        $retorno = $departamentoDao->getTotalDepartamentos($cliente);
        return $retorno;
    }

}