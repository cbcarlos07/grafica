<?php

/**
 * Created by PhpStorm.
 * User: carlos.brito
 * Date: 17/02/2017
 * Time: 13:43
 */
class Endereco
{
  private $cdEndereco;
  private $nrCep;
  private $dsLogradouro;
  private $tpLogradouro;
  private $bairro;
  private $cidade;

    /**
     * @return mixed
     */
    public function getCdEndereco()
    {
        return $this->cdEndereco;
    }

    /**
     * @param mixed $cdEndereco
     * @return Endereco
     */
    public function setCdEndereco($cdEndereco)
    {
        $this->cdEndereco = $cdEndereco;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCidade()
    {
        return $this->cidade;
    }

    /**
     * @param mixed $cidade
     * @return Endereco
     */
    public function setCidade($cidade)
    {
        $this->cidade = $cidade;
        return $this;
    }


    /**
     * @return mixed
     */
    public function getNrCep()
    {
        return $this->nrCep;
    }

    /**
     * @param mixed $nrCep
     * @return Endereco
     */
    public function setNrCep($nrCep)
    {
        $this->nrCep = $nrCep;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDsLogradouro()
    {
        return $this->dsLogradouro;
    }

    /**
     * @param mixed $dsLogradouro
     * @return Endereco
     */
    public function setDsLogradouro($dsLogradouro)
    {
        $this->dsLogradouro = $dsLogradouro;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTpLogradouro()
    {
        return $this->tpLogradouro;
    }

    /**
     * @param mixed $tpLogradouro
     * @return Endereco
     */
    public function setTpLogradouro(TpLogradouro $tpLogradouro)
    {
        $this->tpLogradouro = $tpLogradouro;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBairro()
    {
        return $this->bairro;
    }

    /**
     * @param mixed $bairro
     * @return Endereco
     */
    public function setBairro(Bairro $bairro)
    {
        $this->bairro = $bairro;
        return $this;
    }


}