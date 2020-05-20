<?php

use Illuminate\Database\Seeder;

class Schedule_of_disciplinesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('schedule_of_disciplines')->insert(array(
            0 =>
                array(
                    'number' => 1,
                    'start_time' => '08:30:00',
                    'end_time' => '09:50:00'
                ),
            1 =>
                array(
                    'number' => 2,
                    'start_time' => '10:05:00',
                    'end_time' => '11:25:00'
                ),
            2 =>
                array(
                    'number' => 3,
                    'start_time' => '11:40:00',
                    'end_time' => '13:00:00'
                ),
            3 =>
                array(
                    'number' => 4,
                    'start_time' => '13:15:00',
                    'end_time' => '14:35:00'
                ),
            4 =>
                array(
                    'number' => 5,
                    'start_time' => '14:50:00',
                    'end_time' => '16:10:00'
                ),
            5 =>
                array(
                    'number' => 6,
                    'start_time' => '16:25:00',
                    'end_time' => '17:45:00'
                ),
            6 =>
                array(
                    'number' => 7,
                    'start_time' => '18:00:00',
                    'end_time' => '19:20:00'
                ),
            7 =>
                array(
                    'number' => 8,
                    'start_time' => '19:35:00',
                    'end_time' => '20:55:00'
                ),
        ));
    }
}
