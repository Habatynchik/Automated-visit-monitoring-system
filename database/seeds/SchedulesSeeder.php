<?php

use Illuminate\Database\Seeder;

class SchedulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('schedules')->insert(array(

            0 =>
                array(
                    'id_disciplines' => 1,
                    'id_teacher' => 2,
                    'index_number' => 1,
                    'day' => 1,
                    'week' => 'top',
                    'id_group' => 1,
                    'id_type_of_discipline' => 15,
                    'id_classroom' => 1,
                )
        ));
    }
}
