<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

/**
 * Seeds two pre-defined accounts so the application can be tested
 * immediately after `php artisan migrate:fresh --seed`.
 *
 * - admin@hangszer.hu / Admin123! — administrator
 * - user@hangszer.hu  / User123!  — regular user
 */
class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'first_name' => 'Admin',
            'last_name'  => 'Admin',
            'title'      => 'Úr',
            'email'      => 'admin@hangszer.hu',
            'password'   => Hash::make('Admin123!'),
            'is_admin'   => 1,
        ]);

        User::create([
            'first_name' => 'User',
            'last_name'  => 'User',
            'title'      => 'Úr',
            'email'      => 'user@hangszer.hu',
            'password'   => Hash::make('User123!'),
            'is_admin'   => 0,
        ]);
    }
}
