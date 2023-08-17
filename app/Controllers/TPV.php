<?php

namespace App\Controllers;

use App\Models\MainModel;
use App\Models\DataTablesModel;

class TPV extends BaseController
{
    protected $objSession;
    protected $objMainModel;
    protected $objDataTablesModel;

    function  __construct()
    {
        $this->objSession = session();
        $this->objMainModel = new MainModel;
        $this->objDataTablesModel = new DataTablesModel;
    }

    public function dashboard()
    {
        # VERIFY SESSION
        if (empty($this->objSession->get('user'))) {
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
        if (empty($this->objSession->get('user'))) {
            return view('errorPage/sessionExpired');
        }

        $data = array();
        $data['menu_ative'] = 'product';
        $data['page'] = 'products/mainProducts';

        return view('main', $data);
    }

    public function dtProcessingProducts()
    {
        $dataTableRequest = $_REQUEST;

        $params = array();
        $params['draw'] = $dataTableRequest['draw'];
        $params['start'] = $dataTableRequest['start'];
        $params['length'] = $dataTableRequest['length'];
        $params['search'] = $dataTableRequest['search']['value'];
        $params['sortColumn'] = $dataTableRequest['order'][0]['column'];
        $params['sortDir'] = $dataTableRequest['order'][0]['dir'];

        $row = array();
        $totalRecords = 0;

        $result = $this->objDataTablesModel->dtProducts($params);

        $totalRows = sizeof($result);

        for ($i = 0; $i < $totalRows; $i++) {

            $switch = '';
            $status = '';

            if ($result[$i]->status == 1) {
                $status = '<span class="badge bg-success">' . $result[$i]->statusLabel . '</span>';
                $switch = '<div class="form-check form-switch form-switch-md mb-2" title="desactivar/activar" >
                                                <input data-id="' . $result[$i]->id . '" data-status="' . $result[$i]->status . '" class="form-check-input switch" type="checkbox" id="flexSwitchCheckChecked" checked />
                                            </div>';
            } else {
                $status = '<span class="badge bg-danger">' . $result[$i]->statusLabel . '</span>';
                $switch = '<div class="form-check form-switch form-switch-md mb-2" title="desactivar/activar" >
                                                <input data-id="' . $result[$i]->id . '" data-status="' . $result[$i]->status . '" class="form-check-input switch" type="checkbox" id="flexSwitchCheckChecked" />
                                            </div>';
            }

            $btn_edit = '<button class="ms-1 me-1 btn btn-sm btn-warning btn-edit-product" data-id="' . $result[$i]->id . '" cat-id=""><span class="mdi mdi-square-edit-outline" title="Editar Producto"></span></button>';

            $col = array();
            $col['name'] = $result[$i]->name;
            $col['code'] = $result[$i]->code;
            $col['price'] = '€ ' . number_format($result[$i]->price, 2, ".", ',');
            $col['status'] = $status;
            $col['switch'] = $switch;
            $col['action'] = $btn_edit;

            $row[$i] =  $col;
        }

        if ($totalRows > 0) {
            if (empty($params['search']))
                $totalRecords = $this->objDataTablesModel->getTotalProducts();
            else
                $totalRecords = $totalRows;
        }

        $data = array();
        $data['draw'] = $dataTableRequest['draw'];
        $data['recordsTotal'] = intval($totalRecords);
        $data['recordsFiltered'] = intval($totalRecords);
        $data['data'] = $row;

        return json_encode($data);
    }

    public function showModalProduct()
    {
        # VERIFY SESSION
        if (empty($this->objSession->get('user'))) {
            return view('errorPage/sessionExpired');
        }

        $data = array();
        $data['action'] = $this->request->getPost('action');

        if ($data['action'] == 'create')
            $data['title'] = 'Nuevo Artículo';
        elseif ($data['action'] == 'update') {
            $id = $this->request->getPost('id');
            $data['product'] = $this->objMainModel->objDataByID('shop_product', $id);
            $data['title'] = 'Actualizando ' . $data['product'][0]->name;
        }

        return view('modals/modalProduct', $data);
    }

    public function createProduct()
    {
        $result = array();

        # VERIFY SESSION
        if (empty($this->objSession->get('user'))) {
            $result['error'] = 2;
            $result['msg'] = 'session expired';
            return json_encode($result);
        }

        $data = array();
        $data['name'] = htmlspecialchars(trim($this->request->getPost('name')));
        $data['code'] = htmlspecialchars(trim($this->request->getPost('code')));
        $data['price'] = htmlspecialchars(trim($this->request->getPost('price')));

        $checkDuplicate = $this->objMainModel->checkDuplicate('shop_product', 'code', $data['code']);

        if (empty($checkDuplicate)) {
            $result = $this->objMainModel->objCreate('shop_product', $data);
        } else {
            $result['error'] = 3;
            $result['msg'] = 'duplicate record';
        }

        return json_encode($result);
    }

    public function updateProduct()
    {
        $result = array();

        # VERIFY SESSION
        if (empty($this->objSession->get('user'))) {
            return view('errorPage/sessionExpired');
        }

        $id = $this->request->getPost('id');

        $data = array();
        $data['name'] = htmlspecialchars(trim($this->request->getPost('name')));
        $data['code'] = htmlspecialchars(trim($this->request->getPost('code')));
        $data['price'] = htmlspecialchars(trim($this->request->getPost('price')));

        $checkDuplicate = $this->objMainModel->checkDuplicate('shop_product', 'code', $data['code'], $id);

        if (empty($checkDuplicate)) {
            $result = $this->objMainModel->objUpdate('shop_product', $data, $id);
        } else {
            $result['error'] = 3;
            $result['msg'] = 'duplicate record';
        }

        return json_encode($result);
    }

    public function changeProductStatus()
    {
        $result = array();

        # VERIFY SESSION
        if (empty($this->objSession->get('user'))) {
            $result['error'] = 2;
            $result['msg'] = 'session expired';
            return json_encode($result);
        }

        $id = $this->request->getPost('id');

        $data = array();
        $data['status'] = $this->request->getPost('status');

        $result = $this->objMainModel->objUpdate('shop_product', $data, $id);

        return json_encode($result);
    }

    # SETTINGS

    public function settings()
    {
        # VERIFY SESSION
        if (empty($this->objSession->get('user'))) {
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
        if (empty($this->objSession->get('user'))) {
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
