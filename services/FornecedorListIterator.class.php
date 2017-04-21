<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 17/02/17
 * Time: 17:02
 */
class FornecedorListIterator
{
    protected $fornecedorList;
    protected $currentFornecedor = 0;

    public function __construct(FornecedorList $fornecedorList_in) {
        $this->fornecedorList = $fornecedorList_in;
    }
    public function getCurrentFornecedor() {
        if (($this->currentFornecedor > 0) &&
            ($this->fornecedorList->getFornecedorCount() >= $this->currentFornecedor)) {
            return $this->fornecedorList->getFornecedor($this->currentFornecedor);
        }
    }
    public function getNextFornecedor() {
        if ($this->hasNextFornecedor()) {
            return $this->fornecedorList->getFornecedor(++$this->currentFornecedor);
        } else {
            return NULL;
        }
    }
    public function hasNextFornecedor() {
        if ($this->fornecedorList->getFornecedorCount() > $this->currentFornecedor) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}