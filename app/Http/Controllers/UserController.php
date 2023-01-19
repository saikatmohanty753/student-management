<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\College;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;

class UserController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:user-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $data = User::orderBy('id', 'ASC')->whereIn('role_id', [9, 10, 11, 12])->get();
        return view('users.index', compact('data'));
        // ->with('i', ($request->input('page', 1) - 1) * 5);
    }




    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function create()

    {

        $roles = Role::all();

        return view('users.create', compact('roles'));
    }



    /**

     * Store a newly created resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function store(Request $request)
    {

        $this->validate($request, [

            'name' => 'required',

            'email' => 'required|email|unique:users,email',

            'password' => 'required|same:confirm-password',

            'roles' => 'required'

        ]);



        $input = $request->all();
        $input['role_id'] = $request->roles;
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);

        $user->assignRole($request->input('roles'));
        return redirect()->route('users.index')

            ->with('success', 'User created successfully');
    }



    /**

     * Display the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function show($id)
    {

        $user = User::find($id);

        return view('users.show', compact('user'));
    }



    /**

     * Show the form for editing the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function edit($id)

    {

        $user = User::find($id);
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }



    /**

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function update(Request $request, $id)

    {


        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);
        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }
        $input['role_id'] = $request->roles;
        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();
        $user->assignRole($request->input('roles'));
        return redirect()->route('users.index')
            ->with('success', 'User updated successfully');
    }
    /**

     * Remove the specified resource from storage.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully');
    }
    public function college_view(Request $request)
    {
        $data = User::orderBy('role_id', 'asc')->orderBy('name', 'asc')->whereIn('role_id', [2, 5])->get();

        // foreach ($data as $key => $user) {
        //     DB::table('model_has_roles')->where('model_id', $user->id)->delete();
        //     $user->assignRole(2);
        // }

        return view('users.college_manage', compact('data'));
    }

    public function createClgUser($id)
    {

       $data = DB::table('users')
       ->select('users.*','colleges.name as clg_name','roles.name as role_name')

        ->leftJoin('colleges','users.clg_user_id', '=', 'colleges.id')
        ->where('clg_user_id', $id)
        ->leftJoin('roles','users.role_id','=','roles.id')
        ->get();

    //  $clguser = User::where('clg_user_id', $id)->get();

        $roles = Role::whereIn('id', [13, 14])->get();
        return view('colleges.create_user', compact('roles', 'id','data'));
    }

    public function storeClgUser(Request $request)
    {

        $this->validate($request, [

            'name' => 'required',

            'email' => 'required|email|unique:users,email',

            'mob_no' =>  'required',

            'password' => 'required|same:comfirm_password',

            'role' => 'required'

        ]);


        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mob_no = $request->mob_no;
        $user->role_id = $request->role;
        $user->clg_user_id = $request->college_id;
        $user->password = Hash::make($request['password']);
        $user->save();
        $user->assignRole($request->input('role'));
        return redirect()->back()->with('success', 'Student Added Successfully');
    }

    public function editClgUser(Request $request, $id)
    {
        $roles = Role::whereIn('id', [13, 14])->get();
        $user = User::find($id);
       return view('colleges.edit_user', compact('roles', 'user'));

    }
    public function updateClgUser(Request $request)
    {

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $request->hid,
            'password' => 'same:comfirm_password',
            'role' => 'required',
            'mob_no' =>  'required',

        ]);
    
        

        $user = User::find($request->hid);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mob_no = $request->mob_no;
        $user->role_id = $request->role;
        if (!empty($input['password'])) {
            $user->password = Hash::make($request['password']);

        }
        $user->save();
        $user->assignRole($request->input('role'));
        return redirect()->action([UserController::class, 'createClgUser'], ['id' => $user->clg_user_id])->with('success', 'User updated Successfully');

    }

    public function deleteClgUser($id)
    {


        $user = User::find($id);
        $clgId = $user->clg_user_id;
        $user->delete();
        return redirect()->action([UserController::class, 'createClgUser'], ['id' => $clgId]);
    }

}
