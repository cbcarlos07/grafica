<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 17/02/17
 * Time: 16:49
 */
class ZonaList
{
   private $_zona;
   private $_zonaCount;

    /**
     * ZonaList constructor.
     * @param $_zona
     */
    public function __construct()
    {

    }

    /**
     * @return mixed
     */
    public function getZonaCount()
    {
        return $this->_zonaCount;
    }

    /**
     * @param mixed $zonaCount
     * @return ZonaList
     */
    public function setZonaCount($newCount)
    {
        $this->_zonaCount = $newCount;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getZona($_zonaNumberToGet)
    {
        if((is_numeric($_zonaNumberToGet)) && ($_zonaNumberToGet <= $this->getZonaCount())){
            return $this->_zona[$_zonaNumberToGet];
        }else{
            return null;
        }
    }

    public function addZona(Zona $_zona_in) {
        $this->setZonaCount($this->getZonaCount() + 1);
        $this->_zona[$this->getZonaCount()] = $_zona_in;
        return $this->getZonaCount();
    }
    public function removeZona(Zona $_zona_in) {
        $counter = 0;
        while (++$counter <= $this->getZonaCount()) {
            if ($_zona_in->getAuthorAndTitle() ==
                $this->_zona[$counter]->getAuthorAndTitle())
            {
                for ($x = $counter; $x < $this->getZonaCount(); $x++) {
                    $this->_zona[$x] = $this->_zona[$x + 1];
                }
                $this->setZonaCount($this->getZonaCount() - 1);
            }
        }
        return $this->getZonaCount();
    }


}