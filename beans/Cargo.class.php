<?php

/**
 * Created by PhpStorm.
 * User: carlos.brito
 * Date: 17/02/2017
 * Time: 13:55
 */
class Cargo
{
   private $cdCargo;
   private $dsCargo;
   private $obsCargo;

    /**
     * @return mixed
     */
    public function getCdCargo()
    {
        return $this->cdCargo;
    }

    /**
     * @param mixed $cdCargo
     * @return Cargo
     */
    public function setCdCargo($cdCargo)
    {
        $this->cdCargo = $cdCargo;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDsCargo()
    {
        return $this->dsCargo;
    }

    /**
     * @param mixed $dsCargo
     * @return Cargo
     */
    public function setDsCargo($dsCargo)
    {
        $this->dsCargo = $dsCargo;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getObsCargo()
    {
        return $this->obsCargo;
    }

    /**
     * @param mixed $obsCargo
     * @return Cargo
     */
    public function setObsCargo($obsCargo)
    {
        $this->obsCargo = $obsCargo;
        return $this;
    }



}