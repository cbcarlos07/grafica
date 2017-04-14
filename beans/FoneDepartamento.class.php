<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 03/04/17
 * Time: 20:47
 */
class FoneDepartamento
{
    private $departamento;
    private $nrTelefone;
    private $obsTelefone;
    private $nmContato;
    private $tipoContato;

    /**
     * @return mixed
     */
    public function getDepartamento()
    {
        return $this->departamento;
    }

    /**
     * @param mixed $departamento
     * @return FoneDepartamento
     */
    public function setDepartamento(Departamento $departamento)
    {
        $this->departamento = $departamento;
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
     * @return FoneDepartamento
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
     * @return FoneDepartamento
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
     * @return FoneDepartamento
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
     * @return FoneDepartamento
     */
    public function setTipoContato(TipoContato $tipoContato)
    {
        $this->tipoContato = $tipoContato;
        return $this;
    }


}