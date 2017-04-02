<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 17/02/17
 * Time: 16:49
 */
class BairroList
{
   private $_bairro;
   private $_bairroCount;

    /**
     * BairroList constructor.
     * @param $_bairro
     */
    public function __construct()
    {

    }

    /**
     * @return mixed
     */
    public function getBairroCount()
    {
        return $this->_bairroCount;
    }

    /**
     * @param mixed $bairroCount
     * @return BairroList
     */
    public function setBairroCount($newCount)
    {
        $this->_bairroCount = $newCount;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBairro($_bairroNumberToGet)
    {
        if((is_numeric($_bairroNumberToGet)) && ($_bairroNumberToGet <= $this->getBairroCount())){
            return $this->_bairro[$_bairroNumberToGet];
        }else{
            return null;
        }
    }

    public function addBairro(Bairro $_bairro_in) {
        $this->setBairroCount($this->getBairroCount() + 1);
        $this->_bairro[$this->getBairroCount()] = $_bairro_in;
        return $this->getBairroCount();
    }
    public function removeBairro(Bairro $_bairro_in) {
        $counter = 0;
        while (++$counter <= $this->getBairroCount()) {
            if ($_bairro_in->getAuthorAndTitle() ==
                $this->_bairro[$counter]->getAuthorAndTitle())
            {
                for ($x = $counter; $x < $this->getBairroCount(); $x++) {
                    $this->_bairro[$x] = $this->_bairro[$x + 1];
                }
                $this->setBairroCount($this->getBairroCount() - 1);
            }
        }
        return $this->getBairroCount();
    }


}