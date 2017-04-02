<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 17/02/17
 * Time: 17:02
 */
class EnderecoListIterator
{
    protected $enderecoList;
    protected $currentEndereco = 0;

    public function __construct(EnderecoList $enderecoList_in) {
        $this->enderecoList = $enderecoList_in;
    }
    public function getCurrentEndereco() {
        if (($this->currentEndereco > 0) &&
            ($this->enderecoList->getEnderecoCount() >= $this->currentEndereco)) {
            return $this->enderecoList->getEndereco($this->currentEndereco);
        }
    }
    public function getNextEndereco() {
        if ($this->hasNextEndereco()) {
            return $this->enderecoList->getEndereco(++$this->currentEndereco);
        } else {
            return NULL;
        }
    }
    public function hasNextEndereco() {
        if ($this->enderecoList->getEnderecoCount() > $this->currentEndereco) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}