<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 17/02/17
 * Time: 17:02
 */
class EstadoListIterator
{
    protected $estadoList;
    protected $currentEstado = 0;

    public function __construct(EstadoList $estadoList_in) {
        $this->estadoList = $estadoList_in;
    }
    public function getCurrentEstado() {
        if (($this->currentEstado > 0) &&
            ($this->estadoList->getEstadoCount() >= $this->currentEstado)) {
            return $this->estadoList->getEstado($this->currentEstado);
        }
    }
    public function getNextEstado() {
        if ($this->hasNextEstado()) {
            return $this->estadoList->getEstado(++$this->currentEstado);
        } else {
            return NULL;
        }
    }
    public function hasNextEstado() {
        if ($this->estadoList->getEstadoCount() > $this->currentEstado) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}