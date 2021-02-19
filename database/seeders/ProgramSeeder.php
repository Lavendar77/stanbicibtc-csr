<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\Program;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $programCoordinator = User::role(UserRole::PROGRAMCOORDINATOR)->first();

        // Create the scholarship program
        Program::factory()
            ->state(function () use ($programCoordinator) {
                return [
                    'name' => 'Scholarship Application',
                    'user_id' => $programCoordinator->id
                ];
            })
            ->create();
    }
}
