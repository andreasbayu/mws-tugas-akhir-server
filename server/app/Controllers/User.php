<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class User extends ResourceController
{
    protected $modelName = 'App\Models\User';
    protected $format    = 'json';

    public function index()
    {
        $data = $this->model->orderBy('id', 'asc')->findAll();
        return $this->respond($data, 200);
    }

    public function create()
    {
        date_default_timezone_set('Asia/Jakarta');
        $now = date('Y-m-d H:i:s');

        $file = $this->request->getFile("foto-profil");
        $data = $this->request->getPost();
        $data["username"]   = strtolower($data["username"]);
        $data["password"]   = password_hash($data["password"], PASSWORD_BCRYPT);
        $data["created_at"] = $now;
        $data["updated_at"] = $now;

        if ($file != null) {
            $guessExtension = $file->guessExtension();
            $allowedExtension = ["png", "jpg"];

            if (!in_array($guessExtension, $allowedExtension)) {
                return $this->fail("Gambar tidak sesuai", 400);
            }

            $fileName = time().'-'.$data["username"].'.'.$guessExtension;
            $data["foto_profil"] = $fileName;
            $file->store( 'foto-profil', $fileName);
            // windows alternative
            // $file->move(ROOTPATH.'public/uploads/foto-profil', $fileName);
        }

        $save = $this->model->save($data);

        if(empty($data)) return $this->fail('Data tidak boleh kosong');

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
        $data['id']         = $id;
        $data["username"]   = strtolower($data["username"]);
        $data["password"]   = password_hash($data["password"], PASSWORD_BCRYPT);
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

            if ($check_data[0]["foto_profil"] !== "") {

                $path = ROOTPATH . 'writable/uploads/foto-profil/' . $check_data[0]["foto_profil"];

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
