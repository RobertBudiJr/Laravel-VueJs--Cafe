<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
    
    //get data
    public function index(){
        $user = User::get();
        return response()->json($user);
    }

    //show data
    public function show($id_user){
        $user_dt = User::findOrFail($id_user);

        return response()->json([
            'success' => true,
            'message' => 'user list',
            'data' => $user_dt
        ]);
    }

    //input data
    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'nama_user' => 'required',
            'role' => 'required',
            'username' => 'required',
            'password' => 'required'

        ]);

        if ($validator->fails()){
            return response()->json($validator->errors(),400);
        }

        $user_input = User::create([
            'nama_user' => $request->get('nama_user'),
            'role' => $request->get('role'),
            'username' => $request->get('username'),
            'password' => $request->get('password')

        ]);

        if ($user_input){
            return response()->json([
                'success' => true,
                'message' => 'user created',
                'data' => $user_input
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'failed to create user'
        ]);
    }

    //update data
    public function update(Request $request, $id_user)
    {
        $validator = Validator::make($request->all(), [
            'nama_user' => 'required',
            'role' => 'required',
            'username' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $update_user = User::where('id_user', $id_user);

        if ($update_user) {
            $update_user->update([
                'nama_user' => $request->nama_user,
                'role' => $request->role,
                'username' => $request->username,
                'password' => $request->password
 
            ]);
            return response()->json([
                'success' => true,
                'message' => 'user updated',
                'data' => $update_user
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => 'failed to update user'
        ]);
    }
    
    //delete data
    public function destroy($id_user){
        $user_delete = User::findOrfail($id_user);

        if($user_delete){
            $user_delete->delete();

            return response()->json([
                'success' => true,
                'message' => 'user deleted',
                'data' => $user_delete
            ],200);
        }
        return response()->json([
            'success' => false,
            'message' => 'failed to delete user'
        ],200);
    }
}
