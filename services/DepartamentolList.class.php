<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 17/02/17
 * Time: 16:49
 */
class DepartamentoList
{
   private $_departamento;
   private $_departamentoCount;

    /**
     * DepartamentoList constructor.
     * @param $_departamento
     */
    public function __construct()
    {

    }

    /**
     * @return mixed
     */
    public function getDepartamentoCount()
    {
        return $this->_departamentoCount;
    }

    /**
     * @param mixed $departamentoCount
     * @return DepartamentoList
     */
    public function setDepartamentoCount($newCount)
    {
        $this->_departamentoCount = $newCount;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDepartamento($_departamentoNumberToGet)
    {
        if((is_numeric($_departamentoNumberToGet)) && ($_departamentoNumberToGet <= $this->getDepartamentoCount())){
            return $this->_departamento[$_departamentoNumberToGet];
        }else{
            return null;
        }
    }

    public function addDepartamento(Departamento $_departamento_in) {
        $this->setDepartamentoCount($this->getDepartamentoCount() + 1);
        $this->_departamento[$this->getDepartamentoCount()] = $_departamento_in;
        return $this->getDepartamentoCount();
    }
    public function removeDepartamento(Departamento $_departamento_in) {
        $counter = 0;
        while (++$counter <= $this->getDepartamentoCount()) {
            if ($_departamento_in->getAuthorAndTitle() ==
                $this->_departamento[$counter]->getAuthorAndTitle())
            {
                for ($x = $counter; $x < $this->getDepartamentoCount(); $x++) {
                    $this->_departamento[$x] = $this->_departamento[$x + 1];
                }
                $this->setDepartamentoCount($this->getDepartamentoCount() - 1);
            }
        }
        return $this->getDepartamentoCount();
    }


}