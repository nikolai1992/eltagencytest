<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    private const USERS = [
        [
            'name'  => 'Admin',
            'email'  => 'admin@admin.com',
            'role_id'  => 1,
        ]
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        foreach (self::USERS as $user) {
            $user['password'] = Hash::make('password');
            User::updateOrCreate(['email' => $user['email']], $user);
        }
    }
}
