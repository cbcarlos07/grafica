<?php

/**
 * Created by PhpStorm.
 * User: carlos.brito
 * Date: 17/02/2017
 * Time: 13:57
 */
class Usuario
{
   private $cdUsuario;
   private $nmUsuario;
   private $nmSobrenome;
   private $dsLogin;
   private $dsSenha;
   private $snAtivo;
   private $cargo;
   private $nrCPF;
   private $nrRg;
   private $dsFoto;
   private $snSenhaAtual;

    /**
     * @return mixed
     */
    public function getNmSobrenome()
    {
        return $this->nmSobrenome;
    }

    /**
     * @param mixed $nmSobrenome
     * @return Usuario
     */
    public function setNmSobrenome($nmSobrenome)
    {
        $this->nmSobrenome = $nmSobrenome;
        return $this;
    }



    /**
     * @return mixed
     */
    public function getSnSenhaAtual()
    {
        return $this->snSenhaAtual;
    }

    /**
     * @param mixed $snSenhaAtual
     * @return Usuario
     */
    public function setSnSenhaAtual($snSenhaAtual)
    {
        $this->snSenhaAtual = $snSenhaAtual;
        return $this;
    }


    /**
     * @return mixed
     */
    public function getCdUsuario()
    {
        return $this->cdUsuario;
    }

    /**
     * @param mixed $cdUsuario
     * @return Usuario
     */
    public function setCdUsuario($cdUsuario)
    {
        $this->cdUsuario = $cdUsuario;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNmUsuario()
    {
        return $this->nmUsuario;
    }

    /**
     * @param mixed $nmUsuario
     * @return Usuario
     */
    public function setNmUsuario($nmUsuario)
    {
        $this->nmUsuario = $nmUsuario;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDsLogin()
    {
        return $this->dsLogin;
    }

    /**
     * @param mixed $dsLogin
     * @return Usuario
     */
    public function setDsLogin($dsLogin)
    {
        $this->dsLogin = $dsLogin;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDsSenha()
    {
        return $this->dsSenha;
    }

    /**
     * @param mixed $dsSenha
     * @return Usuario
     */
    public function setDsSenha($dsSenha)
    {
        $this->dsSenha = $dsSenha;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSnAtivo()
    {
        return $this->snAtivo;
    }

    /**
     * @param mixed $snAtivo
     * @return Usuario
     */
    public function setSnAtivo($snAtivo)
    {
        $this->snAtivo = $snAtivo;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCargo()
    {
        return $this->cargo;
    }

    /**
     * @param mixed $cargo
     * @return Usuario
     */
    public function setCargo($cargo)
    {
        $this->cargo = $cargo;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNrCPF()
    {
        return $this->nrCPF;
    }

    /**
     * @param mixed $nrCPF
     * @return Usuario
     */
    public function setNrCPF($nrCPF)
    {
        $this->nrCPF = $nrCPF;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNrRg()
    {
        return $this->nrRg;
    }

    /**
     * @param mixed $nrRg
     * @return Usuario
     */
    public function setNrRg($nrRg)
    {
        $this->nrRg = $nrRg;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDsFoto()
    {
        return $this->dsFoto;
    }

    /**
     * @param mixed $dsFoto
     * @return Usuario
     */
    public function setDsFoto($dsFoto)
    {
        $this->dsFoto = $dsFoto;
        return $this;
    }


}