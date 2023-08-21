<?php

namespace App\Models;

use CodeIgniter\Model;

class MainModel extends Model
{
    protected $db;

    function  __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
    }

    public function objDataByID($table, $id)
    {
        $query = $this->db->table($table)
            ->where('id', $id);

        return $query->get()->getResult();
    }

    public function objDataByField($table, $field, $value)
    {
        $query = $this->db->table($table)
        ->where($field, $value);

        return $query->get()->getResult();
    }

    public function checkDuplicate($table, $field, $value, $id = null)
    {
        $query = $this->db->table($table)
            ->where($field, $value);

        if (!empty($id))
            $query->whereNotIn('id', [0 => $id]);

        return $query->get()->getResult();
    }

    public function objCreate($table, $data)
    {
        $query = $this->db->table($table)
            ->insert($data);

        $result = array();

        if ($query->resultID == true) {

            $result['error'] = 0;
            $result['id'] = $query->connID->insert_id;
        } else
            $result['error'] = 1;

        return $result;
    }

    public function objUpdate($table, $data, $id)
    {
        $query = $this->db->table($table)
            ->where('id', $id)
            ->update($data);

        $result = array();

        if ($query == true) {
            $result['error'] = 0;
            $result['id'] = $id;
        } else
            $result['error'] = 1;

        return $result;
    }

    public function objDelete($table, $id)
    {
        $return = array();

        $query = $this->db->table($table)
        ->where('id', $id)
        ->delete();

        if($query == true) {
            $return['error'] = 0;
            $return['msg'] = 'success';
        } else {
            $return['error'] = 0;
            $return['msg'] = 'error on delete record';
        }

        return $return;
    }

    public function dtBasket($basketID)
    {
        $query = $this->db->table('shop_basket_product sbp')
        ->select('
            sbp.id AS id,
            sbp.amount AS amount,
            sp.name AS name,
        ')
        ->join('shop_product sp', 'sp.id = sbp.fk_product')
        ->where('fk_basket', $basketID);

        return $query->get()->getResult();
    }

    public function getShopBasketProductByID($id)
    {
        $query = $this->db->table('shop_basket_product sbp')
        ->select('
            sbp.id AS id,
            sbp.amount AS amount,
            sp.name AS name,
        ')
        ->join('shop_product sp', 'sp.id = sbp.fk_product')
        ->where('sbp.id', $id);

        return $query->get()->getResult();
    }
}