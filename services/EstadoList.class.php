<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 17/02/17
 * Time: 16:49
 */
class EstadoList
{
   private $_estado;
   private $_estadoCount;

    /**
     * EstadoList constructor.
     * @param $_estado
     */
    public function __construct()
    {

    }

    /**
     * @return mixed
     */
    public function getEstadoCount()
    {
        return $this->_estadoCount;
    }

    /**
     * @param mixed $estadoCount
     * @return EstadoList
     */
    public function setEstadoCount($newCount)
    {
        $this->_estadoCount = $newCount;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEstado($_estadoNumberToGet)
    {
        if((is_numeric($_estadoNumberToGet)) && ($_estadoNumberToGet <= $this->getEstadoCount())){
            return $this->_estado[$_estadoNumberToGet];
        }else{
            return null;
        }
    }

    public function addEstado(Estado $_estado_in) {
        $this->setEstadoCount($this->getEstadoCount() + 1);
        $this->_estado[$this->getEstadoCount()] = $_estado_in;
        return $this->getEstadoCount();
    }
    public function removeEstado(Estado $_estado_in) {
        $counter = 0;
        while (++$counter <= $this->getEstadoCount()) {
            if ($_estado_in->getAuthorAndTitle() ==
                $this->_estado[$counter]->getAuthorAndTitle())
            {
                for ($x = $counter; $x < $this->getEstadoCount(); $x++) {
                    $this->_estado[$x] = $this->_estado[$x + 1];
                }
                $this->setEstadoCount($this->getEstadoCount() - 1);
            }
        }
        return $this->getEstadoCount();
    }


}