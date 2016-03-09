<?php

namespace CivUser\Model;

use Zend\Db\TableGateway\TableGateway;

class UserTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }
    
    public function getUser($domain, $username)
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('domain' => $domain, 'username' => $username));
        $row = $rowset->current();
        return $row;
    }
    
    public function saveUser(User $user)
    {
        $data = array(
            'domain'   => $user->domain,
            'username' => $user->username,
            'display_name' => $user->displayName,
        );

        $id = (int) $user->id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getUser($user->domain, $user->username)) {
                $this->tableGateway->update($data, array('id' => $id));
            }
        }
    }

}