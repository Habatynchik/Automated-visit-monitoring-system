<?php

use Illuminate\Database\Seeder;

class ClassroomsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('classrooms')->insert(array(
            0 =>
                array(
                    'room_number' => 223,
                    'building_number' => 15
                ),
            1 =>
                array(
                    'room_number' => 224,
                    'building_number' => 15
                )
        ));
    }
}
