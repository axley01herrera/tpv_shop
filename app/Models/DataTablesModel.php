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
}
