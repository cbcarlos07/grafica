<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 03/04/17
 * Time: 20:47
 */
class FoneFilial
{
    private $filial;
    private $nrTelefone;
    private $obsTelefone;
    private $nmContato;
    private $tipoContato;

    /**
     * @return mixed
     */
    public function getFilial()
    {
        return $this->filial;
    }

    /**
     * @param mixed $filial
     * @return FoneFilial
     */
    public function setFilial(Filial $filial)
    {
        $this->filial = $filial;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNrTelefone()
    {
        return $this->nrTelefone;
    }

    /**
     * @param mixed $nrTelefone
     * @return FoneFilial
     */
    public function setNrTelefone($nrTelefone)
    {
        $this->nrTelefone = $nrTelefone;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getObsTelefone()
    {
        return $this->obsTelefone;
    }

    /**
     * @param mixed $obsTelefone
     * @return FoneFilial
     */
    public function setObsTelefone($obsTelefone)
    {
        $this->obsTelefone = $obsTelefone;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNmContato()
    {
        return $this->nmContato;
    }

    /**
     * @param mixed $nmContato
     * @return FoneFilial
     */
    public function setNmContato($nmContato)
    {
        $this->nmContato = $nmContato;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTipoContato()
    {
        return $this->tipoContato;
    }

    /**
     * @param mixed $tipoContato
     * @return FoneFilial
     */
    public function setTipoContato(TipoContato $tipoContato)
    {
        $this->tipoContato = $tipoContato;
        return $this;
    }


}