<?php

use App\ClassroomType;
use Illuminate\Database\Seeder;

class ClassroomTypeTableSeeder extends Seeder
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
            factory(ClassroomType::class, 1000)->create();
        }

        $this->enableForeignKeys();

    }
}
