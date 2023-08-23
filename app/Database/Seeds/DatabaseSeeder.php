<?php

namespace App\Database\Seeds;

use App\Models\RoleModel;
use App\Models\RolePermission;
use App\Models\UserModel;
use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $userData =
            [
                'name' => "Admin User",
                'email' => 'admin@gmail.com',
                'password' => password_hash('admin@gmail.com', PASSWORD_BCRYPT),
                'gender' => 'male',
                'address' => 'test address',
                'phone' => '0123456789'
            ];

        $userModel = new UserModel();

        $role = (new RoleModel())->save([
            'name' => 'SuperAdmin',
            'description' => 'Super Admin Role',
        ]);

        // Using Query Builder to insert data
        $user = $userModel->save($userData);
    }
}
