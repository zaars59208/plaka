<?php

namespace Modules\Plaka\Database\Seeds;

use App\Abstracts\Model;
use Illuminate\Database\Seeder;

class PlakaDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // $this->call("OthersTableSeeder");

        Model::reguard();
    }
}
