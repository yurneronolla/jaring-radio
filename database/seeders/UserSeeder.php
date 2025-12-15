<?php
// database/seeders/UserSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@jaringradio.com',
            'password' => Hash::make('password123'),
        ]);

        User::create([
            'name' => 'User Demo',
            'email' => 'user@jaringradio.com',
            'password' => Hash::make('password123'),
        ]);
    }
}