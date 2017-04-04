<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 03/04/17
 * Time: 20:47
 */
class FoneCliente
{
    private $cliente;
    private $nrTelefone;
    private $obsTelefone;
    private $nmContato;
    private $tipoContato;

    /**
     * @return mixed
     */
    public function getCliente()
    {
        return $this->cliente;
    }

    /**
     * @param mixed $cliente
     * @return FoneCliente
     */
    public function setCliente(Cliente $cliente)
    {
        $this->cliente = $cliente;
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
     * @return FoneCliente
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
     * @return FoneCliente
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
     * @return FoneCliente
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
     * @return FoneCliente
     */
    public function setTipoContato(TipoContato $tipoContato)
    {
        $this->tipoContato = $tipoContato;
        return $this;
    }


}