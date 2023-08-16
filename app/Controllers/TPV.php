<?php

namespace App\Controllers;

use App\Models\MainModel;

class TPV extends BaseController
{
    protected $objSession;
    protected $objMainModel;
   
    function  __construct()
    {
        $this->objSession = session();
        $this->objMainModel = new MainModel;
    }

    public function dashboard()
    {
        # VERIFY SESSION
        if(empty($this->objSession->get('user'))) {
            return view('errorPage/sessionExpired');
        }

        $data = array();
        $data['menu_ative'] = 'dashboard';
        $data['page'] = 'dashboard/mainDashboard';
       
        return view('main', $data);
    }

    # PRODUCTS 

    public function products()
    {
        # VERIFY SESSION
        if(empty($this->objSession->get('user'))) {
            return view('errorPage/sessionExpired');
        }

        $data = array();
        $data['menu_ative'] = 'product';
        $data['page'] = 'products/mainProducts';
       
        return view('main', $data);
    }

    public function showModalProduct()
    {
         # VERIFY SESSION
         if(empty($this->objSession->get('user'))) {
            return view('errorPage/sessionExpired');
        }

        $data = array();
        $data['action'] = $this->request->getPost('action');

        if ($data['action'] == 'create')
            $data['title'] = 'Nuevo Artículo';
        elseif ($data['action'] == 'update') {
            $data['title'] = 'Actualizando ' . $data['product'][0]->name;
        }

        return view('modals/modalProduct', $data);
    }

    # SETTINGS

    public function settings()
    {
        # VERIFY SESSION
        if(empty($this->objSession->get('user'))) {
            return view('errorPage/sessionExpired');
        }

        $data = array();
        $data['menu_ative'] = 'settings';
        $data['page'] = 'settings/mainSettings';
        $data['settings'] = $this->objMainModel->objDataByID('shop_config', 1)[0];
       
        return view('main', $data);
    }

    public function updateSettings()
    {
        # VERIFY SESSION
        if(empty($this->objSession->get('user'))) {
            $result['error'] = 2;
            return json_encode($result);
        }

        $data = array();
        $data['name'] = htmlspecialchars(trim($this->request->getPost('name')));
        $data['cif'] = htmlspecialchars(trim($this->request->getPost('cif')));
        $data['address1'] = htmlspecialchars(trim($this->request->getPost('address1')));
        $data['address2'] = htmlspecialchars(trim($this->request->getPost('address2')));
        $data['city'] = htmlspecialchars(trim($this->request->getPost('city')));
        $data['state'] = htmlspecialchars(trim($this->request->getPost('state')));
        $data['zipCode'] = htmlspecialchars(trim($this->request->getPost('zipCode')));
        $data['country'] = htmlspecialchars(trim($this->request->getPost('country')));
        $data['email'] = htmlspecialchars(trim($this->request->getPost('email')));
        $data['phone'] = htmlspecialchars(trim($this->request->getPost('phone')));

        $result = $this->objMainModel->objUpdate('shop_config', $data, 1);

        return json_encode($result);
    }


}