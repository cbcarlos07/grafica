<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 17/02/17
 * Time: 16:49
 */
class FornecedorList
{
   private $_fornecedor;
   private $_fornecedorCount;

    /**
     * FornecedorList constructor.
     * @param $_fornecedor
     */
    public function __construct()
    {

    }

    /**
     * @return mixed
     */
    public function getFornecedorCount()
    {
        return $this->_fornecedorCount;
    }

    /**
     * @param mixed $fornecedorCount
     * @return FornecedorList
     */
    public function setFornecedorCount($newCount)
    {
        $this->_fornecedorCount = $newCount;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFornecedor($_fornecedorNumberToGet)
    {
        if((is_numeric($_fornecedorNumberToGet)) && ($_fornecedorNumberToGet <= $this->getFornecedorCount())){
            return $this->_fornecedor[$_fornecedorNumberToGet];
        }else{
            return null;
        }
    }

    public function addFornecedor(Fornecedor $_fornecedor_in) {
        $this->setFornecedorCount($this->getFornecedorCount() + 1);
        $this->_fornecedor[$this->getFornecedorCount()] = $_fornecedor_in;
        return $this->getFornecedorCount();
    }
    public function removeFornecedor(Fornecedor $_fornecedor_in) {
        $counter = 0;
        while (++$counter <= $this->getFornecedorCount()) {
            if ($_fornecedor_in->getAuthorAndTitle() ==
                $this->_fornecedor[$counter]->getAuthorAndTitle())
            {
                for ($x = $counter; $x < $this->getFornecedorCount(); $x++) {
                    $this->_fornecedor[$x] = $this->_fornecedor[$x + 1];
                }
                $this->setFornecedorCount($this->getFornecedorCount() - 1);
            }
        }
        return $this->getFornecedorCount();
    }


}