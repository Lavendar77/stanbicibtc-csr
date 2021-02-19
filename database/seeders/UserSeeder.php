<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\Program;
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
        User::factory()
            ->state([
                'email' => 'admin@' . config('app.domain')
            ])
            ->create()
            ->each(function ($admin) {
                $admin->assignRole(UserRole::ADMIN);
            });

        // Create a program coordinator
        User::factory()
            ->state([
                'email' => 'programcoordinator@' . config('app.domain')
            ])
            ->has(
                Program::factory()
                    ->state(function (array $attributes, User $user) {
                        return [
                            'name' => 'Scholarship Application',
                            'user_id' => $user->id
                        ];
                    })
            )
            ->create()
            ->each(function ($programCoordinator) {
                $programCoordinator->assignRole(UserRole::PROGRAMCOORDINATOR);
            });
    }
}
