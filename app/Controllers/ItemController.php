<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CategoryModel;
use App\Models\ItemModel;
use App\Models\UserModel;
use CodeIgniter\RESTful\ResourceController;

class ItemController extends ParentController
{
    public function index()
    {
        if (!$this->hasPermission('item.view')) {
            return $this->permissionDenied();
        }

        $model = new ItemModel();

        return $this->respond($model->findAll());
    }

    public function store()
    {
        if (!$this->hasPermission('item.create')) {
            return $this->permissionDenied();
        }

        $rules = [
            'title' => ['rules' => 'required|min_length[4]|max_length[255]'],
            'description' => ['rules' => 'required|max_length[2000]'],
            'status' => ['rules' => 'required'],
            'category_id' => ['rules' => 'required']
        ];

        $user = $this->request->user;

        //return $this->respond($this->request->getPost());

        if ($this->validate($rules)) {
            $model = new ItemModel();

            $data = [
                'title' => $this->request->getVar('title'),
                'description' => $this->request->getVar('description'),
                'status' => $this->request->getVar('status'),
                'category_id' => $this->request->getVar('category_id'),
                'created_by' => $user['id'],
            ];

            $model->save($data);

            return $this->respond(['message' => 'Item Added'], 200);

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

        if (!$this->hasPermission('item.edit')) {
            return $this->permissionDenied();
        }

        $rules = [
            'title' => ['rules' => 'required|min_length[4]|max_length[255]'],
            'description' => ['rules' => 'required|max_length[2000]'],
            'status' => ['rules' => 'required'],
            'category_id' => ['rules' => 'required']
        ];

        $user = $this->request->user;

        //return $this->respond($this->request->getPost());

        if ($this->validate($rules)) {

            $model = new ItemModel();

            $data = [
                'title' => $this->request->getVar('title'),
                'description' => $this->request->getVar('description'),
                'status' => $this->request->getVar('status'),
                'category_id' => $this->request->getVar('category_id'),
                'created_by' => $user['id'],
            ];

            $model->update($id, $data);

            return $this->respond(['message' => 'Item updated'], 200);

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
        if (!$this->hasPermission('item.delete')) {
            return $this->permissionDenied();
        }

        $model = new ItemModel();

        $model->delete($id);

        return $this->respond([
            'message' => 'Item Deleted successfully'
        ]);
    }

}
