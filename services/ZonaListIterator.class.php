<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 17/02/17
 * Time: 17:02
 */
class ZonaListIterator
{
    protected $zonaList;
    protected $currentZona = 0;

    public function __construct(ZonaList $zonaList_in) {
        $this->zonaList = $zonaList_in;
    }
    public function getCurrentZona() {
        if (($this->currentZona > 0) &&
            ($this->zonaList->getZonaCount() >= $this->currentZona)) {
            return $this->zonaList->getZona($this->currentZona);
        }
    }
    public function getNextZona() {
        if ($this->hasNextZona()) {
            return $this->zonaList->getZona(++$this->currentZona);
        } else {
            return NULL;
        }
    }
    public function hasNextZona() {
        if ($this->zonaList->getZonaCount() > $this->currentZona) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}