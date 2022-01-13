<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriMenu extends Model
{
    protected $table            = 'tbl_kategori_menu';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = [
        'nama',
        'gambar',
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
    ];
    // protected $validationMessages   = [
    //     'nama'  => [
    //         'required' => 'nama tidak boleh kosong'
    //     ]
    // ];
    protected $skipValidation       = false;

}
