<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users[] = [
            'name' => 'John Doe',
            'email' => 'johndoe@gmail.com',
            'password' => Hash::make('secret')
        ];

        $users[] = [
            'name' => 'Jane Roe',
            'email' => 'janeroe@gmail.com',
            'password' => Hash::make('secret321')
        ];

        $users[] = [
            'name' => 'Richard Doe',
            'email' => 'richarddoe@gmail.com',
            'password' => Hash::make('secret123')
        ];

        User::insert($users);
    }
}
