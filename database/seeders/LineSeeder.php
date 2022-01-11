<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\models\Linenotify;
class LineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Linenotify::create([
            'token'=>'6p4fYcXoW14u8xxKKrMeBqdX2fK81g5qRF6THkpvtw3',
            'branch_id'=> 4
        ]);
    }
}
