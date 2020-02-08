<?php

use App\Section;
use Illuminate\Database\Seeder;

class SectionTableSeeder extends Seeder
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
            factory(Section::class, 6500)->create();
        }

        $this->enableForeignKeys();

    }
}
