<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 17/02/17
 * Time: 16:49
 */
class TpLogradouroList
{
   private $_tpLogradouro;
   private $_tpLogradouroCount;

    /**
     * TpLogradouroList constructor.
     * @param $_tpLogradouro
     */
    public function __construct()
    {

    }

    /**
     * @return mixed
     */
    public function getTpLogradouroCount()
    {
        return $this->_tpLogradouroCount;
    }

    /**
     * @param mixed $tpLogradouroCount
     * @return TpLogradouroList
     */
    public function setTpLogradouroCount($newCount)
    {
        $this->_tpLogradouroCount = $newCount;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTpLogradouro($_tpLogradouroNumberToGet)
    {
        if((is_numeric($_tpLogradouroNumberToGet)) && ($_tpLogradouroNumberToGet <= $this->getTpLogradouroCount())){
            return $this->_tpLogradouro[$_tpLogradouroNumberToGet];
        }else{
            return null;
        }
    }

    public function addTpLogradouro(TpLogradouro $_tpLogradouro_in) {
        $this->setTpLogradouroCount($this->getTpLogradouroCount() + 1);
        $this->_tpLogradouro[$this->getTpLogradouroCount()] = $_tpLogradouro_in;
        return $this->getTpLogradouroCount();
    }
    public function removeTpLogradouro(TpLogradouro $_tpLogradouro_in) {
        $counter = 0;
        while (++$counter <= $this->getTpLogradouroCount()) {
            if ($_tpLogradouro_in->getAuthorAndTitle() ==
                $this->_tpLogradouro[$counter]->getAuthorAndTitle())
            {
                for ($x = $counter; $x < $this->getTpLogradouroCount(); $x++) {
                    $this->_tpLogradouro[$x] = $this->_tpLogradouro[$x + 1];
                }
                $this->setTpLogradouroCount($this->getTpLogradouroCount() - 1);
            }
        }
        return $this->getTpLogradouroCount();
    }


}