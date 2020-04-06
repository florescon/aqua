<?php

use App\School;
use Illuminate\Database\Seeder;

class SchoolTableSeeder extends Seeder
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

        if (app()->environment() !== 'production') {
            factory(School::class, 100)->create();
        }

        $this->enableForeignKeys();

    }
}
