<?php

use Illuminate\Database\Seeder;
use App\Models\UserInformation;

class UserInformationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userInformations[] = [
            'user_id' => '1',
            'mobile' => '09123456789',
            'gender' => 'Male',
            'birthdate' => '1995-05-16',
            'address' => 'Cebu City, Cebu, Philippines',
            'age' => '25',
        ];

        $userInformations[] = [
            'user_id' => '2',
            'mobile' => '09123456789',
            'gender' => 'Female',
            'birthdate' => '1994-03-12',
            'address' => 'Bacolod City, Negros Occidental, Philippines',
            'age' => '26',
        ];

        $userInformations[] = [
            'user_id' => '3',
            'mobile' => '09123456789',
            'gender' => 'Male',
            'birthdate' => '1996-03-12',
            'address' => 'Silay City, Negros Occidental, Philippines',
            'age' => '24',
        ];

        UserInformation::insert($userInformations);
    }
}
