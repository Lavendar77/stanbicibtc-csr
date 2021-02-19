<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $rolePermissions = [
            UserRole::ADMIN => [
                'manage programs',
                'manage program coordinators',
                'manage students'
            ],
            UserRole::PROGRAMCOORDINATOR => [
                'manage students'
            ],
            UserRole::STUDENT => [
                'apply to programs'
            ],
        ];

        foreach ($rolePermissions as $role => $permissions) {
            $role = Role::updateOrCreate([
                'name' => $role
            ]);

            foreach ($permissions as $permission) {
                Permission::updateOrCreate([
                    'name' => $permission
                ]);

                $role->givePermissionTo($permission);
            }
        }
    }
}
