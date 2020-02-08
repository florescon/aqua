<?php

use App\Blood;
use Illuminate\Database\Seeder;

class BloodTableSeeder extends Seeder
{

    use DisableForeignKeys;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeys();

        Blood::create([
        	'name' => 'A+'
        ]);

        Blood::create([
        	'name' => 'A-'
        ]);

        Blood::create([
        	'name' => 'AB+'
        ]);

        Blood::create([
        	'name' => 'AB-'
        ]);

        Blood::create([
        	'name' => 'B+'
        ]);

        Blood::create([
        	'name' => 'B-'
        ]);

        Blood::create([
        	'name' => 'O+'
        ]);

        Blood::create([
        	'name' => 'O-'
        ]);

        $this->enableForeignKeys();
    }
}
