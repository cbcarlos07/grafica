<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 17/02/17
 * Time: 17:02
 */
class PaisListIterator
{
    protected $paisList;
    protected $currentPais = 0;

    public function __construct(PaisList $paisList_in) {
        $this->paisList = $paisList_in;
    }
    public function getCurrentPais() {
        if (($this->currentPais > 0) &&
            ($this->paisList->getPaisCount() >= $this->currentPais)) {
            return $this->paisList->getPais($this->currentPais);
        }
    }
    public function getNextPais() {
        if ($this->hasNextPais()) {
            return $this->paisList->getPais(++$this->currentPais);
        } else {
            return NULL;
        }
    }
    public function hasNextPais() {
        if ($this->paisList->getPaisCount() > $this->currentPais) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}