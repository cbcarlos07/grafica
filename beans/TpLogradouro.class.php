<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 26/02/17
 * Time: 00:52
 */
class TpLogradouro
{
   private $cdTpLogradouro;
   private $dsTpLogradouro;

    /**
     * @return mixed
     */
    public function getCdTpLogradouro()
    {
        return $this->cdTpLogradouro;
    }

    /**
     * @param mixed $cdTpLogradouro
     * @return TpLogradouro
     */
    public function setCdTpLogradouro($cdTpLogradouro)
    {
        $this->cdTpLogradouro = $cdTpLogradouro;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDsTpLogradouro()
    {
        return $this->dsTpLogradouro;
    }

    /**
     * @param mixed $dsTpLogradouro
     * @return TpLogradouro
     */
    public function setDsTpLogradouro($dsTpLogradouro)
    {
        $this->dsTpLogradouro = $dsTpLogradouro;
        return $this;
    }


}