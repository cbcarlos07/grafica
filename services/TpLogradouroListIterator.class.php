<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 17/02/17
 * Time: 17:02
 */
class TpLogradouroListIterator
{
    protected $tpLogradouroList;
    protected $currentTpLogradouro = 0;

    public function __construct(TpLogradouroList $tpLogradouroList_in) {
        $this->tpLogradouroList = $tpLogradouroList_in;
    }
    public function getCurrentTpLogradouro() {
        if (($this->currentTpLogradouro > 0) &&
            ($this->tpLogradouroList->getTpLogradouroCount() >= $this->currentTpLogradouro)) {
            return $this->tpLogradouroList->getTpLogradouro($this->currentTpLogradouro);
        }
    }
    public function getNextTpLogradouro() {
        if ($this->hasNextTpLogradouro()) {
            return $this->tpLogradouroList->getTpLogradouro(++$this->currentTpLogradouro);
        } else {
            return NULL;
        }
    }
    public function hasNextTpLogradouro() {
        if ($this->tpLogradouroList->getTpLogradouroCount() > $this->currentTpLogradouro) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}