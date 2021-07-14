<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Wallet;
use App\Models\Branchs;
class WalletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        // เพิ่ม ค่าดีฟอล ให้ทุกสาขา
        $branch = Branchs::all();
        foreach ($branch as $key => $value) {
            // echo $value->id.'/n';
            // column
            // id	balance	branch_id	created_at	updated_at	
            $wallet = new Wallet;
            $wallet->timestamps   = false;
            $wallet->balance = 0;
            $wallet->branch_id =$value->id;
            $wallet->save();
        }

    }
}
