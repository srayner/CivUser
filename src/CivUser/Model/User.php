<?php

namespace CivUser\Model;

class User
{
    public $id;
    public $domain;
    public $username;
    public $password;
    public $displayName;
    public $emailAddress;

    public function getId()
    {
        return $this->id;
    }

    public function getDomain()
    {
        return $this->domain;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getDisplayName()
    {
        return $this->displayName;
    }

    public function getEmailAddress()
    {
        return $this->emailAddress;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function setDomain($domain)
    {
        $this->domain = strtolower($domain);
        return $this;
    }

    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    public function setDisplayName($displayName)
    {
        $this->displayName = $displayName;
        return $this;
    }

    public function setEmailAddress($emailAddress)
    {
        $this->emailAddress = strtolower($emailAddress);
        return $this;
    }



}

