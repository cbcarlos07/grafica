<?php

/**
 * Created by PhpStorm.
 * User: carlos.brito
 * Date: 17/02/2017
 * Time: 13:45
 */
class Bairro
{
   private $cdBairro;
   private $nmBairro;
   private $cidade;
   private $zona;

    /**
     * @return mixed
     */
    public function getCdBairro()
    {
        return $this->cdBairro;
    }

    /**
     * @param mixed $cdBairro
     * @return Bairro
     */
    public function setCdBairro($cdBairro)
    {
        $this->cdBairro = $cdBairro;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNmBairro()
    {
        return $this->nmBairro;
    }

    /**
     * @param mixed $nmBairro
     * @return Bairro
     */
    public function setNmBairro($nmBairro)
    {
        $this->nmBairro = $nmBairro;
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
     * @return Bairro
     */
    public function setCidade(Cidade $cidade)
    {
        $this->cidade = $cidade;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getZona()
    {
        return $this->zona;
    }

    /**
     * @param mixed $zona
     * @return Bairro
     */
    public function setZona(Zona $zona)
    {
        $this->zona = $zona;
        return $this;
    }



}