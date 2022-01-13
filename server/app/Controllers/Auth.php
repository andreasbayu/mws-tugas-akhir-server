<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use Config\App;
use Exception;

class Auth extends ResourceController
{
    use ResponseTrait;

    /**
     * @throws Exception
     */
    public function index()
    {
         $validation = \Config\Services::validation();

         $rules = [
             'username' => [
                 'rules' => 'required',
                 'errors' => [
                     'required' => 'Username tidak boleh kosong'
                 ]
             ],
             'password' => [
                 'rules' => 'required',
                 'errors' => 'Password tidak boleh kosong'
             ]
         ];

         $validation->setRules($rules);

         if (!$validation->withRequest($this->request)->run()) return $this->fail($validation->getErrors());

         $model = new \App\Models\User();
        
         $username = $this->request->getVar('username');
         $password = $this->request->getVar('password');
        
         $data = $model->findUserByUsername($username);

         if (!password_verify($password, $data['password'])) return $this->fail('Authentication failed');

         helper('jwt');

         $response = [
             'message' => 'authenticate success',
             'data' => $data,
             'access_token' => createJWT($username),
         ];

         return $this->respond($response);
    }
}
