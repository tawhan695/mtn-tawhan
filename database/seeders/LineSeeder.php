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
        Linenotify::create([
            'token'=>'Ymif6VHZN2l490NS67P5Ej9l9by7Wl21mA88qM1ooYf',
            'branch_id'=> 1
        ]);
        Linenotify::create([
            'token'=>'d4wSLVQ1zUE4KHe68xcPgMZgRDwVhlYA4QmKAmwKEoT',
            'branch_id'=> 2
        ]);
        Linenotify::create([
            'token'=>'13MkuXBv9bP8asuZ5OsnklfpN2vGj1KfQnDZhrjskVn',
            'branch_id'=> 3
        ]);
    }
}
