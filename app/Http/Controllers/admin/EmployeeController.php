<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Branchs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use App\Models\Has_Branchs;
use Auth;
class EmployeeController extends Controller
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
        $users = User::join('has__branchs', 'users.id', '=', 'has__branchs.user_id')
            ->where('has__branchs.branchs_id', auth()->user()->branch_id())
            ->get(['users.*', 'has__branchs.*']);

        $branchs = Branchs::where('id', auth()->user()->branch_id())->first();
        return view('admin.employee.index')->with(['employee' => $users,'branchs' => $branchs]);
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
        // post [uname] => adminmtn02 [name] => Admin MTN สาขา 2 [mail] => adminmtn02@gmail.com [_password] => 123456789 [tel] => 0655555555 )
        // print_r($request->all());
        // print('ประจำสาขา id :'.auth()->user()->branch_id());
        $password = Hash::make($request->password);
        $username = $request->username;
        $email = $request->email;
        $name = $request->name;
        $tel = $request->tel;
        $address = $request->address;
        $role = 'seller';
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'username' => ['required', 'string'],
            'address' => ['string','max:255'],
            'tel' => ['required', 'string', 'min:10','max:10'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
                ]);
        }else{
            //name``username``tel``email``address``image``password`
           $user = new User;
           $user->username =$username;
            $user->email =$email;
            $user->name =$name;
            $user->password =$password;
            $user->tel =$tel;
            $user->address = $address;
            $user->save();
            $credentials = $request->only('email', 'password');
            $remember = $request->remember;
            $user->assignRole($role);
            $add_branch = new  Has_Branchs;
            $add_branch->timestamps   = false;
            $add_branch->user_id = $user->id;
            $add_branch->branchs_id = auth()->user()->branch_id();
            $add_branch->save();
            auth()->attempt($credentials,true);
            // $token = login($user);

            // $this->respondWithToken($token);


        }
        return redirect(route('employee.index'));
        // print($password);
        // print($uname);
        // print($email);
        // print($tel);
        // print($name);


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
    public function update(Request $request, User $user)
    {
        //
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
