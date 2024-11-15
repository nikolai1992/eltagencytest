<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    private const ROLES = [
        [
            'name'  => 'Admin',
            'alias'  => 'admin',
        ],
        [
            'name'  => 'Client',
            'alias'  => 'client',
        ]
    ];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        foreach (self::ROLES as $role) {
            Role::updateOrCreate($role, $role);
        }
    }
}
