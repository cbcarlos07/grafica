<?php

/**
 * Created by PhpStorm.
 * User: carlos.brito
 * Date: 17/02/2017
 * Time: 07:13
 */
class Pais
{
   private $cd_pais;
   private $ds_pais;

    /**
     * @return mixed
     */
    public function getCdPais()
    {
        return $this->cd_pais;
    }

    /**
     * @param mixed $cd_pais
     * @return Pais
     */
    public function setCdPais($cd_pais)
    {
        $this->cd_pais = $cd_pais;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDsPais()
    {
        return $this->ds_pais;
    }

    /**
     * @param mixed $ds_pais
     * @return Pais
     */
    public function setDsPais($ds_pais)
    {
        $this->ds_pais = $ds_pais;
        return $this;
    }


}