<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use App\Models\Catagory;
use App\Models\Branchs;
use App\Models\Has_Branchs;
use Spatie\Permission\PermissionRegistrar;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       Role::create(['name' =>'admin']);
       Role::create(['name' =>'seller']);
       $user = \App\Models\User::factory()->create([
            'name' => 'หจก.มัทนาไข่สด ฟาร์ม',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456789'),
        ]);


        $user->assignRole('admin');
        // ประเภทไข่ไก่

        //

        $add_branch = new  Has_Branchs;
        $add_branch->timestamps   = false;
        $add_branch->user_id = $user->id;
        $add_branch->branchs_id = 1;
        $add_branch->save();

        $Catagory = Catagory::create([
             'name' => 'ไข่ไก่',
             'slug' => 'ไข่ไก่',
             'branch_id' => 1,
         ]);
        //  print_r( $Catagory->get()->id);
        $Catagory2 = Catagory::create([
             'name' => 'ทั่วไป',
             'slug' => 'ทั่วไป',
             'branch_id' => 1,
         ]);
        $Branchs = Branchs::create([
             'name' => 'สาขา 1',
             'des' => 'สาขา 1',
         ]);
        // $Branchs2 = Branchs::create([
        //      'name' => 'สาขา 2',
        //      'des' => 'สาขา 2',
        //  ]);
    // $user->;
    //    print_r($user);
     \App\Models\Product::factory(2)->create();
     DB::insert("INSERT INTO `products` (`id`, `name`, `slug`, `sku`, `des`, `unit`, `retail_price`, `wholesale_price`, `sale_price`, `qty`, `featured`, `retail`, `image`, `catagory_id`, `branch_id`, `created_at`, `updated_at`) VALUES (NULL, 'แผงกระดาษ','1628978951527', '1628978951527', 'แผงกระดาษ','แผง', '1.00', '1.00', '0.00', '0', '0', '1', 'images/products/1628978988.jpg', 2, 1, NULL, NULL)");
    }
}
