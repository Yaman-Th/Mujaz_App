<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\admin;
use App\Models\teacher;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::factory(1)->create();

        teacher::create([
            'name' => $user->first()->name,
            'user_id' => $user->first()->id,
        ]);

        admin::create([
            'name' => $user->first()->name,
            'user_id' => $user->first()->id,
        ]);
        //DB::table('admins')->insert();
        /*
        $user = User::create(
            [
                'name' => 'Admin Admin',
                'username' => 'AD_Admin_1',
                'password' => Hash::make('admin1-12345'),
                'role' => 'admin',
                'remember_token'=> $token
            ]
        );
        $token = $user->createToken('myapptoken')->plainTextToken;

        */
        /*
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
        */

        /*
        DB::table('admins')->insert(
            [
                [
                    'name' => 'Admin Admin',
                    'username' => 'AD_Admin_1',
                    'password' => Hash::make('admin1-12345'),

                ],
                [
                    'name' => 'Admin Admin',
                    'username' => 'AD_Admin_2',
                    'password' => Hash::make('admin2-12345'),

                ],
                [
                    'name' => 'Admin Admin',
                    'username' => 'AD_Admin_3',
                    'password' => Hash::make('admin3-12345'),

                ]
            ]
        );
        */
    }
}
