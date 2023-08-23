<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PermissionModel;
use App\Models\RoleModel;
use App\Models\UserModel;
use CodeIgniter\RESTful\ResourceController;

class PermissionController extends ParentController
{
    public function index()
    {
        if (!$this->hasPermission('permission.view')) {
            return $this->permissionDenied();
        }

        $model = new PermissionModel();

        return $this->respond($model->findAll());
    }

    public function store()
    {

        if (!$this->hasPermission('permission.create')) {
            return $this->permissionDenied();
        }

        $rules = [
            'name' => ['rules' => 'required|min_length[4]|max_length[255]|is_unique[permissions.name]'],
        ];


        if ($this->validate($rules)) {
            $model = new PermissionModel();

            $data = [
                'name' => $this->request->getVar('name'),
            ];

            $model->save($data);

            return $this->respond(['message' => 'Permission Added'], 200);

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

        if (!$this->hasPermission('permission.edit')) {
            return $this->permissionDenied();
        }

        $model = new PermissionModel();

        $role = $model->find($id);

        $rules = [
            'name' => ['rules' => 'required|min_length[4]|max_length[255]'],
        ];


        if ($this->validate($rules)) {

            $data = [
                'name' => $this->request->getVar('name'),
            ];

            $model->update($id, $data);

            return $this->respond(['message' => 'Permission updated'], 200);

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

        if (!$this->hasPermission('permission.delete')) {
            return $this->permissionDenied();
        }

        $model = new PermissionModel();

        $model->delete($id);

        return $this->respond([
            'message' => 'Permission deleted successfully'
        ]);
    }
}