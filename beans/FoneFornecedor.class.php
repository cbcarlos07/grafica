<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 03/04/17
 * Time: 20:47
 */
class FoneFornecedor
{
    private $fornecedor;
    private $nrTelefone;
    private $obsTelefone;
    private $nmContato;
    private $tipoContato;

    /**
     * @return mixed
     */
    public function getFornecedor()
    {
        return $this->fornecedor;
    }

    /**
     * @param mixed $fornecedor
     * @return FoneFornecedor
     */
    public function setFornecedor(Fornecedor $fornecedor)
    {
        $this->fornecedor = $fornecedor;
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
     * @return FoneFornecedor
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
     * @return FoneFornecedor
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
     * @return FoneFornecedor
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
     * @return FoneFornecedor
     */
    public function setTipoContato(TipoContato $tipoContato)
    {
        $this->tipoContato = $tipoContato;
        return $this;
    }


}