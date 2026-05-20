<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name'     => 'Administrator',
            'email'    => 'admin@breathe.ru',
            'password' => Hash::make('password'),
            'is_admin' => true,
        ]);

        $users = [
            ['name' => 'Анна Белова',    'email' => 'anna@example.com'],
            ['name' => 'Михаил Орлов',   'email' => 'mikhail@example.com'],
            ['name' => 'Елена Соколова', 'email' => 'elena@example.com'],
            ['name' => 'Дмитрий Волков', 'email' => 'dmitry@example.com'],
            ['name' => 'Наталья Кузнецова', 'email' => 'natalia@example.com'],
        ];

        foreach ($users as $user) {
            User::create(array_merge($user, [
                'password' => Hash::make('password'),
                'is_admin' => false,
            ]));
        }
    }
}
