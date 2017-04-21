<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 17/02/17
 * Time: 17:02
 */
class FoneFornecedorListIterator
{
    protected $foneFornecedorList;
    protected $currentFoneFornecedor = 0;

    public function __construct(FoneFornecedorList $foneFornecedorList_in) {
        $this->foneFornecedorList = $foneFornecedorList_in;
    }
    public function getCurrentFoneFornecedor() {
        if (($this->currentFoneFornecedor > 0) &&
            ($this->foneFornecedorList->getFoneFornecedorCount() >= $this->currentFoneFornecedor)) {
            return $this->foneFornecedorList->getFoneFornecedor($this->currentFoneFornecedor);
        }
    }
    public function getNextFoneFornecedor() {
        if ($this->hasNextFoneFornecedor()) {
            return $this->foneFornecedorList->getFoneFornecedor(++$this->currentFoneFornecedor);
        } else {
            return NULL;
        }
    }
    public function hasNextFoneFornecedor() {
        if ($this->foneFornecedorList->getFoneFornecedorCount() > $this->currentFoneFornecedor) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}