<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        DB::table('users')->insert(
            [
                [
                    'name' => 'Admin Admin',
                    'username' => 'AD_Admin_1',
                    'password' => Hash::make('admin1-12345'),
                    'role' => 'admin',
                ],
                [
                    'name' => 'Admin Admin',
                    'username' => 'AD_Admin_2',
                    'password' => Hash::make('admin2-12345'),
                    'role' => 'admin',
                ],
                [
                    'name' => 'Admin Admin',
                    'username' => 'AD_Admin_3',
                    'password' => Hash::make('admin3-12345'),
                    'role' => 'admin',
                ]
            ]
        );
    }
}
