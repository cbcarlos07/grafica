<?php

/**
 * Created by PhpStorm.
 * User: carlos.brito
 * Date: 17/02/2017
 * Time: 13:47
 */
class TipoContato
{
   private $cdTipoContato;
   private $dsTipoContato;

    /**
     * @return mixed
     */
    public function getCdTipoContato()
    {
        return $this->cdTipoContato;
    }

    /**
     * @param mixed $cdTipoContato
     * @return TipoContato
     */
    public function setCdTipoContato($cdTipoContato)
    {
        $this->cdTipoContato = $cdTipoContato;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDsTipoContato()
    {
        return $this->dsTipoContato;
    }

    /**
     * @param mixed $dsTipoContato
     * @return TipoContato
     */
    public function setDsTipoContato($dsTipoContato)
    {
        $this->dsTipoContato = $dsTipoContato;
        return $this;
    }


}