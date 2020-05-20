<?php

use Illuminate\Database\Seeder;

class PairsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pairs')->insert(array(
            0 =>
                array(
                    'id_user_student' => 1,
                    'id_schedule' => 1,
                    'arrive_time' => '17:00:00',
                    'date' => '2020-05-20'
                ),
            1 =>
                array(
                    'id_user_student' => 2,
                    'id_schedule' => 1,
                    'arrive_time' => '17:00:00',
                    'date' => '2020-05-20'
                ),
        ));
    }
}
