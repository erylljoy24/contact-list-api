<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use DB;
   

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            array(
                'first_name' => Str::random(10),
                'last_name' => Str::random(10),
                'image' => 'N/A',
                'mobile_number' => '09999999999',
                'address' => 'Davao City',
                'email' => Str::random(10).'@gmail.com',
                'password' => Hash::make('password'),
            ),
        ];

        try {
            DB::beginTransaction();

            $users = collect($users);            
            $users->each(function($user) {
                $data = User::create($user);
            });
            
            DB::commit();
        } catch (Exception $error) {
            DB::rollback();
        }
    }
}
