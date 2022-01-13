<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Transaksi extends ResourceController
{
    protected $modelName = 'App\Models\Transaksi';
    protected $format    = 'json';

    public function index()
    {
        $data = $this->model->select('
            tt.id,
            tt.kode_transaksi,
            tt.jumlah,
            tt.menu_id,
            tt.tunai,
            tt.user_id,
            tu.nama as nama_pelayan,
            tm.nama as menu,
            tt.created_at,
            tt.updated_at
        ')
            ->from('tbl_transaksi as tt')
            ->join('tbl_menu as tm', 'tt.menu_id = tm.id', 'LEFT')
            ->join('tbl_user as tu', 'tt.user_id = tu.id', 'LEFT')
            ->findAll();
        return $this->respond($data, 200);
    }

    public function create()
    {
        date_default_timezone_set('Asia/Jakarta');
        $now = date('Y-m-d H:i:s');

        $data = $this->request->getPost();
        $data["created_at"] = $now;
        $data["updated_at"] = $now;

        if(empty($data)) {
            return $this->fail('Data transaksi tidak boleh kosong');
        }

        $save = $this->model->save($data);

        if(!$save) return $this->fail($this->model->errors());

        $response = [
            'status' => 201,
            'error' => null,
            'message' => [
                'success' => 'Berhasil menambah data'
            ]
        ];

        return $this->respondCreated($response);
    }

    public function update($id = null)
    {
        date_default_timezone_set('Asia/Jakarta');
        $now = date('Y-m-d H:i:s');

        $data = $this->request->getRawInput();
        $data['id'] = $id;
        $data["updated_at"] = $now;

        $check_data = $this->model->where('id', $id)->find();

        if (!$check_data) return $this->failNotFound('Data tidak ditemukan');

        $save = $this->model->save($data);

        if(!$save) return $this->fail($this->model->errors());

        $response = [
            'status' => 200,
            'error' => null,
            'message' => [
                'success' => 'Berhasil merubah data'
            ]
        ];

        return $this->respondUpdated($response);
    }

    public function show($id = null)
    {
        $data = $this->request->getRawInput();
        $data['id'] = $id;

        $check_data = $this->model->where('id', $id)->find();

        if (!$check_data) return $this->failNotFound('Data tidak ditemukan');

        return $this->respond($check_data, 200);
    }

    public function delete($id = null)
    {
        $check_data = $this->model->where('id', $id)->find();

        if ($check_data) {
            $this->model->delete($id);

            $response = [
                'status' => 200,
                'error' => null,
                'message' => [
                    'success' => 'Berhasil menghapus data'
                ]
            ];
            return $this->respondDeleted($response);
        } 
        
        return $this->failNotFound('Data tidak ditemukan');
    }
}
