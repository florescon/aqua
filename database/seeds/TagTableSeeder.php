<?php

use App\Tag;
use Illuminate\Database\Seeder;

class TagTableSeeder extends Seeder
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
            factory(Tag::class, 6500)->create();
        }

        $this->enableForeignKeys();

    }
}
