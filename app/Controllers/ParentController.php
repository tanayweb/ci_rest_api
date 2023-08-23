<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\RESTful\ResourceController;

class ParentController extends ResourceController
{
    public function hasPermission($perm)
    {
        $permissions = $this->request->permissions;
        $role = $this->request->role;
        
        if(!empty($role) && $role['title'] == 'SuperAdmin'){
            return true;
        }

        return in_array($perm, $permissions);

    }

    public function permissionDenied()
    {
        return $this->respond([
            'message' => 'Permission Denied',
        ]);
    }
}