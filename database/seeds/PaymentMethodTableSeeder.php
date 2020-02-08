<?php

use App\PaymentMethod;
use Illuminate\Database\Seeder;

class PaymentMethodTableSeeder extends Seeder
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
            factory(PaymentMethod::class, 6500)->create();
        }

        $this->enableForeignKeys();

    }
}
