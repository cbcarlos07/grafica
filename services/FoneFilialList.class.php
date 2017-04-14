<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 17/02/17
 * Time: 16:49
 */
class FoneFilialList
{
   private $_foneFilial;
   private $_foneFilialCount;

    /**
     * FoneFilialList constructor.
     * @param $_foneFilial
     */
    public function __construct()
    {

    }

    /**
     * @return mixed
     */
    public function getFoneFilialCount()
    {
        return $this->_foneFilialCount;
    }

    /**
     * @param mixed $foneFilialCount
     * @return FoneFilialList
     */
    public function setFoneFilialCount($newCount)
    {
        $this->_foneFilialCount = $newCount;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFoneFilial($_foneFilialNumberToGet)
    {
        if((is_numeric($_foneFilialNumberToGet)) && ($_foneFilialNumberToGet <= $this->getFoneFilialCount())){
            return $this->_foneFilial[$_foneFilialNumberToGet];
        }else{
            return null;
        }
    }

    public function addFoneFilial(FoneFilial $_foneFilial_in) {
        $this->setFoneFilialCount($this->getFoneFilialCount() + 1);
        $this->_foneFilial[$this->getFoneFilialCount()] = $_foneFilial_in;
        return $this->getFoneFilialCount();
    }
    public function removeFoneFilial(FoneFilial $_foneFilial_in) {
        $counter = 0;
        while (++$counter <= $this->getFoneFilialCount()) {
            if ($_foneFilial_in->getAuthorAndTitle() ==
                $this->_foneFilial[$counter]->getAuthorAndTitle())
            {
                for ($x = $counter; $x < $this->getFoneFilialCount(); $x++) {
                    $this->_foneFilial[$x] = $this->_foneFilial[$x + 1];
                }
                $this->setFoneFilialCount($this->getFoneFilialCount() - 1);
            }
        }
        return $this->getFoneFilialCount();
    }


}