<?php

/**
 * Created by PhpStorm.
 * User: carlos.brito
 * Date: 17/02/2017
 * Time: 14:35
 */
class Account
{
private $username;
private $password;
private $checked;

    /**
     * Account constructor.
     * @param $username
     * @param $password
     * @param $checked
     */
    public function __construct($username, $password, $checked)
    {
        $this->username = $username;
        $this->password = $password;
        $this->checked = $checked;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     * @return Account
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     * @return Account
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getChecked()
    {
        return $this->checked;
    }

    /**
     * @param mixed $checked
     * @return Account
     */
    public function setChecked($checked)
    {
        $this->checked = $checked;
        return $this;
    }

}