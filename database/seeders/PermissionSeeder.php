<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        Permission::create([
            'name' => 'user.show',
            'description' => 'Kullanıcı görüntüle'
        ]);
        Permission::create([
            'name' => 'user.create',
            'description' => 'Kullanıcı oluştur'
        ]);
        Permission::create([
            'name' => 'user.update',
            'description' => 'Kullanıcı düzenle'
        ]);
        Permission::create([
            'name' => 'user.delete',
            'description' => 'Kullanıcı sil'
        ]);

        Role::create([
            'name' => 'super-admin',
            'description' => 'Süper Yönetici'
        ]);
        Role::create([
            'name' => 'admin',
            'description' => 'Yönetici'
        ]);
        Role::create([
            'name' => 'user',
            'description' => 'Kullanıcı'
        ]);

    }
}
