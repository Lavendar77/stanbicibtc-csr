<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create admins
        User::factory(1)
            ->state([
                'email' => 'admin@' . config('app.domain')
            ])
            ->create()
            ->each(function ($admin) {
                $admin->assignRole(UserRole::ADMIN);
            });

        // Create a program coordinator
        User::factory(1)
            ->state([
                'email' => 'programcoordinator@' . config('app.domain')
            ])
            ->create()
            ->each(function ($programCoordinator) {
                $programCoordinator->assignRole(UserRole::PROGRAMCOORDINATOR);
            });
    }
}
