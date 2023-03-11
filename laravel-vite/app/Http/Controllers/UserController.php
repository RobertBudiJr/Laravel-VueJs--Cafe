<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth as FacadesJWTAuth;

class UserController extends Controller
{
    public function login(Request $request)
    {
        // I changed variable definition from $request->only('email', 'password') to $request->only('username', 'password')
        $credentials = $request->only('email', 'password');

        // variable below have the same results
        // $credentials = ['username' => $request->input('username'), 'password' => $request->input('password')];


        try {
            if(! $token = JWTAuth::attempt($credentials)) {
                // Keep getting this error
                return response()->json(['error' => 'invalid credentials'], 400);
            }
        }
        catch (JWTException $e) {
            return response()->json(['error' => 'could not create token'], 500);
        }

        // return response()->json(compact('token'));
        return  $this->createNewToken($token);
    }

    public function userProfile(){
        return response()->json(auth()->user());
    }

    protected function createNewToken($token){
        // dd(auth()->user()->role);
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => config('jwt.ttl'),
            'user' => auth()->user()
        ]);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_user' => 'required|string|max:255',
            'role' => 'required',
            'username' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $user = User::create([
            'nama_user' => $request->get('nama_user'),
            'role' => $request->get('role'),
            'username' => $request->get('username'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
        ]);

        $token = JWTAuth::fromUser($user);
        return response()->json(compact('user','token'),201);
    }

    public function getAuthenticatedUser()
    {
        try {
            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }
        } 
        catch (TokenExpiredException $e)
        {
            return response()->json(['token_expired'], 401);
        }
        catch (TokenInvalidException $e)
        {
            return response()->json(['token_invalid'], 401);
        }
        catch (JWTException $e)
        {
            return response()->json(['token_absent'], 400);
        }

        return response()->json(compact('user'));
    }
    
    public function show(){
        return response()->json([
            'data' => User::all()
        ]);
    }

    public function update(Request $request,$id){
        
        $request->validate([
            'nama_user' => 'required|string|max:255',
            'role' => 'required',
            'username' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',
        ]);

       

        User::where('id', $id)->update([
            'nama_user' => $request->nama_user,
            'role' => $request->role,
            'username' => $request->username,
            'email' => $request->email,
            'password' =>Hash::make( $request->password),
        ]);

        $data = User::find($id);

        return response([
            "data" => $data
        ]);
    }

    public function delete($id){
        User::where('id',$id)->delete();

        return response(["Data telah terhapus"]);
    }
}
