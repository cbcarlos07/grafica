<?php

/**
 * Created by PhpStorm.
 * User: carlos.brito
 * Date: 17/02/2017
 * Time: 13:40
 */
class Cidade
{
   private $cdCidade;
   private $nmCidade;
   private $estado;

    /**
     * @return mixed
     */
    public function getCdCidade()
    {
        return $this->cdCidade;
    }

    /**
     * @param mixed $cdCidade
     * @return Cidade
     */
    public function setCdCidade($cdCidade)
    {
        $this->cdCidade = $cdCidade;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNmCidade()
    {
        return $this->nmCidade;
    }

    /**
     * @param mixed $nmCidade
     * @return Cidade
     */
    public function setNmCidade($nmCidade)
    {
        $this->nmCidade = $nmCidade;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * @param mixed $estado
     * @return Cidade
     */
    public function setEstado(Estado $estado)
    {
        $this->estado = $estado;
        return $this;
    }



}