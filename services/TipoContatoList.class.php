<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 17/02/17
 * Time: 16:49
 */
class TipoContatoList
{
   private $_tipoContato;
   private $_tipoContatoCount;

    /**
     * TipoContatoList constructor.
     * @param $_tipoContato
     */
    public function __construct()
    {

    }

    /**
     * @return mixed
     */
    public function getTipoContatoCount()
    {
        return $this->_tipoContatoCount;
    }

    /**
     * @param mixed $tipoContatoCount
     * @return TipoContatoList
     */
    public function setTipoContatoCount($newCount)
    {
        $this->_tipoContatoCount = $newCount;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTipoContato($_tipoContatoNumberToGet)
    {
        if((is_numeric($_tipoContatoNumberToGet)) && ($_tipoContatoNumberToGet <= $this->getTipoContatoCount())){
            return $this->_tipoContato[$_tipoContatoNumberToGet];
        }else{
            return null;
        }
    }

    public function addTipoContato(TipoContato $_tipoContato_in) {
        $this->setTipoContatoCount($this->getTipoContatoCount() + 1);
        $this->_tipoContato[$this->getTipoContatoCount()] = $_tipoContato_in;
        return $this->getTipoContatoCount();
    }
    public function removeTipoContato(TipoContato $_tipoContato_in) {
        $counter = 0;
        while (++$counter <= $this->getTipoContatoCount()) {
            if ($_tipoContato_in->getAuthorAndTitle() ==
                $this->_tipoContato[$counter]->getAuthorAndTitle())
            {
                for ($x = $counter; $x < $this->getTipoContatoCount(); $x++) {
                    $this->_tipoContato[$x] = $this->_tipoContato[$x + 1];
                }
                $this->setTipoContatoCount($this->getTipoContatoCount() - 1);
            }
        }
        return $this->getTipoContatoCount();
    }


}