<?php

use App\Regulation;
use Illuminate\Database\Seeder;

class RegulationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Regulation::create([
        	'title' => 'Titulo',
        	'body' 	=> '',
        ]);
    }
}

