<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;

class UserController extends Controller
{
    // /**
    //  * Create a new controller instance.
    //  *
    //  * @return void
    //  */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    
    // //get data
    // public function index(){
    //     $user = User::get();
    //     return response()->json($user);
    // }

    // //show data
    // public function show($id_user){
    //     $user_dt = User::findOrFail($id_user);

    //     return response()->json([
    //         'success' => true,
    //         'message' => 'user list',
    //         'data' => $user_dt
    //     ]);
    // }

    // //input data
    // public function store(Request $request){
    //     $validator = Validator::make($request->all(),[
    //         'nama_user' => 'required',
    //         // 'role' => 'required',
    //         'username' => 'required',
    //         'password' => 'required'

    //     ]);

    //     if ($validator->fails()){
    //         return response()->json($validator->errors(),400);
    //     }

    //     $user_input = User::create([
    //         'nama_user' => $request->get('nama_user'),
    //         // 'role' => $request->get('role'),
    //         'username' => $request->get('username'),
    //         'password' => $request->get('password')

    //     ]);

    //     if ($user_input){
    //         return response()->json([
    //             'success' => true,
    //             'message' => 'user created',
    //             'data' => $user_input
    //         ]);
    //     }

    //     return response()->json([
    //         'success' => false,
    //         'message' => 'failed to create user'
    //     ]);
    // }

    // //update data
    // public function update(Request $request, $id_user)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'nama_user' => 'required',
    //         // 'role' => 'required',
    //         'username' => 'required',
    //         'password' => 'required'
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json($validator->errors(), 400);
    //     }

    //     $update_user = User::where('id_user', $id_user);

    //     if ($update_user) {
    //         $update_user->update([
    //             'nama_user' => $request->nama_user,
    //             // 'role' => $request->role,
    //             'username' => $request->username,
    //             'password' => $request->password
 
    //         ]);
    //         return response()->json([
    //             'success' => true,
    //             'message' => 'user updated',
    //             'data' => $update_user
    //         ]);
    //     }
    //     return response()->json([
    //         'success' => false,
    //         'message' => 'failed to update user'
    //     ]);
    // }
    
    // //delete data
    // public function destroy($id_user){
    //     $user_delete = User::findOrfail($id_user);

    //     if($user_delete){
    //         $user_delete->delete();

    //         return response()->json([
    //             'success' => true,
    //             'message' => 'user deleted',
    //             'data' => $user_delete
    //         ],200);
    //     }
    //     return response()->json([
    //         'success' => false,
    //         'message' => 'failed to delete user'
    //     ],200);
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = User::orderBy('id_user');
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('nama_user','nama_user')->all();
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
            'nama_user' => 'required',
            // 'role' => 'required',
            'username' => 'required',
            'password' => 'required'
        ]);
    
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
    
        $user = User::create($input);
        $user->assignRole($request->input('roles'));
    
        // return redirect()->route('users.index')
        //                 ->with('success','User created successfully');
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
        // return view('users.show',compact('user'));
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
        $roles = Role::pluck('nama_user','nama_user')->all();
        $userRole = $user->roles->pluck('nama_user','nama_user')->all();
    
        // return view('users.edit',compact('user','roles','userRole'));
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
            'nama_user' => 'required',
            // 'role' => 'required',
            'username' => 'required',
            'password' => 'required'
        ]);
    
        $input = $request->all();
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));    
        }
    
        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();
    
        $user->assignRole($request->input('roles'));
    
        // return redirect()->route('users.index')
        //                 ->with('success','User updated successfully');
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
        // return redirect()->route('users.index')
        //                 ->with('success','User deleted successfully');
    }
}
