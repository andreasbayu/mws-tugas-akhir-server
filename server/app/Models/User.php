<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class User extends Model
{
    protected $table            = 'tbl_user';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = [
        'nama',
        'username',
        'password',
        'foto_profil',
        'role',
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
        'nama' => 'required',
        'username' => 'required',
        'password' => 'required',
        'role' => 'required'
    ];
    protected $skipValidation       = false;

    /**
     * @throws Exception
     */
    public function findUserByUsername($username)
    {
        $user = $this->asArray()->where(['username' => $username])->first();

        if(!$user) {
            throw new Exception('User tidak ditemukan !!');
        } else {
            return $user;
        }
    }
}
