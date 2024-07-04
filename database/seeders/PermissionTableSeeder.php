<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
           'role-list',
           'role-create',
           'role-edit',
           'role-delete',
           'client-list',
           'client-create',
           'client-edit',
           'client-delete',
           'clientes-list',
           'clientes-create',
           'clientes-edit',
           'clientes-delete',
           'subclientes-create',
           'subclientes-view',
           'proovedores-create',
           'proovedores-edit',
           'proovedores-cuentas',
           'proovedores-cuentas-create',
           'operadores-create',
           'operadores-edit',
           'cotizaciones-create',
           'cotizaciones-edit',
           'cotizaciones-estatus',
           'roles-permisos-users',
        ];

        foreach ($permissions as $permission) {
             Permission::create(['name' => $permission]);
        }
    }
}
