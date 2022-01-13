<?php

namespace App\Models;

use CodeIgniter\Model;

class Transaksi extends Model
{
    protected $table            = 'tbl_transaksi';
    protected $primaryKey       = 'kode_transaksi';
    protected $useAutoIncrement = true;
    protected $allowedFields    = [
        'tunai',
        'user_id',
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
        'tunai' => 'required',
        'user_id' => 'required',
    ];
    protected $skipValidation       = false;
}
