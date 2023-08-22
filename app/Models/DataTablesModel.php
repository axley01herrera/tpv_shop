<?php

namespace App\Models;

use CodeIgniter\Model;

class DataTablesModel extends Model
{
    protected $db;

    function  __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
    }

    # DASHBOARD

    public function dtHistory($params)
    {
        $query = $this->db->table('shop_basket')
            ->select('
            shop_basket.id as basketID,
            shop_basket.dateTime AS date,
            COUNT(shop_basket.id) AS articles,
            SUM(shop_basket_product.amount) AS amount
            ', FALSE)
        ->join('shop_basket_product', 'shop_basket_product.fk_basket = shop_basket.id');
        
        $query->where('status', 0);

        if (!empty($params['search'])) {
            $query->groupStart();
            $query->like('shop_basket.id', $params['search']);
            $query->orLike('shop_basket.dateTime', $params['search']);
            $query->groupEnd();
        }

        $query->offset($params['start']);
        $query->limit($params['length']);
        $query->orderBy($this->dtHistorySort($params['sortColumn'], $params['sortDir']));
        $query->groupBy('shop_basket.id');

        // $compiled = $query->getCompiledSelect(); echo $compiled; exit();

        return $query->get()->getResult();
    }

    public function dtHistorySort($column, $dir)
    {
        $sort = '';

        if ($column == 0) {
            if ($dir == 'asc')
                $sort = 'shop_basket.id ASC';
            else
                $sort = 'shop_basket.id DESC';
        } elseif ($column == 1) {
            if ($dir == 'asc')
                $sort = 'shop_basket.dateTime ASC';
            else
                $sort = 'shop_basket.dateTime DESC';
        } 

        return $sort;
    }

    public function getTotalHistory()
    {
        $query = $this->db->table('shop_basket')
            ->selectCount('id')
            ->where('status', 0)
            ->get()->getResult();

        return $query[0]->id;
    }


    # PRODUCTS

    public function dtProducts($params)
    {
        $query = $this->db->table('shop_product')
            ->select('id,
            name,
            code,
            price,
            status,
            CASE 
                WHEN "status" = 0 THEN "Inactivo" 
                WHEN "status" = 1 THEN "Activo" 
            END AS statusLabel', FALSE);

        if (!empty($params['search'])) {
            $query->like('name', $params['search']);
            $query->orLike('code', $params['search']);
        }

        $query->offset($params['start']);
        $query->limit($params['length']);
        $query->orderBy($this->dtProductsSort($params['sortColumn'], $params['sortDir']));

        return $query->get()->getResult();
    }

    public function dtProductsSort($column, $dir)
    {
        $sort = '';

        if ($column == 0) {
            if ($dir == 'asc')
                $sort = 'name ASC';
            else
                $sort = 'name DESC';
        } elseif ($column == 1) {
            if ($dir == 'asc')
                $sort = 'code ASC';
            else
                $sort = 'code DESC';
        } elseif ($column == 3) {
            if ($dir == 'asc')
                $sort = 'code ASC';
            else
                $sort = 'code DESC';
        }

        return $sort;
    }

    public function getTotalProducts()
    {
        $query = $this->db->table('shop_product')
            ->selectCount('id')
            ->get()->getResult();
            
        return $query[0]->id;
    }

    # TPV

    public function dtProductsTPV($params)
    {
        $query = $this->db->table('shop_product')
            ->select('id, name, code, price');

        $query->where('status', 1);

        if (!empty($params['search'])) {
            $query->groupStart();
            $query->like('name', $params['search']);
            $query->orLike('code', $params['search']);
            $query->groupEnd();
        }

        
        $query->offset($params['start']);
        $query->limit($params['length']);
        $query->orderBy($this->dtProductsSortTPV($params['sortColumn'], $params['sortDir']));

        return $query->get()->getResult();
    }

    public function dtProductsSortTPV($column, $dir)
    {
        $sort = '';

        if ($column == 0) {
            if ($dir == 'asc')
                $sort = 'name ASC';
            else
                $sort = 'name DESC';
        } elseif ($column == 1) {
            if ($dir == 'asc')
                $sort = 'code ASC';
            else
                $sort = 'code DESC';
        } elseif ($column == 2) {
            if ($dir == 'asc')
                $sort = 'price ASC';
            else
                $sort = 'price DESC';
        }

        return $sort;
    }

    public function getTotalProductsTPV()
    {
        $query = $this->db->table('shop_product')
            ->selectCount('id')
            ->where('status', 1)
            ->get()->getResult();

        return $query[0]->id;
    }
}
