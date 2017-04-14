<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 17/02/17
 * Time: 17:02
 */
class FoneDepartamentoListIterator
{
    protected $foneDepartamentoList;
    protected $currentFoneDepartamento = 0;

    public function __construct(FoneDepartamentoList $foneDepartamentoList_in) {
        $this->foneDepartamentoList = $foneDepartamentoList_in;
    }
    public function getCurrentFoneDepartamento() {
        if (($this->currentFoneDepartamento > 0) &&
            ($this->foneDepartamentoList->getFoneDepartamentoCount() >= $this->currentFoneDepartamento)) {
            return $this->foneDepartamentoList->getFoneDepartamento($this->currentFoneDepartamento);
        }
    }
    public function getNextFoneDepartamento() {
        if ($this->hasNextFoneDepartamento()) {
            return $this->foneDepartamentoList->getFoneDepartamento(++$this->currentFoneDepartamento);
        } else {
            return NULL;
        }
    }
    public function hasNextFoneDepartamento() {
        if ($this->foneDepartamentoList->getFoneDepartamentoCount() > $this->currentFoneDepartamento) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}