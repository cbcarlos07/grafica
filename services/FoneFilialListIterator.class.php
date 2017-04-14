<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 17/02/17
 * Time: 17:02
 */
class FoneFilialListIterator
{
    protected $foneFilialList;
    protected $currentFoneFilial = 0;

    public function __construct(FoneFilialList $foneFilialList_in) {
        $this->foneFilialList = $foneFilialList_in;
    }
    public function getCurrentFoneFilial() {
        if (($this->currentFoneFilial > 0) &&
            ($this->foneFilialList->getFoneFilialCount() >= $this->currentFoneFilial)) {
            return $this->foneFilialList->getFoneFilial($this->currentFoneFilial);
        }
    }
    public function getNextFoneFilial() {
        if ($this->hasNextFoneFilial()) {
            return $this->foneFilialList->getFoneFilial(++$this->currentFoneFilial);
        } else {
            return NULL;
        }
    }
    public function hasNextFoneFilial() {
        if ($this->foneFilialList->getFoneFilialCount() > $this->currentFoneFilial) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}