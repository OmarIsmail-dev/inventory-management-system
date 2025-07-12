<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use phpDocumentor\Reflection\Types\Null_;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    
    {
        User::create([

            'name'=> 'omar ismail',
            'email'=> 'omeresmail946@gmail.com',
            'password'=> Hash::make('omar1234'),
            'role'=> 'admin',
            'image' => 'https://www.pngkit.com/png/detail/126-1262807_instagram-default-profile-picture-png.png',  
             'supplierType' =>  "Null"
         ]);

    }
}
