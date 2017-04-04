<?php

/**
 * Created by PhpStorm.
 * User: carlos.brito
 * Date: 17/02/2017
 * Time: 14:08
 */
class Cliente
{
private $cdCliente;
private $nmResponsavel;
private $dsNmFantasia;
private $nrCpfCnpj;
private $dsEmail;
private $endereco;
private $nrCasa;
private $dsComplemento;
private $dtCadastro;

    /**
     * @return mixed
     */
    public function getCdCliente()
    {
        return $this->cdCliente;
    }

    /**
     * @param mixed $cdCliente
     * @return Cliente
     */
    public function setCdCliente($cdCliente)
    {
        $this->cdCliente = $cdCliente;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNmResponsavel()
    {
        return $this->nmResponsavel;
    }

    /**
     * @param mixed $nmResponsavel
     * @return Cliente
     */
    public function setNmResponsavel($nmResponsavel)
    {
        $this->nmResponsavel = $nmResponsavel;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDsNmFantasia()
    {
        return $this->dsNmFantasia;
    }

    /**
     * @param mixed $dsNmFantasia
     * @return Cliente
     */
    public function setDsNmFantasia($dsNmFantasia)
    {
        $this->dsNmFantasia = $dsNmFantasia;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNrCpfCnpj()
    {
        return $this->nrCpfCnpj;
    }

    /**
     * @param mixed $nrCpfCnpj
     * @return Cliente
     */
    public function setNrCpfCnpj($nrCpfCnpj)
    {
        $this->nrCpfCnpj = $nrCpfCnpj;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDsEmail()
    {
        return $this->dsEmail;
    }

    /**
     * @param mixed $dsEmail
     * @return Cliente
     */
    public function setDsEmail($dsEmail)
    {
        $this->dsEmail = $dsEmail;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEndereco()
    {
        return $this->endereco;
    }

    /**
     * @param mixed $endereco
     * @return Cliente
     */
    public function setEndereco($endereco)
    {
        $this->endereco = $endereco;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNrCasa()
    {
        return $this->nrCasa;
    }

    /**
     * @param mixed $nrCasa
     * @return Cliente
     */
    public function setNrCasa($nrCasa)
    {
        $this->nrCasa = $nrCasa;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDsComplemento()
    {
        return $this->dsComplemento;
    }

    /**
     * @param mixed $dsComplemento
     * @return Cliente
     */
    public function setDsComplemento($dsComplemento)
    {
        $this->dsComplemento = $dsComplemento;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDtCadastro()
    {
        return $this->dtCadastro;
    }

    /**
     * @param mixed $dtCadastro
     * @return Cliente
     */
    public function setDtCadastro($dtCadastro)
    {
        $this->dtCadastro = $dtCadastro;
        return $this;
    }



}