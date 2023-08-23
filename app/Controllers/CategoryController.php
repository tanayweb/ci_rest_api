<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CategoryModel;
use App\Models\UserModel;
use CodeIgniter\RESTful\ResourceController;

class CategoryController extends ParentController
{
    public function index()
    {
        if (!$this->hasPermission('category.view')) {
            return $this->permissionDenied();
        }

        $model = new CategoryModel();

        return $this->respond($model->findAll());
    }

    public function store()
    {

        if (!$this->hasPermission('category.view')) {
            return $this->permissionDenied();
        }

        $rules = [
            'title' => ['rules' => 'required|min_length[4]|max_length[255]'],
            'description' => ['rules' => 'required|max_length[2000]'],
            'status' => ['rules' => 'required']
        ];

        $user = $this->request->user;

        if ($this->validate($rules)) {
            $model = new CategoryModel();

            $data = [
                'title' => $this->request->getVar('title'),
                'description' => $this->request->getVar('description'),
                'status' => $this->request->getVar('status'),
                'created_by' => $user['id']
            ];

            $model->save($data);

            return $this->respond(['message' => 'Category Added'], 200);

        } else {
            $response = [
                'errors' => $this->validator->getErrors(),
                'message' => 'Invalid Inputs'
            ];
            return $this->fail($response, 409);

        }
    }

    public function update($id = null)
    {
        if (!$this->hasPermission('category.edit')) {
            return $this->permissionDenied();
        }

        $rules = [
            'title' => ['rules' => 'required|min_length[4]|max_length[255]'],
            'description' => ['rules' => 'required|max_length[2000]'],
            'status' => ['rules' => 'required'],

        ];

        $user = $this->request->user;

        if ($this->validate($rules)) {

            $model = new CategoryModel();

            $data = [
                'title' => $this->request->getVar('title'),
                'description' => $this->request->getVar('description'),
                'status' => $this->request->getVar('status'),
                'created_by' => $user['id']
            ];

            $model->update($id, $data);

            return $this->respond(['message' => 'Category Updated'], 200);

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
        if (!$this->hasPermission('category.delete')) {
            return $this->permissionDenied();
        }

        $model = new CategoryModel();

        $model->delete($id);

        return $this->respond([
            'message' => 'Category Deleted successfully'
        ]);
    }

}