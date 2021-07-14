<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Branchs;
class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $b = new Branchs;
        
        $b->timestamps   = false;
        $b->name = 'b2';
        $b->des ='สาขา 2';
        // $b->created_at ='สาขา 1';
        $b->save();
        // $b->name = 'b2';
        // $b->des ='สาขา 2';
        // $b->save();

    }
}
