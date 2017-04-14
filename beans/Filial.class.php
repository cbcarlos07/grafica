<?php

/**
 * Created by PhpStorm.
 * User: carlos.brito
 * Date: 17/02/2017
 * Time: 14:08
 */
class Filial
{
private $cdFilial;
private $nmResponsavel;
private $dsNmFantasia;
private $nrCpfCnpj;
private $dsEmail;
private $nrCep;
private $nrCasa;
private $dsComplemento;
private $dtCadastro;
private $cliente;

    /**
     * @return mixed
     */
    public function getCliente()
    {
        return $this->cliente;
    }

    /**
     * @param mixed $cliente
     * @return Filial
     */
    public function setCliente(Cliente $cliente)
    {
        $this->cliente = $cliente;
        return $this;
    }



    /**
     * @return mixed
     */
    public function getCdFilial()
    {
        return $this->cdFilial;
    }

    /**
     * @param mixed $cdFilial
     * @return Filial
     */
    public function setCdFilial($cdFilial)
    {
        $this->cdFilial = $cdFilial;
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
     * @return Filial
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
     * @return Filial
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
     * @return Filial
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
     * @return Filial
     */
    public function setDsEmail($dsEmail)
    {
        $this->dsEmail = $dsEmail;
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
     * @return Filial
     */
    public function setNrCep($nrCep)
    {
        $this->nrCep = $nrCep;
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
     * @return Filial
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
     * @return Filial
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
     * @return Filial
     */
    public function setDtCadastro($dtCadastro)
    {
        $this->dtCadastro = $dtCadastro;
        return $this;
    }



}