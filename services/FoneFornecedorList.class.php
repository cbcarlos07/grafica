<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 17/02/17
 * Time: 16:49
 */
class FoneFornecedorList
{
   private $_foneFornecedor;
   private $_foneFornecedorCount;

    /**
     * FoneFornecedorList constructor.
     * @param $_foneFornecedor
     */
    public function __construct()
    {

    }

    /**
     * @return mixed
     */
    public function getFoneFornecedorCount()
    {
        return $this->_foneFornecedorCount;
    }

    /**
     * @param mixed $foneFornecedorCount
     * @return FoneFornecedorList
     */
    public function setFoneFornecedorCount($newCount)
    {
        $this->_foneFornecedorCount = $newCount;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFoneFornecedor($_foneFornecedorNumberToGet)
    {
        if((is_numeric($_foneFornecedorNumberToGet)) && ($_foneFornecedorNumberToGet <= $this->getFoneFornecedorCount())){
            return $this->_foneFornecedor[$_foneFornecedorNumberToGet];
        }else{
            return null;
        }
    }

    public function addFoneFornecedor(FoneFornecedor $_foneFornecedor_in) {
        $this->setFoneFornecedorCount($this->getFoneFornecedorCount() + 1);
        $this->_foneFornecedor[$this->getFoneFornecedorCount()] = $_foneFornecedor_in;
        return $this->getFoneFornecedorCount();
    }
    public function removeFoneFornecedor(FoneFornecedor $_foneFornecedor_in) {
        $counter = 0;
        while (++$counter <= $this->getFoneFornecedorCount()) {
            if ($_foneFornecedor_in->getAuthorAndTitle() ==
                $this->_foneFornecedor[$counter]->getAuthorAndTitle())
            {
                for ($x = $counter; $x < $this->getFoneFornecedorCount(); $x++) {
                    $this->_foneFornecedor[$x] = $this->_foneFornecedor[$x + 1];
                }
                $this->setFoneFornecedorCount($this->getFoneFornecedorCount() - 1);
            }
        }
        return $this->getFoneFornecedorCount();
    }


}