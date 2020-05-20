<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);


        $this->call([
            SchedulesSeeder::class,
            ClassroomsSeeder::class,
            UserSeeder::class,
            PairsSeeder::class,
            Discipline_listSeeder::class,
            Schedule_of_disciplinesSeeder::class,
            GroupsSeeder::class,
        ]);
    }
}
