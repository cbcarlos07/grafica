<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 17/02/17
 * Time: 17:02
 */
class CidadeListIterator
{
    protected $cidadeList;
    protected $currentCidade = 0;

    public function __construct(CidadeList $cidadeList_in) {
        $this->cidadeList = $cidadeList_in;
    }
    public function getCurrentCidade() {
        if (($this->currentCidade > 0) &&
            ($this->cidadeList->getCidadeCount() >= $this->currentCidade)) {
            return $this->cidadeList->getCidade($this->currentCidade);
        }
    }
    public function getNextCidade() {
        if ($this->hasNextCidade()) {
            return $this->cidadeList->getCidade(++$this->currentCidade);
        } else {
            return NULL;
        }
    }
    public function hasNextCidade() {
        if ($this->cidadeList->getCidadeCount() > $this->currentCidade) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}