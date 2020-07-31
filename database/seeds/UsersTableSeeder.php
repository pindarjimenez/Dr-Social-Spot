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
            'name' => 'John Mark Doe',
            'email' => 'johndoe@gmail.com',
            'password' => Hash::make('secret')
        ];

        $users[] = [
            'name' => 'Jane Mary Roe',
            'email' => 'janeroe@gmail.com',
            'password' => Hash::make('secret321')
        ];

        $users[] = [
            'name' => 'Richard Reyes',
            'email' => 'richarddoe@gmail.com',
            'password' => Hash::make('secret123')
        ];

        $users[] = [
            'name' => 'Pindar',
            'email' => 'pindarjimenez@gmail.com',
            'password' => Hash::make('darken021216')
        ];

        User::insert($users);
    }
}
