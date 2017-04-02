<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 17/02/17
 * Time: 16:49
 */
class ClienteList
{
   private $_cliente;
   private $_clienteCount;

    /**
     * ClienteList constructor.
     * @param $_cliente
     */
    public function __construct()
    {

    }

    /**
     * @return mixed
     */
    public function getClienteCount()
    {
        return $this->_clienteCount;
    }

    /**
     * @param mixed $clienteCount
     * @return ClienteList
     */
    public function setClienteCount($newCount)
    {
        $this->_clienteCount = $newCount;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCliente($_clienteNumberToGet)
    {
        if((is_numeric($_clienteNumberToGet)) && ($_clienteNumberToGet <= $this->getClienteCount())){
            return $this->_cliente[$_clienteNumberToGet];
        }else{
            return null;
        }
    }

    public function addCliente(Cliente $_cliente_in) {
        $this->setClienteCount($this->getClienteCount() + 1);
        $this->_cliente[$this->getClienteCount()] = $_cliente_in;
        return $this->getClienteCount();
    }
    public function removeCliente(Cliente $_cliente_in) {
        $counter = 0;
        while (++$counter <= $this->getClienteCount()) {
            if ($_cliente_in->getAuthorAndTitle() ==
                $this->_cliente[$counter]->getAuthorAndTitle())
            {
                for ($x = $counter; $x < $this->getClienteCount(); $x++) {
                    $this->_cliente[$x] = $this->_cliente[$x + 1];
                }
                $this->setClienteCount($this->getClienteCount() - 1);
            }
        }
        return $this->getClienteCount();
    }


}