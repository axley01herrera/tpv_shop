<?php

namespace App\Controllers;

use App\Models\MainModel;
use App\Models\DataTablesModel;
use App\Models\ReportModel;
use App\Models\BarcodeModel;
use Escpos\PrintConnectors\WindowsPrintConnector;
use Escpos\Printer;

class TPV extends BaseController
{
    protected $objSession;
    protected $objMainModel;
    protected $objDataTablesModel;
    protected $objReportModel;
    protected $objBarcodeModel;

    function  __construct()
    {
        $this->objSession = session();
        $this->objMainModel = new MainModel;
        $this->objDataTablesModel = new DataTablesModel;
        $this->objReportModel = new ReportModel;
        $this->objBarcodeModel = new BarcodeModel;
    }

    # DASHBOARD

    public function dashboard()
    {
        # VERIFY SESSION
        if (empty($this->objSession->get('user'))) {
            return view('errorPage/sessionExpired');
        }

        /*
        $connector = new WindowsPrintConnector("smb://AcerNitroDev/POS80 Printer");
        $printer = new Printer($connector);
        $printer -> text("Hello World!\n");
        $printer -> cut();   
        $printer -> close();*/
       
        $data = array();
        $data['menu_ative'] = 'dashboard';
        $data['page'] = 'dashboard/mainDashboard';

        return view('main', $data);
    }

    public function dtProcessingHistory()
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

        $result = $this->objDataTablesModel->dtHistory($params);

        $totalRows = sizeof($result);

        for ($i = 0; $i < $totalRows; $i++) {

            if ($result[$i]->payType == 1)
                $payType = "Efectivo";
            else
                $payType = "Tarjeta";

            $btnOpen = '<button type="button" class="btn-open btn btn-sm btn-success" data-id="' . $result[$i]->basketID . '" title="Re-abrir"><i class="mdi mdi-lock-open-variant-outline"></i></button>';
            $btnPrint = '<button type="button" class="btn-print btn btn-sm btn-secondary" data-id="' . $result[$i]->basketID . '" title="Imprimir"><i class="mdi mdi-printer"></i></button>';
            $btnDelete = '<button type="button" class="btn-del btn btn-sm btn-danger" data-id="' . $result[$i]->basketID . '" title="Eliminar Venta"><i class="mdi mdi-trash-can-outline"></i></button>';

            $col = array();
            $col['id'] = $result[$i]->basketID;
            $col['date'] = $result[$i]->date;
            $col['articles'] = $result[$i]->articles;
            $col['payType'] = $payType;
            $col['amount'] = '€ ' . number_format($result[$i]->amount, 2, ".", ',');
            $col['action'] = $btnOpen . ' ' . $btnPrint . ' ' . $btnDelete;

            $row[$i] =  $col;
        }

        if ($totalRows > 0) {
            if (empty($params['search']))
                $totalRecords = $this->objDataTablesModel->getTotalHistory();
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

    public function collectionDay()
    {
        $data = array();
        $data['collectionDay'] = $this->objReportModel->collectionDay();
        return view('dashboard/collectionDay', $data);
    }

    public function chartWeek()
    {
        $data = array();
        $data['chartWeek'] = $this->objReportModel->chartWeek();
        return view('dashboard/chartWeek', $data);
    }

    public function chartMont()
    {
        if (!empty($this->request->getPostGet('year')))
            $year = $this->request->getPostGet('year');
        else
            $year = date('Y');

        $data = array();
        $data['chartMont'] = $this->objReportModel->chartMont($year);
        $data['year'] = $year;
        $data['currentYear'] = date('Y');
        return view('dashboard/chartMont', $data);
    }

    public function productInfo()
    {
        $data = array();
        $data['productInfo'] = $this->objReportModel->productInfo();
        return view('dashboard/productInfo', $data);
    }

    # TPV

    public function tpv()
    {
        # VERIFY SESSION
        if (empty($this->objSession->get('user'))) {
            return view('errorPage/sessionExpired');
        }

        $data = array();
        $basket = $this->objMainModel->objDataByField('shop_basket', 'status', 1);

        if (empty($basket)) {
            $insert = array();
            $insert['status'] = 1;
            $result = $this->objMainModel->objCreate('shop_basket', $insert);
            $data['basketID'] = $result['id'];
        } else
            $data['basketID'] = $basket[0]->id;

        $data['menu_ative'] = 'tpv';
        $data['page'] = 'tpv/mainTPV';

        return view('main', $data);
    }

    public function dtProcessingProductsTPV()
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

        $result = $this->objDataTablesModel->dtProductsTPV($params);

        $totalRows = sizeof($result);

        for ($i = 0; $i < $totalRows; $i++) {

            $btn_edit = '<button class="ms-1 me-1 btn btn-sm btn-soft-primary btn-add-product" data-id="' . $result[$i]->id . '">Añadir a la Cesta</button>';

            $col = array();
            $col['name'] = $result[$i]->name;
            $col['code'] = $result[$i]->code;
            $col['price'] = '€ ' . number_format($result[$i]->price, 2, ".", ',');
            $col['action'] = $btn_edit;

            $row[$i] =  $col;
        }

        if ($totalRows > 0) {
            if (empty($params['search']))
                $totalRecords = $this->objDataTablesModel->getTotalProductsTPV();
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

    public function dtBasket()
    {
        $basketID = $this->request->getPost('basketID');

        $data = array();
        $data['basket'] = $this->objMainModel->dtBasket($basketID);

        return view('tpv/basket', $data);
    }

    public function addProductToBasket()
    {
        # VERIFY SESSION
        if (empty($this->objSession->get('user'))) {
            $result = array();
            $result['error'] = 2;
            $result['msg'] = 'session expired';
            return json_encode($result);
        }

        $result = $this->objMainModel->objDataByID('shop_product', $this->request->getPost('productID'));

        $data = array();
        $data['fk_basket'] = $this->request->getPost('basketID');
        $data['fk_product'] = $this->request->getPost('productID');
        $data['amount'] = $result[0]->price;

        $result = $this->objMainModel->objCreate('shop_basket_product', $data);

        return json_encode($result);
    }

    public function removeArticleFromBasket()
    {
        # VERIFY SESSION
        if (empty($this->objSession->get('user'))) {
            $result = array();
            $result['error'] = 2;
            $result['msg'] = 'session expired';
            return json_encode($result);
        }

        $id = $this->request->getPost('id');
        $result = $this->objMainModel->objDelete('shop_basket_product', $id);

        return json_encode($result);
    }

    public function modalEditArticleFromBasket()
    {
        # VERIFY SESSION
        if (empty($this->objSession->get('user'))) {
            return view('errorPage/sessionExpired');
        }

        $data = array();
        $data['dataEdit'] = $this->objMainModel->getShopBasketProductByID($this->request->getPost('id'));
        $data['title'] = 'Editando ' . $data['dataEdit'][0]->name;

        return view('modals/modalEditArticleFromBasket', $data);
    }

    public function updateArticlePriceFromBasket()
    {
        # VERIFY SESSION
        if (empty($this->objSession->get('user'))) {
            $result = array();
            $result['error'] = 2;
            $result['msg'] = 'session expired';
            return json_encode($result);
        }

        $data = array();
        $data['amount'] = $this->request->getPost('amount');

        $result = $this->objMainModel->objUpdate('shop_basket_product', $data, $this->request->getPost('id'));

        return json_encode($result);
    }

    public function modalPayType()
    {
        # VERIFY SESSION
        if (empty($this->objSession->get('user'))) {
            return view('errorPage/sessionExpired');
        }

        $data = array();
        $data['title'] = 'Tipo de Pago';
        $data['basketID'] = $this->request->getPost('basketID');

        return view('modals/modalPayType', $data);
    }

    public function charge()
    {
        # VERIFY SESSION
        if (empty($this->objSession->get('user'))) {
            $result = array();
            $result['error'] = 2;
            $result['msg'] = 'session expired';
            return json_encode($result);
        }

        $basketID = $this->request->getPost('basketID');
        $payType = $this->request->getPost('payType');

        $data = array();
        $data['status'] = 0;
        $data['dateTime'] = date("Y-m-d H:i:s");
        $data['date'] = date("Y-m-d");
        $data['payType'] = (int) $payType;

        $result = $this->objMainModel->objUpdate('shop_basket', $data, $basketID);

        return json_encode($result);
    }

    public function reopenBasket()
    {
        # VERIFY SESSION
        if (empty($this->objSession->get('user'))) {
            $result = array();
            $result['error'] = 2;
            $result['msg'] = 'session expired';
            return json_encode($result);
        }

        $basketID = $this->request->getPost('basketID');

        $data = array();
        $data['status'] = 1;

        $result = $this->objMainModel->objUpdate('shop_basket', $data, $basketID);

        return json_encode($result);
    }

    public function deleteBasket()
    {
        # VERIFY SESSION
        if (empty($this->objSession->get('user'))) {
            $result = array();
            $result['error'] = 2;
            $result['msg'] = 'session expired';
            return json_encode($result);
        }

        $basketID = $this->request->getPost('basketID');

        $this->objMainModel->deleteShopBasketProduct($basketID);
        $result = $this->objMainModel->objDelete('shop_basket', $basketID);

        return json_encode($result);
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

            $btn_edit = '<button class="ms-1 me-1 btn btn-sm btn-warning btn-edit-product" data-id="' . $result[$i]->id . '" title="Editar Producto"><span class="mdi mdi-square-edit-outline"></span></button>';
            $btn_code = '<button class="ms-1 me-1 btn btn-sm btn-secondary btn-print-code" data-id="' . $result[$i]->id . '" title="Imprimir Código de Barras"><span class="mdi mdi-barcode"></span></button>';

            $col = array();
            $col['name'] = $result[$i]->name;
            $col['code'] = $result[$i]->code;
            $col['price'] = '€ ' . number_format($result[$i]->price, 2, ".", ',');
            $col['status'] = $status;
            $col['switch'] = $switch;
            $col['action'] = $btn_edit . ' ' . $btn_code;

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
            $result['error'] = 2;
            $result['msg'] = 'session expired';
            return json_encode($result);
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

    public function printBarCode()
    {
        $productID = $this->request->uri->getSegment(3);
        $result = $this->objMainModel->objDataByID('shop_product', $productID);

        $symbology = 'code-128';
        $options = array('sx' => '2', 'h' => '60', 'ph' => '0');
        $code = $result[0]->code;
        $barcode = $this->objBarcodeModel->render_svg($symbology, $code, $options);

        $data = array();
        $data['name'] = $result[0]->name;
        $data['code'] = $result[0]->code;
        $data['barcode'] = $barcode;


        return view('products/printBarCode', $data);
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

    public function showModalChangeKey()
    {
        # VERIFY SESSION
        if (empty($this->objSession->get('user'))) {
            return view('errorPage/sessionExpired');
        }

        $data = array();
        $data['title'] = 'Clave de Acceso';

        return view('modals/modalChangeKey', $data);
    }

    public function updatePassword()
    {
        # VERIFY SESSION
        if (empty($this->objSession->get('user'))) {
            $result['error'] = 2;
            return json_encode($result);
        }

        $password = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);

        $data = array();
        $data['password'] = $password;

        $result = $this->objMainModel->objUpdate('shop_config', $data, 1);

        return json_encode($result);
    }
}
