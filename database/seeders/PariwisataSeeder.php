<?php

namespace Database\Seeders;

use App\Models\Pariwisata;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PariwisataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pariwisata::truncate();

        $faker = Faker::create('id_ID');

        for ($i=0; $i < 5; $i++){
            Pariwisata::create([
                'foto' => $faker->image(storage_path('app/public/pariwisata'), 640, 360, null, false),
                'penjelasan' => $faker->sentence()
            ]);
        }

        Pariwisata::where('foto', '0')->delete();
    }
}
