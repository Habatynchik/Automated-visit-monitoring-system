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
        DB::table('faculty')->insert([
            'name' => 'Інформаційних технологій',
        ]);

        DB::table('department')->insert([
            'name' => 'Комп\'ютерних мереж і систем',
        ]);

        DB::table('groups')->insert(array(
            0 =>
                array(
                    'name' => "КІ18008бск",
                    'id_faculty' => 1,
                    'id_department' => 1
                ),
            1 =>
                array(
                    'name' => "КІ17008бск",
                    'id_faculty' => 1,
                    'id_department' => 1
                ),
        ));
    }
}
