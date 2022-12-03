<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecializationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('specializations')->insert
        (
            [
                'name' => 'Видео-монтаж',
            ],
        );

        DB::table('specializations')->insert
        (
            [
                'name' => 'Фитнес',
            ],
        );

        DB::table('specializations')->insert
        (
            [
                'name' => 'Фото',
            ],
        );

        DB::table('specializations')->insert
        (
            [
                'name' => 'PR',
            ],
        );

        DB::table('specializations')->insert
        (
            [
                'name' => 'Дизайн',
            ],
        );

        DB::table('specializations')->insert
        (
            [
                'name' => 'Юриспруденция',
            ],
        );
    }
}
