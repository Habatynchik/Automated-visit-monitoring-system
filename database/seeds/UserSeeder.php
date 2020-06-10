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
                    'name' => 'Нікіта',
                    'surname' => 'Гамаюнов',
                    'second_name' => 'Дмитрович',
                    'birth_date' => '1998-05-12',
                    'type' => 4,
                    'email' => 'habatynchik@gmail.com',
                    'password' => Hash::make('password'),
                    'id_group' => 1
                ),
            1 =>
                array(
                    'name' => 'Сміян',
                    'surname' => 'Ілля',
                    'second_name' => 'Андрійович',
                    'birth_date' => '1998-05-12',
                    'type' => 4,
                    'email' => 'smiyan.ilya@gmail.com',
                    'password' => Hash::make('password'),
                    'id_group' => 1
                ),
            2 =>
                array(
                    'name' => 'Артем',
                    'surname' => 'Кривенко',
                    'second_name' => 'Ігорович',
                    'birth_date' => '1998-05-12',
                    'type' => 4,
                    'email' => 'tekillaartem@gmail.com',
                    'password' => Hash::make('password'),
                    'id_group' => 1
                ),
            3 =>
                array(
                    'name' => 'Інна',
                    'surname' => 'Приходько',
                    'second_name' => 'Олександрівна',
                    'birth_date' => '1998-05-12',
                    'type' => 4,
                    'email' => 'inna.loconte.san@gmail.com',
                    'password' => Hash::make('password'),
                    'id_group' => 1
                ),
            4 =>
                array(
                    'name' => 'Максим',
                    'surname' => 'Мусійчук',
                    'second_name' => 'Борисович',
                    'birth_date' => '1998-05-12',
                    'type' => 4,
                    'email' => 'musiichuk646@gmail.com',
                    'password' => Hash::make('password'),
                    'id_group' => 1
                ),
            5 =>
                array(
                    'name' => 'Олександр',
                    'surname' => 'Чорноус',
                    'second_name' => 'Богданович',
                    'birth_date' => '1998-05-12',
                    'type' => 4,
                    'email' => 'smile.lol007@gmail.com',
                    'password' => Hash::make('password'),
                    'id_group' => 1
                ),
            6 =>
                array(
                    'name' => 'Вадим',
                    'surname' => 'Хвост',
                    'second_name' => 'Володимирович',
                    'birth_date' => '1998-05-12',
                    'type' => 4,
                    'email' => 'khvost@gmail.com',
                    'password' => Hash::make('password'),
                    'id_group' => 2
                ),
            7 =>
                array(
                    'name' => 'Вікторія',
                    'surname' => 'Шрамко',
                    'second_name' => 'Ігорівна',
                    'birth_date' => '1998-05-12',
                    'type' => 4,
                    'email' => 'habatynchik@gmail.com',
                    'password' => Hash::make('password'),
                    'id_group' => 3
                ),
            8 =>
                array(
                    'name' => 'Євген',
                    'surname' => 'Гребініченко',
                    'second_name' => 'Тарасович',
                    'birth_date' => '1998-05-12',
                    'type' => 4,
                    'email' => 'kozzak2610@gmail.com',
                    'password' => Hash::make('password'),
                    'id_group' => 1
                ),
            9 =>
                array(
                    'name' => 'Єгор',
                    'surname' => 'Єгоров',
                    'second_name' => 'Олександрович',
                    'birth_date' => '1998-05-12',
                    'type' => 4,
                    'email' => 'egorov@gmail.com',
                    'password' => Hash::make('password'),
                    'id_group' => 3
                ),
            10 =>
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
