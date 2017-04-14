<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 14/04/17
 * Time: 15:32
 */
class Departamento
{
   private $cdDepartamento;
   private $nmResponsavel;
   private $dsDepartamento;
   private $filial;
   private $dsEmail;

    /**
     * @return mixed
     */
    public function getDsEmail()
    {
        return $this->dsEmail;
    }

    /**
     * @param mixed $dsEmail
     * @return Departamento
     */
    public function setDsEmail($dsEmail)
    {
        $this->dsEmail = $dsEmail;
        return $this;
    }


    /**
     * @return mixed
     */
    public function getCdDepartamento()
    {
        return $this->cdDepartamento;
    }

    /**
     * @param mixed $cdDepartamento
     * @return Departamento
     */
    public function setCdDepartamento($cdDepartamento)
    {
        $this->cdDepartamento = $cdDepartamento;
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
     * @return Departamento
     */
    public function setNmResponsavel($nmResponsavel)
    {
        $this->nmResponsavel = $nmResponsavel;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDsDepartamento()
    {
        return $this->dsDepartamento;
    }

    /**
     * @param mixed $dsDepartamento
     * @return Departamento
     */
    public function setDsDepartamento($dsDepartamento)
    {
        $this->dsDepartamento = $dsDepartamento;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFilial()
    {
        return $this->filial;
    }

    /**
     * @param mixed $filial
     * @return Departamento
     */
    public function setFilial(Filial $filial)
    {
        $this->filial = $filial;
        return $this;
    }

}