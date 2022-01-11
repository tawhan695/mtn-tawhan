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
        $b->des = 'หจก.มัทนาไข่สด ฟาร์ม สำนักงานใหญ่
        (บ.หนองเม็ก อ.พรรณานิคม จ.สกลนคร )

        เปิดให้บริการทุกวัน
        เวลา 08.00 น. - 18.00 น.

        โทร.092-2931906 ,093-3682146';
        // $b->created_at ='สาขา 1';
        $b->save();

        $b2 = new Branchs;

        $b2->timestamps   = false;
        $b2->name = 'มัทนาไข่สด(สาขา2)';
        $b2->des = 'หจก.มัทนาไข่สด ฟาร์ม สาขา 2
        (บขส.ใหม่ สกลนคร อ.เมือง จ.สกลนคร)

        เปิดให้บริการทุกวัน
        เวลา 09.00 น. - 19.00 น.

        โทร.092-293-1906';
        // $b->created_at ='สาขา 1';
        $b2->save();

        $b = new Branchs;
        $b->timestamps   = false;
        $b->name = 'มัทนาไข่สด(สาขา3)';
        $b->des = 'หจก.มัทนาไข่สด ฟาร์ม สาขา 3
        (ตลาดสดท่าแร่  อ.เมือง จ.สกลนคร)

        เปิดให้บริการทุกวัน
        เวลา 06.00 น. - 18.00 น.

        โทร.092-2931906 ';
        // $b->created_at ='สาขา 1';
        $b->save();
        $b = new Branchs;
        $b->timestamps   = false;
        $b->name = 'มัทนาไข่สด(สาขา4)';
        $b->des = 'หจก.มัทนาไข่สด ฟาร์ม สาขา 4
        (ตลาดสดพังโคน อ.พังโคน จ.สกลนคร)

        เปิดให้บริการทุกวัน
        เวลา 03.00น. - 14.00 น.

        โทร.092-293-1906';
        // $b->created_at ='สาขา 1';
        $b->save();
        // $b->name = 'b2';
        // $b->des ='สาขา 2';
        // $b->save();

    }
}
