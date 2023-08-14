<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthenticationModel extends Model
{
    protected $db;

    function  __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
    }

    public function login($password)
    {
        $query = $this->db->table('shop_config');
        $data = $query->get()->getResult();

        $return = array();

        if (password_verify($password, $data[0]->password)) {
            $return['error'] = 0;
            $return['data'] = $data;
        } else {
            $return['error'] = 1;
            $return['data'] = '';
        }

        return $return;    
    }

}
