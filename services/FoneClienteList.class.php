<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 17/02/17
 * Time: 16:49
 */
class FoneClienteList
{
   private $_foneCliente;
   private $_foneClienteCount;

    /**
     * FoneClienteList constructor.
     * @param $_foneCliente
     */
    public function __construct()
    {

    }

    /**
     * @return mixed
     */
    public function getFoneClienteCount()
    {
        return $this->_foneClienteCount;
    }

    /**
     * @param mixed $foneClienteCount
     * @return FoneClienteList
     */
    public function setFoneClienteCount($newCount)
    {
        $this->_foneClienteCount = $newCount;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFoneCliente($_foneClienteNumberToGet)
    {
        if((is_numeric($_foneClienteNumberToGet)) && ($_foneClienteNumberToGet <= $this->getFoneClienteCount())){
            return $this->_foneCliente[$_foneClienteNumberToGet];
        }else{
            return null;
        }
    }

    public function addFoneCliente(FoneCliente $_foneCliente_in) {
        $this->setFoneClienteCount($this->getFoneClienteCount() + 1);
        $this->_foneCliente[$this->getFoneClienteCount()] = $_foneCliente_in;
        return $this->getFoneClienteCount();
    }
    public function removeFoneCliente(FoneCliente $_foneCliente_in) {
        $counter = 0;
        while (++$counter <= $this->getFoneClienteCount()) {
            if ($_foneCliente_in->getAuthorAndTitle() ==
                $this->_foneCliente[$counter]->getAuthorAndTitle())
            {
                for ($x = $counter; $x < $this->getFoneClienteCount(); $x++) {
                    $this->_foneCliente[$x] = $this->_foneCliente[$x + 1];
                }
                $this->setFoneClienteCount($this->getFoneClienteCount() - 1);
            }
        }
        return $this->getFoneClienteCount();
    }


}