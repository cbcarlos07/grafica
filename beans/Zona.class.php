<?php

/**
 * Created by PhpStorm.
 * User: carlos.brito
 * Date: 17/02/2017
 * Time: 13:47
 */
class Zona
{
   private $cdZona;
   private $dsZona;

    /**
     * @return mixed
     */
    public function getCdZona()
    {
        return $this->cdZona;
    }

    /**
     * @param mixed $cdZona
     * @return Zona
     */
    public function setCdZona($cdZona)
    {
        $this->cdZona = $cdZona;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDsZona()
    {
        return $this->dsZona;
    }

    /**
     * @param mixed $dsZona
     * @return Zona
     */
    public function setDsZona($dsZona)
    {
        $this->dsZona = $dsZona;
        return $this;
    }


}