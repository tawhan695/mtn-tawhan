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
        $b->des ='หจก.มัทนาไข่สด ฟาร์ม (สำนักงานใหญ่) ที่อยู่ 260/8 บ.หนองเม็ก ต.นาหัวบ่อ อ.พรรณานิคม จ.สกลนคร 47220 เปิดให้บริการทุกวัน จันทร์ - อาทิตย์ เวลา 08.00 - 18.00 น.';
        // $b->created_at ='สาขา 1';
        $b->save();
        $b = new Branchs;

        $b->timestamps   = false;
        $b->name = 'มัทนาไข่สด(สาขา2)';
        $b->des ='หจก.มัทนาไข่สด ฟาร์ม (สาขา2) ';
        // $b->created_at ='สาขา 1';
        $b->save();
        $b->timestamps   = false;
        $b->name = 'มัทนาไข่สด(สาขา3)';
        $b->des ='หจก.มัทนาไข่สด ฟาร์ม (สาขา3) ';
        // $b->created_at ='สาขา 1';
        $b->save();
        $b->timestamps   = false;
        $b->name = 'มัทนาไข่สด(สาขา4)';
        $b->des ='หจก.มัทนาไข่สด ฟาร์ม (สาขา4) ';
        // $b->created_at ='สาขา 1';
        $b->save();
        // $b->name = 'b2';
        // $b->des ='สาขา 2';
        // $b->save();

    }
}
