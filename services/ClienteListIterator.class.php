<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 17/02/17
 * Time: 17:02
 */
class ClienteListIterator
{
    protected $clienteList;
    protected $currentCliente = 0;

    public function __construct(ClienteList $clienteList_in) {
        $this->clienteList = $clienteList_in;
    }
    public function getCurrentCliente() {
        if (($this->currentCliente > 0) &&
            ($this->clienteList->getClienteCount() >= $this->currentCliente)) {
            return $this->clienteList->getCliente($this->currentCliente);
        }
    }
    public function getNextCliente() {
        if ($this->hasNextCliente()) {
            return $this->clienteList->getCliente(++$this->currentCliente);
        } else {
            return NULL;
        }
    }
    public function hasNextCliente() {
        if ($this->clienteList->getClienteCount() > $this->currentCliente) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}