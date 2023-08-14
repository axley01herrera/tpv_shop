<?php

namespace App\Controllers;

use App\Models\AuthenticationModel;

class Authentication extends BaseController
{
    protected $objSession;
    protected $objAuthenticationModel;

    function  __construct()
    {
        $this->objSession = session();
        $this->objAuthenticationModel = new AuthenticationModel;

        # CREATE SESSION

        $this->objSession->set('user', []);
    }

    public function index()
    {
        $data = array();
        $data['session'] = $this->request->getPostGet('session');

        return view('authentication/login', $data);
    }

    public function login()
    {
        $password = $this->request->getPost('password');
        $result = $this->objAuthenticationModel->login($password);

        if($result['error'] == 0) {

            # CREATE SESSION
            $this->objSession->set('user', $result['data'][0]);
        }

        return json_encode($result);
    }
}
