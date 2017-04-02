<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 17/02/17
 * Time: 17:02
 */
class CargoListIterator
{
    protected $cargoList;
    protected $currentCargo = 0;

    public function __construct(CargoList $cargoList_in) {
        $this->cargoList = $cargoList_in;
    }
    public function getCurrentCargo() {
        if (($this->currentCargo > 0) &&
            ($this->cargoList->getCargoCount() >= $this->currentCargo)) {
            return $this->cargoList->getCargo($this->currentCargo);
        }
    }
    public function getNextCargo() {
        if ($this->hasNextCargo()) {
            return $this->cargoList->getCargo(++$this->currentCargo);
        } else {
            return NULL;
        }
    }
    public function hasNextCargo() {
        if ($this->cargoList->getCargoCount() > $this->currentCargo) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}