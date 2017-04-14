<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 17/02/17
 * Time: 17:02
 */
class FilialListIterator
{
    protected $filialList;
    protected $currentFilial = 0;

    public function __construct(FilialList $filialList_in) {
        $this->filialList = $filialList_in;
    }
    public function getCurrentFilial() {
        if (($this->currentFilial > 0) &&
            ($this->filialList->getFilialCount() >= $this->currentFilial)) {
            return $this->filialList->getFilial($this->currentFilial);
        }
    }
    public function getNextFilial() {
        if ($this->hasNextFilial()) {
            return $this->filialList->getFilial(++$this->currentFilial);
        } else {
            return NULL;
        }
    }
    public function hasNextFilial() {
        if ($this->filialList->getFilialCount() > $this->currentFilial) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}