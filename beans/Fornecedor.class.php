<?php

/**
 * Created by PhpStorm.
 * User: carlos.brito
 * Date: 17/02/2017
 * Time: 14:08
 */
class Fornecedor
{
private $cdFornecedor;
private $dsRazaoSocial;
private $dsNmFantasia;
private $nrCpfCnpj;
private $dsEmail;
private $nrCep;
private $nrCasa;
private $dsComplemento;
private $dtCadastro;

    /**
     * @return mixed
     */
    public function getDsRazaoSocial()
    {
        return $this->dsRazaoSocial;
    }

    /**
     * @param mixed $dsRazaoSocial
     * @return Fornecedor
     */
    public function setDsRazaoSocial($dsRazaoSocial)
    {
        $this->dsRazaoSocial = $dsRazaoSocial;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCdFornecedor()
    {
        return $this->cdFornecedor;
    }

    /**
     * @param mixed $cdFornecedor
     * @return Fornecedor
     */
    public function setCdFornecedor($cdFornecedor)
    {
        $this->cdFornecedor = $cdFornecedor;
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
     * @return Fornecedor
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
     * @return Fornecedor
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
     * @return Fornecedor
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
     * @return Fornecedor
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
     * @return Fornecedor
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
     * @return Fornecedor
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
     * @return Fornecedor
     */
    public function setDtCadastro($dtCadastro)
    {
        $this->dtCadastro = $dtCadastro;
        return $this;
    }



}