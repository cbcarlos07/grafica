<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 17/02/17
 * Time: 16:49
 */
class FoneDepartamentoList
{
   private $_foneDepartamento;
   private $_foneDepartamentoCount;

    /**
     * FoneDepartamentoList constructor.
     * @param $_foneDepartamento
     */
    public function __construct()
    {

    }

    /**
     * @return mixed
     */
    public function getFoneDepartamentoCount()
    {
        return $this->_foneDepartamentoCount;
    }

    /**
     * @param mixed $foneDepartamentoCount
     * @return FoneDepartamentoList
     */
    public function setFoneDepartamentoCount($newCount)
    {
        $this->_foneDepartamentoCount = $newCount;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFoneDepartamento($_foneDepartamentoNumberToGet)
    {
        if((is_numeric($_foneDepartamentoNumberToGet)) && ($_foneDepartamentoNumberToGet <= $this->getFoneDepartamentoCount())){
            return $this->_foneDepartamento[$_foneDepartamentoNumberToGet];
        }else{
            return null;
        }
    }

    public function addFoneDepartamento(FoneDepartamento $_foneDepartamento_in) {
        $this->setFoneDepartamentoCount($this->getFoneDepartamentoCount() + 1);
        $this->_foneDepartamento[$this->getFoneDepartamentoCount()] = $_foneDepartamento_in;
        return $this->getFoneDepartamentoCount();
    }
    public function removeFoneDepartamento(FoneDepartamento $_foneDepartamento_in) {
        $counter = 0;
        while (++$counter <= $this->getFoneDepartamentoCount()) {
            if ($_foneDepartamento_in->getAuthorAndTitle() ==
                $this->_foneDepartamento[$counter]->getAuthorAndTitle())
            {
                for ($x = $counter; $x < $this->getFoneDepartamentoCount(); $x++) {
                    $this->_foneDepartamento[$x] = $this->_foneDepartamento[$x + 1];
                }
                $this->setFoneDepartamentoCount($this->getFoneDepartamentoCount() - 1);
            }
        }
        return $this->getFoneDepartamentoCount();
    }


}