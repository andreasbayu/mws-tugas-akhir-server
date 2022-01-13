<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Menu extends ResourceController
{
    protected $modelName = 'App\Models\Menu';
    protected $format    = 'json';

    public function index()
    {
        $data = $this->model->select('
            tm.id,
            tm.nama,
            tm.status,
            tm.harga,
            tm.gambar,
            tm.kategori_id,
            tkm.nama as nama_kategori,
            tm.created_at,
            tm.updated_at
        ')
        ->from('tbl_menu as tm')
        ->join('tbl_kategori_menu as tkm', 'tm.kategori_id = tkm.id', 'LEFT')
        ->findAll();

        return $this->respond($data, 200);
    }

    public function create()
    {
        date_default_timezone_set('Asia/Jakarta');
        $now = date('Y-m-d H:i:s');

        $file = $this->request->getFile("gambar");
        $data = $this->request->getPost();

        if(empty($data)) return $this->fail('Data menu tidak boleh kosong');

        $data["created_at"] = $now;
        $data["updated_at"] = $now;

        if ($file != null) {
            $guessExtension = $file->guessExtension();
            $allowedExtension = ["png", "jpg"];

            if (!in_array($guessExtension, $allowedExtension)) {
                return $this->fail("Gambar tidak sesuai", 400);
            }
            $fileName = time().'-'.$data["nama"].'.'.$guessExtension;
            $data["gambar"] = $fileName;
            $file->store( 'menu', $fileName);
            // windows alternative
            // $file->move(ROOTPATH.'public/uploads/menu', $fileName);
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

            if ($check_data[0]["gambar"] !== "") {

                $path = ROOTPATH . 'writable/uploads/menu/' . $check_data[0]["gambar"];

                if (file_exists($path)) {
                    helper('filesystem');
                    unlink($path);
                }
            }

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
