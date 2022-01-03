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
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'manager']);
        Role::create(['name' => 'seller']);

        $user = \App\Models\User::factory()->create([
            'name' => 'หจก.มัทนาไข่สด ฟาร์ม',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456789'),
        ]);

        $user->assignRole('admin');

        $add_branch = new  Has_Branchs;
        $add_branch->timestamps   = false;
        $add_branch->user_id = $user->id;
        $add_branch->branchs_id = 1;
        $add_branch->save();

        // สาขา1
        $user01 = \App\Models\User::factory()->create([
            'name' => ' manager มัทนาไข่สด ฟาร์ม',
            'username' => 'managermtn',
            'email' => 'managermtn@gmail.com',
            'password' => Hash::make('123456789'),
        ]);
        $add_branch = new  Has_Branchs;
        $add_branch->timestamps   = false;
        $add_branch->user_id = $user01->id;
        $add_branch->branchs_id = 1;
        $add_branch->save();
        $user01->assignRole('manager');

        $user2 = \App\Models\User::factory()->create([
            'name' => ' manager มัทนาไข่สด ฟาร์ม',
            'username' => 'cashiermtn',
            'email' => 'cashiermtn@gmail.com',
            'password' => Hash::make('123456789'),
        ]);
        $add_branch = new  Has_Branchs;
        $add_branch->timestamps   = false;
        $add_branch->user_id = $user2->id;
        $add_branch->branchs_id = 1;
        $add_branch->save();
        $user2->assignRole('seller');
        // สาขา2
        $user01 = \App\Models\User::factory()->create([
            'name' => ' manager มัทนาไข่สด ฟาร์ม',
            'username' => 'managermtn02',
            'email' => 'managermtn02@gmail.com',
            'password' => Hash::make('123456789'),
        ]);
        $add_branch = new  Has_Branchs;
        $add_branch->timestamps   = false;
        $add_branch->user_id = $user01->id;
        $add_branch->branchs_id = 2;
        $add_branch->save();
        $user01->assignRole('manager');

        $user2 = \App\Models\User::factory()->create([
            'name' => ' manager มัทนาไข่สด ฟาร์ม',
            'username' => 'cashiermtn02',
            'email' => 'cashiermtn02@gmail.com',
            'password' => Hash::make('123456789'),
        ]);
        $add_branch = new  Has_Branchs;
        $add_branch->timestamps   = false;
        $add_branch->user_id = $user2->id;
        $add_branch->branchs_id = 2;
        $add_branch->save();
        $user2->assignRole('seller');

        // สาขา3
        $user01 = \App\Models\User::factory()->create([
            'name' => ' manager มัทนาไข่สด ฟาร์ม',
            'username' => 'managermtn03',
            'email' => 'managermtn03@gmail.com',
            'password' => Hash::make('123456789'),
        ]);
        $add_branch = new  Has_Branchs;
        $add_branch->timestamps   = false;
        $add_branch->user_id = $user01->id;
        $add_branch->branchs_id = 3;
        $add_branch->save();
        $user01->assignRole('manager');

        $user2 = \App\Models\User::factory()->create([
            'name' => ' manager มัทนาไข่สด ฟาร์ม',
            'username' => 'cashiermtn03',
            'email' => 'cashiermtn03@gmail.com',
            'password' => Hash::make('123456789'),
        ]);
        $add_branch = new  Has_Branchs;
        $add_branch->timestamps   = false;
        $add_branch->user_id = $user2->id;
        $add_branch->branchs_id = 3;
        $add_branch->save();
        $user2->assignRole('seller');
   // สาขา4
   $user01 = \App\Models\User::factory()->create([
    'name' => ' manager มัทนาไข่สด ฟาร์ม',
    'username' => 'managermtn04',
    'email' => 'managermtn04@gmail.com',
    'password' => Hash::make('123456789'),
]);
$add_branch = new  Has_Branchs;
$add_branch->timestamps   = false;
$add_branch->user_id = $user01->id;
$add_branch->branchs_id = 4;
$add_branch->save();
$user01->assignRole('manager');

$user2 = \App\Models\User::factory()->create([
    'name' => ' manager มัทนาไข่สด ฟาร์ม',
    'username' => 'cashiermtn04',
    'email' => 'cashiermtn04@gmail.com',
    'password' => Hash::make('123456789'),
]);
$add_branch = new  Has_Branchs;
$add_branch->timestamps   = false;
$add_branch->user_id = $user2->id;
$add_branch->branchs_id = 4;
$add_branch->save();
$user2->assignRole('seller');

        $Catagory = Catagory::create([
            'name' => 'ไข่ไก่',
            'slug' => 'ไข่ไก่',
            'branch_id' => 1,
        ]);
        //  print_r( $Catagory->get()->id);
        $Catagory2 = Catagory::create([
            'name' => 'แผงไข่',
            'slug' => 'แผงไข่',
            'branch_id' => 1,
        ]);
        Catagory::create([
            'name' => 'อาหารแปรรูป',
            'slug' => 'อาหารแปรรูป',
            'branch_id' => 1,
        ]);
        Catagory::create([
            'name' => 'เครื่องดื่ม',
            'slug' => 'เครื่องดื่ม',
            'branch_id' => 1,
        ]);
        Catagory::create([
            'name' => 'ไข่อื่นๆ',
            'slug' => 'ไข่อื่นๆ',
            'branch_id' => 1,
        ]);
        // $Branchs = Branchs::create([
        //      'name' => 'สาขา 1',
        //      'des' => 'สาขา 1',
        //  ]);
        //สาขา1
        $Catagory = Catagory::create([
            'name' => 'ไข่ไก่',
            'slug' => 'ไข่ไก่',
            'branch_id' => 2,
        ]);
        //  print_r( $Catagory->get()->id);
        $Catagory2 = Catagory::create([
            'name' => 'แผงไข่',
            'slug' => 'แผงไข่',
            'branch_id' => 2,
        ]);
        Catagory::create([
            'name' => 'อาหารแปรรูป',
            'slug' => 'อาหารแปรรูป',
            'branch_id' => 2,
        ]);
        Catagory::create([
            'name' => 'เครื่องดื่ม',
            'slug' => 'เครื่องดื่ม',
            'branch_id' => 2,
        ]);
        Catagory::create([
            'name' => 'ไข่อื่นๆ',
            'slug' => 'ไข่อื่นๆ',
            'branch_id' => 2,
        ]);
        $Catagory = Catagory::create([
            'name' => 'ไข่ไก่',
            'slug' => 'ไข่ไก่',
            'branch_id' => 3,
        ]);
        //  print_r( $Catagory->get()->id);
        $Catagory2 = Catagory::create([
            'name' => 'แผงไข่',
            'slug' => 'แผงไข่',
            'branch_id' => 3,
        ]);
        Catagory::create([
            'name' => 'อาหารแปรรูป',
            'slug' => 'อาหารแปรรูป',
            'branch_id' => 3,
        ]);
        Catagory::create([
            'name' => 'เครื่องดื่ม',
            'slug' => 'เครื่องดื่ม',
            'branch_id' => 3,
        ]);
        Catagory::create([
            'name' => 'ไข่อื่นๆ',
            'slug' => 'ไข่อื่นๆ',
            'branch_id' => 3,
        ]);
         Catagory::create([
            'name' => 'ไข่ไก่',
            'slug' => 'ไข่ไก่',
            'branch_id' => 4,
        ]);
        Catagory::create([
            'name' => 'แผงไข่',
            'slug' => 'แผงไข่',
            'branch_id' => 4,
        ]);
        Catagory::create([
            'name' => 'อาหารแปรรูป',
            'slug' => 'อาหารแปรรูป',
            'branch_id' => 4,
        ]);
        Catagory::create([
            'name' => 'เครื่องดื่ม',
            'slug' => 'เครื่องดื่ม',
            'branch_id' => 4,
        ]);
        Catagory::create([
            'name' => 'ไข่อื่นๆ',
            'slug' => 'ไข่อื่นๆ',
            'branch_id' => 4,
        ]);

        // $user->;
        //    print_r($user);
        // -- (NULL, 'ทั่วไป', 'ทั่วไป', 1, '2021-08-14 08:23:31', '2021-08-14 08:23:31'),
        //  \App\Models\Product::factory(2)->create();
        // DB::insert("INSERT INTO `catagories` (`id`, `name`, `slug`, `branch_id`, `created_at`, `updated_at`) VALUES
        // (NULL, 'ไข่ไก่', 'ไข่ไก่', 1, NOW(), NOW()),
        // (NULL, 'แผงไข่', 'แผงไข่', 1, '2021-08-23 04:08:15', '2021-08-23 04:08:15'),
        // (NULL, 'อาหารแปรรูป', 'อาหารแปรรูป', 1, '2021-08-23 07:43:13', '2021-08-23 07:43:13'),
        // (NULL, 'เครื่องดื่ม', 'เครื่องดื่ม', 1, '2021-08-23 07:43:27', '2021-08-23 07:43:27'),
        // (NULL, 'ไข่อื่นๆ', 'ไข่อื่นๆ', 1, '2021-08-23 07:48:02', '2021-08-23 07:48:02');");

        //  DB::insert(
        //      "INSERT INTO `products` (`id`, `name`, `slug`, `sku`, `des`, `unit`, `retail_price`, `wholesale_price`, `sale_price`, `qty`, `featured`, `retail`, `image`, `catagory_id`, `branch_id`, `created_at`, `updated_at`) VALUES
        //      (NULL, 'ไข่ไก่ No.0', '2265452', '251182', 'ไข่ไก่ มัทนาฟาร์ม', 'แผง', 72.00, 98.00, 0.00, 0, 0, 1, 'images/products/1629691656.png', 1, 1, '2021-08-14 08:23:31', '2021-08-23 04:17:01'),
        //      (NULL, 'ไข่ไก่ No.1', 'no11629691723657', '1629691723657', 'ไข่ไก่', 'แผง', 90.00, 85.00, 0.00, 0, 0, 1, 'images/products/1629691794.png', 1, 1, '2021-08-23 04:09:54', '2021-08-23 04:17:01'),
        //      (NULL, 'ไข่ไก่ No.2', 'no21629691836967', '1629691836967', 'ไข่ไก่', 'แผง', 85.00, 80.00, 0.00, 0, 0, 1, 'images/products/1629691865.png', 1, 1, '2021-08-23 04:11:05', '2021-08-23 04:17:01'),
        //      (NULL, 'ไข่ไก่ No.3', 'no31629691896083', '1629691896083', 'ไข่ไก่', 'แผง', 80.00, 75.00, 0.00, 0, 0, 1, 'images/products/1629691931.png', 1, 1, '2021-08-23 04:12:11', '2021-08-23 04:17:01'),
        //      (NULL, 'ไข่ไก่ No.4', 'no41629691964871', '1629691964871', 'ไข่ไก่', 'แผง', 78.00, 70.00, 0.00, 0, 0, 1, 'images/products/1629691988.png', 1, 1, '2021-08-23 04:13:08', '2021-08-23 04:17:01'),
        //      (NULL, 'ไข่ไก่ No.5', 'no51629692010663', '1629692010663', 'ไข่ไก่', 'แผง', 70.00, 65.00, 0.00, 0, 0, 1, 'images/products/1629692033.png', 1, 1, '2021-08-23 04:13:53', '2021-08-23 04:17:01'),
        //      (NULL, 'แผงพลาสติก', '1629692062240', '1629692062240', 'แผงไข่ไก่', 'ชิ้น', 7.00, 7.00, 0.00, 0, 0, 1, 'images/products/1629692099.png', 2, 1, '2021-08-23 04:14:59', '2021-08-23 04:17:01'),
        //      (NULL, 'แผงกระดาษ', '1629692116105', '1629692116105', 'แผงไข่', 'ชิ้น', 1.00, 1.00, 0.00, 0, 0, 1, 'images/products/1629692140.png', 2, 1, '2021-08-23 04:15:40', '2021-08-23 04:17:01'),
        //      (NULL, 'ไข่เยี่ยวม้า (ฟอง)', '1-1629704751899', '1629704751899', 'ไข่เยียวม้า ขายแบบฟอง', 'ฟอง', 6.00, 6.00, 0.00, 0, 0, 1, 'images/products/1629704860.png', 5, 1, '2021-08-23 07:47:40', '2021-08-23 07:50:35'),
        //      (NULL, 'ไข่เยี่ยวม้า (ลัง)', '1-1629704931847', '1629704931847', 'ไข่เยี่ยวม้าแบบลัง', 'ลัง', 270.00, 270.00, 0.00, 0, 0, 1, 'images/products/1629710801.png', 5, 1, '2021-08-23 07:49:40', '2021-08-23 09:26:41'),
        //      (NULL, 'ไข่เค็ม (ฟอง)', '1629705069061', '1629705069061', 'ไข่เค็มแบบฟอง', 'ฟอง', 6.00, 6.00, 0.00, 0, 0, 1, 'images/products/1629705092.png', 5, 1, '2021-08-23 07:51:32', '2021-08-23 07:51:32'),
        //      (NULL, 'ไข่เค็ม (ลัง)', '1629705126663', '1629705126663', 'ไข่แบบลัง', 'ลัง', 270.00, 270.00, 0.00, 0, 0, 1, 'images/products/1629710747.png', 5, 1, '2021-08-23 07:52:36', '2021-08-23 09:25:47'),
        //      (NULL, 'ไข่ซีด', '1629705189325', '1629705189325', 'ไข่ซีด', 'แผง', 100.00, 100.00, 0.00, 0, 0, 1, 'images/products/1629705235.png', 5, 1, '2021-08-23 07:53:55', '2021-08-23 07:53:55'),
        //      (NULL, 'ไข่บุป', '1629705254094', '1629705254094', 'ไข่บุปแบบแผง', 'แผง', 80.00, 80.00, 0.00, 0, 0, 1, 'images/products/1629705280.png', 5, 1, '2021-08-23 07:54:40', '2021-08-23 07:54:40'),
        //      (NULL, 'ปลากระป๋องตราทะเลไทย (ป๋อง)', '1629705375532', '1629705375532', 'ปลากระป๋อง ตราทะเลยไทย แบบป๋อง', 'ป๋อง', 10.00, 10.00, 0.00, 0, 0, 1, 'images/products/1629705446.png', 3, 1, '2021-08-23 07:57:26', '2021-08-23 07:57:26'),
        //      (NULL, 'ปลากระป๋องตราทะเลไทย (ลัง)', '1629705484991', '1629705484991', 'แบบลัง', 'ลัง', 800.00, 800.00, 0.00, 0, 0, 1, 'images/products/1629705504.png', 3, 1, '2021-08-23 07:58:24', '2021-08-23 09:07:15'),
        //      (NULL, 'ปลากระป๋องตราทะเลไทย (แพ็ค)', '1629709351064', '1629709351064', 'กระป๋องแพ็ค', 'แพ็ค', 100.00, 100.00, 0.00, 0, 0, 1, 'images/products/1629709574.png', 3, 1, '2021-08-23 09:06:14', '2021-08-23 09:06:14'),
        //      (NULL, 'น้ำมันปาล์ม ตราเพลิน', '1629710192619', '1629710192619', 'น้ำมันปาล์ม ตราเพลิน \r\nขวดละ 45 บาท / ลังละ 520 บาท', 'ขวด', 45.00, 45.00, 0.00, 0, 0, 1, 'images/products/1629710280.png', 3, 1, '2021-08-23 09:18:00', '2021-08-23 09:18:00'),
        //      (NULL, 'น้ำมันปาล์ม ตราเพลิน(ลัง)', '1629710326000', '1629710326000', 'น้ำมันปาล์ม ตราเพลิน \r\nขวดละ 45 บาท / ลังละ 520 บาท', 'ลัง', 520.00, 520.00, 0.00, 0, 0, 1, 'images/products/1629710374.png', 3, 1, '2021-08-23 09:19:34', '2021-08-23 09:19:34'),
        //      (NULL, 'น้ำดื่ม', '1629710446283', '1629710446283', 'น้ำดื่ม \r\nแพ๊คละ 35 บาท / 3 แพ๊ค ราคา 100 บาท', 'แพ็ค', 35.00, 35.00, 0.00, 0, 0, 1, 'images/products/1629710553.png', 4, 1, '2021-08-23 09:22:33', '2021-08-23 09:22:33');"
        //  );
        //  DB::insert(
        //      "INSERT INTO `products` (`id`, `name`, `slug`, `sku`, `des`, `unit`, `retail_price`, `wholesale_price`, `sale_price`, `qty`, `featured`, `retail`, `image`, `catagory_id`, `branch_id`, `created_at`, `updated_at`) VALUES
        //      (NULL, 'ไข่ไก่ No.0', '22654521', '2511821', 'ไข่ไก่ มัทนาฟาร์ม', 'แผง', 72.00, 98.00, 0.00, 0, 0, 1, 'images/products/1629691656.png', 6, 2, '2021-08-14 08:23:31', '2021-08-23 04:17:01'),
        //      (NULL, 'ไข่ไก่ No.1', 'no116296917236571', '16296917236571', 'ไข่ไก่', 'แผง', 90.00, 85.00, 0.00, 0, 0, 1, 'images/products/1629691794.png', 6, 2, '2021-08-23 04:09:54', '2021-08-23 04:17:01'),
        //      (NULL, 'ไข่ไก่ No.2', 'no216296918369671', '16296918369671', 'ไข่ไก่', 'แผง', 85.00, 80.00, 0.00, 0, 0, 1, 'images/products/1629691865.png', 6, 2, '2021-08-23 04:11:05', '2021-08-23 04:17:01'),
        //      (NULL, 'ไข่ไก่ No.3', 'no31629691896083', '1629691896083', 'ไข่ไก่', 'แผง', 80.00, 75.00, 0.00, 0, 0, 1, 'images/products/1629691931.png', 6, 2, '2021-08-23 04:12:11', '2021-08-23 04:17:01'),
        //      (NULL, 'น้ำดื่ม', '1629710446283', '1629710446283', 'น้ำดื่ม \r\nแพ๊คละ 35 บาท / 3 แพ๊ค ราคา 100 บาท', 'แพ็ค', 35.00, 35.00, 0.00, 0, 0, 1, 'images/products/1629710553.png', 9, 2, '2021-08-23 09:22:33', '2021-08-23 09:22:33');"
        //  );
    }
}

// --  (NULL, 'ไข่ไก่ No.4', 'no41629691964871', '1629691964871', 'ไข่ไก่', 'แผง', 78.00, 70.00, 0.00, 0, 0, 1, 'images/products/1629691988.png', 1, 2, '2021-08-23 04:13:08', '2021-08-23 04:17:01'),
// --  (NULL, 'ไข่ไก่ No.5', 'no51629692010663', '1629692010663', 'ไข่ไก่', 'แผง', 70.00, 65.00, 0.00, 0, 0, 1, 'images/products/1629692033.png', 1, 2, '2021-08-23 04:13:53', '2021-08-23 04:17:01'),
// --  (NULL, 'แผงพลาสติก', '1629692062240', '1629692062240', 'แผงไข่ไก่', 'ชิ้น', 7.00, 7.00, 0.00, 0, 0, 1, 'images/products/1629692099.png', 2, 2, '2021-08-23 04:14:59', '2021-08-23 04:17:01'),
// --  (NULL, 'แผงกระดาษ', '1629692116105', '1629692116105', 'แผงไข่', 'ชิ้น', 1.00, 1.00, 0.00, 0, 0, 1, 'images/products/1629692140.png', 2, 2, '2021-08-23 04:15:40', '2021-08-23 04:17:01'),
// --  (NULL, 'ไข่เยี่ยวม้า (ฟอง)', '1-1629704751899', '1629704751899', 'ไข่เยียวม้า ขายแบบฟอง', 'ฟอง', 6.00, 6.00, 0.00, 0, 0, 1, 'images/products/1629704860.png', 5, 2, '2021-08-23 07:47:40', '2021-08-23 07:50:35'),
// --  (NULL, 'ไข่เยี่ยวม้า (ลัง)', '1-1629704931847', '1629704931847', 'ไข่เยี่ยวม้าแบบลัง', 'ลัง', 270.00, 270.00, 0.00, 0, 0, 1, 'images/products/1629710801.png', 5, 2, '2021-08-23 07:49:40', '2021-08-23 09:26:41'),
// --  (NULL, 'ไข่เค็ม (ฟอง)', '1629705069061', '1629705069061', 'ไข่เค็มแบบฟอง', 'ฟอง', 6.00, 6.00, 0.00, 0, 0, 1, 'images/products/1629705092.png', 5, 2, '2021-08-23 07:51:32', '2021-08-23 07:51:32'),
// --  (NULL, 'ไข่เค็ม (ลัง)', '1629705126663', '1629705126663', 'ไข่แบบลัง', 'ลัง', 270.00, 270.00, 0.00, 0, 0, 1, 'images/products/1629710747.png', 5, 2, '2021-08-23 07:52:36', '2021-08-23 09:25:47'),
// --  (NULL, 'ไข่ซีด', '1629705189325', '1629705189325', 'ไข่ซีด', 'แผง', 100.00, 100.00, 0.00, 0, 0, 1, 'images/products/1629705235.png', 5, 2, '2021-08-23 07:53:55', '2021-08-23 07:53:55'),
// --  (NULL, 'ไข่บุป', '1629705254094', '1629705254094', 'ไข่บุปแบบแผง', 'แผง', 80.00, 80.00, 0.00, 0, 0, 1, 'images/products/1629705280.png', 5, 2, '2021-08-23 07:54:40', '2021-08-23 07:54:40'),
// --  (NULL, 'ปลากระป๋องตราทะเลไทย (ป๋อง)', '1629705375532', '1629705375532', 'ปลากระป๋อง ตราทะเลยไทย แบบป๋อง', 'ป๋อง', 10.00, 10.00, 0.00, 0, 0, 1, 'images/products/1629705446.png', 3, 2, '2021-08-23 07:57:26', '2021-08-23 07:57:26'),
// --  (NULL, 'ปลากระป๋องตราทะเลไทย (ลัง)', '1629705484991', '1629705484991', 'แบบลัง', 'ลัง', 800.00, 800.00, 0.00, 0, 0, 1, 'images/products/1629705504.png', 3, 2, '2021-08-23 07:58:24', '2021-08-23 09:07:15'),
// --  (NULL, 'ปลากระป๋องตราทะเลไทย (แพ็ค)', '1629709351064', '1629709351064', 'กระป๋องแพ็ค', 'แพ็ค', 100.00, 100.00, 0.00, 0, 0, 1, 'images/products/1629709574.png', 3, 2, '2021-08-23 09:06:14', '2021-08-23 09:06:14'),
// --  (NULL, 'น้ำมันปาล์ม ตราเพลิน', '1629710192619', '1629710192619', 'น้ำมันปาล์ม ตราเพลิน \r\nขวดละ 45 บาท / ลังละ 520 บาท', 'ขวด', 45.00, 45.00, 0.00, 0, 0, 1, 'images/products/1629710280.png', 3, 2, '2021-08-23 09:18:00', '2021-08-23 09:18:00'),
// --  (NULL, 'น้ำมันปาล์ม ตราเพลิน(ลัง)', '1629710326000', '1629710326000', 'น้ำมันปาล์ม ตราเพลิน \r\nขวดละ 45 บาท / ลังละ 520 บาท', 'ลัง', 520.00, 520.00, 0.00, 0, 0, 1, 'images/products/1629710374.png', 3, 2, '2021-08-23 09:19:34', '2021-08-23 09:19:34'),
