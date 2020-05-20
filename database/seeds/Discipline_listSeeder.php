<?php

use Illuminate\Database\Seeder;

class Discipline_listSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('discipline_lists')->insert(array(
            0 =>
                array(
                    'name' => 'Математика'
                ),
            1 =>
                array(
                    'name' => 'ООП'
                ),
            2 =>
                array(
                    'name' => 'Системний аналіз'
                ),
            3 =>
                array(
                    'name' => 'Комп\'ютерні мережі'
                )
        ));
    }
}
