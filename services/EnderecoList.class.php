<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 17/02/17
 * Time: 16:49
 */
class EnderecoList
{
   private $_endereco;
   private $_enderecoCount;

    /**
     * EnderecoList constructor.
     * @param $_endereco
     */
    public function __construct()
    {

    }

    /**
     * @return mixed
     */
    public function getEnderecoCount()
    {
        return $this->_enderecoCount;
    }

    /**
     * @param mixed $enderecoCount
     * @return EnderecoList
     */
    public function setEnderecoCount($newCount)
    {
        $this->_enderecoCount = $newCount;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEndereco($_enderecoNumberToGet)
    {
        if((is_numeric($_enderecoNumberToGet)) && ($_enderecoNumberToGet <= $this->getEnderecoCount())){
            return $this->_endereco[$_enderecoNumberToGet];
        }else{
            return null;
        }
    }

    public function addEndereco(Endereco $_endereco_in) {
        $this->setEnderecoCount($this->getEnderecoCount() + 1);
        $this->_endereco[$this->getEnderecoCount()] = $_endereco_in;
        return $this->getEnderecoCount();
    }
    public function removeEndereco(Endereco $_endereco_in) {
        $counter = 0;
        while (++$counter <= $this->getEnderecoCount()) {
            if ($_endereco_in->getAuthorAndTitle() ==
                $this->_endereco[$counter]->getAuthorAndTitle())
            {
                for ($x = $counter; $x < $this->getEnderecoCount(); $x++) {
                    $this->_endereco[$x] = $this->_endereco[$x + 1];
                }
                $this->setEnderecoCount($this->getEnderecoCount() - 1);
            }
        }
        return $this->getEnderecoCount();
    }


}