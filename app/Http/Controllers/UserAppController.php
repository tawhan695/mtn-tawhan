<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Models\Branchs;
use App\Models\Has_Branchs;
use App\Models\Wallet;
class UserAppController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //หน้าที่
        // Role::create(['name' =>'super_admin']);
        // สร้าง user
        $user = \App\Models\User::factory()->create([
            'name' => 'พนักงานขาย',
            'username' => 'adminrmtn02',
            'email' => 'adminrmtn02@gmail.com',
            'password' => Hash::make('123456789'),

        ]);
        $user->assignRole('admin');
        // echo"super_admin";
        // สร้างสาขา
        // $b = new Branchs;
        // $b->timestamps   = false;
        // $b->name = 'Admin';
        // $b->des ='หจก.มัทนาไข่สด ฟาร์ม (แม่)';
        // // $b->created_at ='สาขา 1';
        // $b->save();

        //เพิ่มผุ้ใช้ ใส่สาขา
        $add_branch = new  Has_Branchs;
        $add_branch->timestamps   = false;
        $add_branch->user_id = $user->id;
        $add_branch->branchs_id = auth()->user()->branch_id();
        $add_branch->save();

        // เพิ่มกระเป๋า
        // $wallet = new Wallet;
        // $wallet->timestamps   = false;
        // $wallet->balance = 0;
        // $wallet->branch_id =3;
        // $wallet->save();
         echo"200 โอเค";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $imageName = time().'.'.$request->image->getClientOriginalExtension();
        $pathImage =  $request->image->move(public_path('images/profiles/'), $imageName);
        // print_r($pathImage);
        // print_r($imageName);
        print_r($id);


        // $user->image =
        User::where('id',$id)->update([
            'image'=>'images/profiles/'.$imageName,
            'name'=>$request->name
        ]);

        return redirect()->back();

        // print_r($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
