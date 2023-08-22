<?php

namespace App\Models;

use CodeIgniter\Model;

class ReportModel extends Model
{
    protected $db;

    function  __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
    }

    public function collectionDay()
    {
        $query = $this->db->table('shop_basket')
        ->select('
            shop_basket_product.amount AS amount,
            shop_basket.payType AS payType,
        ')
        ->join('shop_basket_product', 'shop_basket_product.fk_basket = shop_basket.id')
        ->where('date', date("Y-m-d"))
        ->where('status', 0);

        $data = $query->get()->getResult(); 

        $cash = 0;
        $card = 0;

        foreach($data as $index) {
            if($index->payType == 1)
                $cash = $cash + $index->amount;
            elseif($index->payType == 2)
                $card = $card + $index->amount;
        }

        $return = array();
        $return['cash'] = $cash;
        $return['card'] = $card;

        return $return;
    }
}