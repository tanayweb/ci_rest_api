<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PermissionModel;
use App\Models\RoleModel;
use App\Models\RolePermission;
use App\Models\UserModel;
use CodeIgniter\RESTful\ResourceController;
use Config\Database;

class RoleController extends ParentController
{
    public function index()
    {
        if (!$this->hasPermission('role.view')) {
            return $this->permissionDenied();
        }

        $model = new RoleModel();

        return $this->respond($model->findAll());
    }

    public function store(){
        if (!$this->hasPermission('role.create')) {
            return $this->permissionDenied();
        }
        $rules = [
            'title' => ['rules' => 'required|min_length[4]|max_length[255]|is_unique[roles.title]'],
            'description' => ['rules' => 'required|max_length[2000]'],
            'status' => ['rules' => 'required']
        ];
        if ($this->validate($rules)) {
            $model = new RoleModel();
            $data = [
                'title' => $this->request->getVar('title'),
                'description' => $this->request->getVar('description'),
                'status' => $this->request->getVar('status'),
            ];
            $model->save($data);
            return $this->respond(['message' => 'Role Added'], 200);
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
        if (!$this->hasPermission('role.edit')) {
            return $this->permissionDenied();
        }
        $model = new RoleModel();

        $role = $model->find($id);

        $rules = [
            'title' => ['rules' => 'required|min_length[4]|max_length[255]'],
            'description' => ['rules' => 'required|max_length[2000]'],
            'status' => ['rules' => 'required']
        ];
        if ($this->validate($rules)) {

            $data = [
                'title' => $this->request->getVar('title'),
                'description' => $this->request->getVar('description'),
                'status' => $this->request->getPost('status'),
            ];

            $model->update($id, $data);

            return $this->respond(['message' => 'Role updated'], 200);

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

        if (!$this->hasPermission('role.delete')) {
            return $this->permissionDenied();
        }

        $model = new RoleModel();

        $model->delete($id);

        return $this->respond([
            'message' => 'Role deleted successfully'
        ]);
    }

    function updatePermissions($id = null)
    {
        if (!$this->hasPermission('role.edit')) {
            return $this->permissionDenied();
        }

        $permissions = $this->request->getVar('permissions');

        foreach ($permissions as $permission) {
            $perm = (new PermissionModel())->find($id);

            $model = new RolePermission();

            $exist = (new RolePermission())->where('role_id', $id)
                ->where("permission_id", $perm['id'])
                ->first();

            if(empty($exist)) {
                $model->save([
                    'role_id' => $id,
                    'permission_id' => $perm['id'],
                ]);
            }

        }
        return $this->respond([
            'status' => 'success',
            'message' => 'Role Permission Updated'
        ]);
    }
}