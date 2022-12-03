<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('skills')->insert
        (
            [
                'name' => 'Adobe Premier Pro',
            ],
        );

        DB::table('skills')->insert
        (
            [
                'name' => 'Sony Vegas Pro',
            ],
        );

        DB::table('skills')->insert
        (
            [
                'name' => 'DaVinci Resolve',
            ],
        );

        DB::table('skills')->insert
        (
            [
                'name' => 'Figma',
            ],
        );

        DB::table('skills')->insert
        (
            [
                'name' => 'SMM',
            ],
        );

        DB::table('skills')->insert
        (
            [
                'name' => 'Графический дизайн',
            ],
        );
    }
}
