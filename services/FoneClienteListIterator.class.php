<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 17/02/17
 * Time: 17:02
 */
class FoneClienteListIterator
{
    protected $foneClienteList;
    protected $currentFoneCliente = 0;

    public function __construct(FoneClienteList $foneClienteList_in) {
        $this->foneClienteList = $foneClienteList_in;
    }
    public function getCurrentFoneCliente() {
        if (($this->currentFoneCliente > 0) &&
            ($this->foneClienteList->getFoneClienteCount() >= $this->currentFoneCliente)) {
            return $this->foneClienteList->getFoneCliente($this->currentFoneCliente);
        }
    }
    public function getNextFoneCliente() {
        if ($this->hasNextFoneCliente()) {
            return $this->foneClienteList->getFoneCliente(++$this->currentFoneCliente);
        } else {
            return NULL;
        }
    }
    public function hasNextFoneCliente() {
        if ($this->foneClienteList->getFoneClienteCount() > $this->currentFoneCliente) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}