<?php

namespace Database\Seeders\Tenant;

use Illuminate\Database\Seeder;

class TenantSpecificSeeder extends Seeder
{
    public function run()
    {
        $this->call(CreateAdminUserSeeder::class);
        $this->call(CreateRolesHasPermissions::class);
        $this->call(PermissionTableSeeder::class);
        $this->call(ConfiguracionSeeder::class);
    }
}
