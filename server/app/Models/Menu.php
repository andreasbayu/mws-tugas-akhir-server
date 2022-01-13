<?php

namespace App\Models;

use CodeIgniter\Model;

class Menu extends Model
{
    protected $table            = 'tbl_menu';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = [
        'nama',
        'kategori_id',
        'harga',
        'gambar',
        'status',
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
        'nama'  => 'required',
        'kategori_id' => 'required',
        'harga' => 'required',
        'status' => 'required'
    ];
    protected $skipValidation       = false;

}
