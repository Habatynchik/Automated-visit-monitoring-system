<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(array(
            0 =>
                array(
                    'name' => 'Nikita',
                    'surname' => 'Gamayunov',
                    'second_name' => 'Dmitrievich',
                    'birth_date' => '1998-05-12',
                    'type' => 4,
                    'email' => 'habatynchik@gmail.com',
                    'password' => Hash::make('password')
                ),
            1 =>
                array(
                    'name' => 'Vladislav',
                    'surname' => 'Redko',
                    'second_name' => 'Petrovich',
                    'birth_date' => '1999-02-15',
                    'type' => 0,
                    'email' => 'vredko@gmail.com',
                    'password' => Hash::make('password')
                )
        ));
    }
}
