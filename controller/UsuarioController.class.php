<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 20/02/17
 * Time: 19:04
 */
class UsuarioController
{
    public function insert (Usuario $usuario){
        require_once ("../model/UsuarioDAO.class.php");
        $usuarioDao = new UsuarioDAO();
        $retorno = $usuarioDao->insert($usuario);
        return $retorno;
    }

    public function update (Usuario $usuario){
        require_once ("../model/UsuarioDAO.class.php");
        $usuarioDao = new UsuarioDAO();
        $retorno = $usuarioDao->update($usuario);
        return $retorno;
    }

    public function delete ($usuario){
        require_once ("../model/UsuarioDAO.class.php");
        $usuarioDao = new UsuarioDAO();
        $retorno = $usuarioDao->delete($usuario);
        return $retorno;
    }

    public function getList($usuario){
        require_once ("model/UsuarioDAO.class.php");
        $usuarioDao = new UsuarioDAO();
        $retorno = $usuarioDao->getList($usuario);
        return $retorno;
    }

    public function getLista($usuario){
        require_once ("../model/UsuarioDAO.class.php");
        $usuarioDao = new UsuarioDAO();
        $retorno = $usuarioDao->getLista($usuario);
        return $retorno;
    }

    public function getUsuario($usuario){
        require_once ("model/UsuarioDAO.class.php");
        $usuarioDao = new UsuarioDAO();
        $retorno = $usuarioDao->getUsuario($usuario);
        return $retorno;
    }
    public function getLoginUser($username, $password){
        require_once ("../model/UsuarioDAO.class.php");
        $usuarioDao = new UsuarioDAO();
        $retorno = $usuarioDao->getLoginUser($username, $password);
        return $retorno;
    }

    public function getLoginUserBool($username, $password){
        require_once ("../model/UsuarioDAO.class.php");
        $usuarioDao = new UsuarioDAO();
        $retorno = $usuarioDao->getLoginUserBool($username, $password);
        return $retorno;
    }
}