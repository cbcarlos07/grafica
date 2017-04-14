<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 17/02/17
 * Time: 17:02
 */
class DepartamentoListIterator
{
    protected $departamentoList;
    protected $currentDepartamento = 0;

    public function __construct(DepartamentoList $departamentoList_in) {
        $this->departamentoList = $departamentoList_in;
    }
    public function getCurrentDepartamento() {
        if (($this->currentDepartamento > 0) &&
            ($this->departamentoList->getDepartamentoCount() >= $this->currentDepartamento)) {
            return $this->departamentoList->getDepartamento($this->currentDepartamento);
        }
    }
    public function getNextDepartamento() {
        if ($this->hasNextDepartamento()) {
            return $this->departamentoList->getDepartamento(++$this->currentDepartamento);
        } else {
            return NULL;
        }
    }
    public function hasNextDepartamento() {
        if ($this->departamentoList->getDepartamentoCount() > $this->currentDepartamento) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}