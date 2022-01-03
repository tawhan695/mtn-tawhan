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
        $b->name = 'สำนักงานใหญ่';
        $b->des = 'หจก.มัทนาไข่สด ฟาร์ม';
        // $b->created_at ='สาขา 1';
        $b->save();

        $b2 = new Branchs;

        $b2->timestamps   = false;
        $b2->name = 'มัทนาไข่สด(สาขา2)';
        $b2->des = 'หจก.มัทนาไข่สด ฟาร์ม (สาขา2) ';
        // $b->created_at ='สาขา 1';
        $b2->save();

        $b = new Branchs;
        $b->timestamps   = false;
        $b->name = 'มัทนาไข่สด(สาขา3)';
        $b->des = 'หจก.มัทนาไข่สด ฟาร์ม (สาขา3) ';
        // $b->created_at ='สาขา 1';
        $b->save();
        $b = new Branchs;
        $b->timestamps   = false;
        $b->name = 'มัทนาไข่สด(สาขา4)';
        $b->des = 'หจก.มัทนาไข่สด ฟาร์ม (สาขา4) ';
        // $b->created_at ='สาขา 1';
        $b->save();
        // $b->name = 'b2';
        // $b->des ='สาขา 2';
        // $b->save();

    }
}
