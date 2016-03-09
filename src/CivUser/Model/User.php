<?php

namespace CivUser\Model;

class User
{
    public $id;
    public $domain;
    public $username;
    public $password;

    public function exchangeArray($data)
    {
        $this->id     = (!empty($data['id'])) ? $data['id'] : null;
        $this->artist = (!empty($data['domain'])) ? $data['domain'] : null;
        $this->title  = (!empty($data['username'])) ? $data['username'] : null;
        $this->title  = (!empty($data['password'])) ? $data['username'] : null;
        $this->title  = (!empty($data['displayName'])) ? $data['displayName'] : null;
    }

}

