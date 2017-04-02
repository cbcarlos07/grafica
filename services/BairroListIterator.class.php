<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 17/02/17
 * Time: 17:02
 */
class BairroListIterator
{
    protected $bairroList;
    protected $currentBairro = 0;

    public function __construct(BairroList $bairroList_in) {
        $this->bairroList = $bairroList_in;
    }
    public function getCurrentBairro() {
        if (($this->currentBairro > 0) &&
            ($this->bairroList->getBairroCount() >= $this->currentBairro)) {
            return $this->bairroList->getBairro($this->currentBairro);
        }
    }
    public function getNextBairro() {
        if ($this->hasNextBairro()) {
            return $this->bairroList->getBairro(++$this->currentBairro);
        } else {
            return NULL;
        }
    }
    public function hasNextBairro() {
        if ($this->bairroList->getBairroCount() > $this->currentBairro) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}