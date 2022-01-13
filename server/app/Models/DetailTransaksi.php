<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailTransaksi extends Model
{
    protected $table            = 'tbl_detail_transaksi';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = [
        'kode_transaksi',
        'menu_id',
        'jumlah',
        'created_at',
        'updated_at'
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules      = [
        'kode_transaksi' => 'required',
        'menu_id' => 'required',
        'jumlah' => 'required',
        'user_id' => 'required',
    ];
    protected $skipValidation       = false;
}
