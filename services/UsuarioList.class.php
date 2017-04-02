<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 17/02/17
 * Time: 16:49
 */
class UsuarioList
{
   private $_usuario;
   private $_usuarioCount;

    /**
     * UsuarioList constructor.
     * @param $_usuario
     */
    public function __construct()
    {

    }

    /**
     * @return mixed
     */
    public function getUsuarioCount()
    {
        return $this->_usuarioCount;
    }

    /**
     * @param mixed $usuarioCount
     * @return UsuarioList
     */
    public function setUsuarioCount($newCount)
    {
        $this->_usuarioCount = $newCount;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUsuario($_usuarioNumberToGet)
    {
        if((is_numeric($_usuarioNumberToGet)) && ($_usuarioNumberToGet <= $this->getUsuarioCount())){
            return $this->_usuario[$_usuarioNumberToGet];
        }else{
            return null;
        }
    }

    public function addUsuario(Usuario $_usuario_in) {
        $this->setUsuarioCount($this->getUsuarioCount() + 1);
        $this->_usuario[$this->getUsuarioCount()] = $_usuario_in;
        return $this->getUsuarioCount();
    }
    public function removeUsuario(Usuario $_usuario_in) {
        $counter = 0;
        while (++$counter <= $this->getUsuarioCount()) {
            if ($_usuario_in->getAuthorAndTitle() ==
                $this->_usuario[$counter]->getAuthorAndTitle())
            {
                for ($x = $counter; $x < $this->getUsuarioCount(); $x++) {
                    $this->_usuario[$x] = $this->_usuario[$x + 1];
                }
                $this->setUsuarioCount($this->getUsuarioCount() - 1);
            }
        }
        return $this->getUsuarioCount();
    }


}