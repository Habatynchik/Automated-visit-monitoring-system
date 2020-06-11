<?php

use Illuminate\Database\Seeder;

class GroupsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('faculties')->insert([
            'name' => 'Інформаційних технологій',
        ]);

        DB::table('departments')->insert([
            'name' => 'Комп\'ютерних мереж і систем',
            'id_faculty' => 1
        ]);

        DB::table('groups')->insert(array(
            0 =>
                array(
                    'name' => "КІ18008бск",
                    'id_department' => 1
                ),
            1 =>
                array(
                    'name' => "КІ17007бск",
                    'id_department' => 1
                ),
            2 =>
                array(
                    'name' => "КІ16007б",
                    'id_department' => 1
                ),
        ));
    }
}
