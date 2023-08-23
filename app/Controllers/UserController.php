<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\RESTful\ResourceController;

class UserController extends ParentController
{
    public function index()
    {

        if (!$this->hasPermission('user.view')) {
            return $this->permissionDenied();
        }

        $userModel = new UserModel();

        $users = $userModel->findAll();

        return $this->respond($users);

    }

    public function create()
    {

    }

    public function store()
    {
        
        if (!$this->hasPermission('user.create')) {
            return $this->permissionDenied();
        }
        
        $rules = [
            'email' => ['rules' => 'required|min_length[4]|max_length[255]|valid_email|is_unique[users.email]'],
            'password' => ['rules' => 'required|min_length[8]|max_length[255]'],
            'confirm_password' => ['label' => 'confirm password', 'rules' => 'matches[password]'],
            'phone' => ['rules' => 'required|min_length[10]'],
            'name' => ['rules' => 'required|min_length[4]']
        ];

        if ($this->validate($rules)) {
            $model = new UserModel();
            
            $data = [
                'email' => $this->request->getVar('email'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT),
                'name' => $this->request->getVar('name'),
                'phone' => $this->request->getVar('phone'),
                'gender' => $this->request->getVar('gender') ?? null,
                'address' => $this->request->getVar('address') ?? null,
                'role_id' => $this->request->getVar('role_id')
            ];

            $model->save($data);

            return $this->respond(['message' => 'Registered Successfully'], 200);

        } else {
            $response = [
                'errors' => $this->validator->getErrors(),
                'message' => 'Invalid Inputs'
            ];
            return $this->fail($response, 409);

        }

    }

    function update($id = null)
    {
        if (!$this->hasPermission('user.edit')) {
            return $this->permissionDenied();
        }

        $rules = [
            'email' => ['rules' => 'required|min_length[4]|max_length[255]|valid_email'],
            'phone' => ['rules' => 'required|min_length[10]'],
            'name' => ['rules' => 'required|min_length[4]']
        ];


        if ($this->validate($rules)) {

            $model = new UserModel();

            $user = $model->find($id);

            if (empty($user)) {
                return $this->respond(['status' => 'failed', 'message' => 'User not found']);
            }

            $data = [
                'email' => $this->request->getVar('email'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT),
                'name' => $this->request->getVar('name'),
                'phone' => $this->request->getVar('phone'),
                'gender' => $this->request->getVar('gender') ?? null,
                'address' => $this->request->getVar('address') ?? null,
                'role_id' => $this->request->getVar('role_id')
            ];

            $model->update($id, $data);
            return $this->respond(['message' => 'User Updated Successfully'], 200);

        } else {
            $response = [
                'errors' => $this->validator->getErrors(),
                'message' => 'Invalid Inputs'
            ];
            return $this->fail($response, 409);

        }

    }

    function delete($id = null)
    {
        if (!$this->hasPermission('user.delete')) {
            return $this->permissionDenied();
        }

        $model = new UserModel();

        $model->delete($id);

        return $this->respond([
            'message' => 'User deleted successfully'
        ]);
    }

}