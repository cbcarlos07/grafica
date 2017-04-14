<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 17/02/17
 * Time: 16:49
 */
class FilialList
{
   private $_filial;
   private $_filialCount;

    /**
     * FilialList constructor.
     * @param $_filial
     */
    public function __construct()
    {

    }

    /**
     * @return mixed
     */
    public function getFilialCount()
    {
        return $this->_filialCount;
    }

    /**
     * @param mixed $filialCount
     * @return FilialList
     */
    public function setFilialCount($newCount)
    {
        $this->_filialCount = $newCount;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFilial($_filialNumberToGet)
    {
        if((is_numeric($_filialNumberToGet)) && ($_filialNumberToGet <= $this->getFilialCount())){
            return $this->_filial[$_filialNumberToGet];
        }else{
            return null;
        }
    }

    public function addFilial(Filial $_filial_in) {
        $this->setFilialCount($this->getFilialCount() + 1);
        $this->_filial[$this->getFilialCount()] = $_filial_in;
        return $this->getFilialCount();
    }
    public function removeFilial(Filial $_filial_in) {
        $counter = 0;
        while (++$counter <= $this->getFilialCount()) {
            if ($_filial_in->getAuthorAndTitle() ==
                $this->_filial[$counter]->getAuthorAndTitle())
            {
                for ($x = $counter; $x < $this->getFilialCount(); $x++) {
                    $this->_filial[$x] = $this->_filial[$x + 1];
                }
                $this->setFilialCount($this->getFilialCount() - 1);
            }
        }
        return $this->getFilialCount();
    }


}