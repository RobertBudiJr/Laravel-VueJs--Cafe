<?php

namespace App\Http\Controllers;

use App\Models\Meja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MejaController extends Controller
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
        $meja = Meja::get();
        return response()->json($meja);
    }

    //show data
    public function show($id_meja){
        $meja_dt = Meja::findOrFail($id_meja);

        return response()->json([
            'success' => true,
            'message' => 'user list',
            'data' => $meja_dt
        ]);
    }

    //input data
    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'nomor_meja' => 'required',
            'status_meja' => 'required',
        ]);

        if ($validator->fails()){
            return response()->json($validator->errors(),400);
        }

        $meja_input = Meja::create([
            'nomor_meja' => $request->get('nomor_meja'),
            'status_meja' => $request->get('status_meja'),
        ]);

        if ($meja_input){
            return response()->json([
                'success' => true,
                'message' => 'meja created',
                'data' => $meja_input
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'failed to create meja'
        ]);
    }

    //update data
    public function update(Request $request, $id_meja)
    {
        $validator = Validator::make($request->all(), [
            'nomor_meja' => 'required',
            'status_meja' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $update_meja = Meja::where('id_meja', $id_meja);

        if ($update_meja) {
            $update_meja->update([
                'nomor_meja' => $request->nomor_meja,
                'status_meja' => $request->status_meja,
            ]);
            return response()->json([
                'success' => true,
                'message' => 'meja updated',
                'data' => $update_meja
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => 'failed to update meja'
        ]);
    }
    
    //delete data
    public function destroy($id_meja){
        $meja_delete = Meja::findOrfail($id_meja);

        if($meja_delete){
            $meja_delete->delete();

            return response()->json([
                'success' => true,
                'message' => 'meja deleted',
                'data' => $meja_delete
            ],200);
        }
        return response()->json([
            'success' => false,
            'message' => 'failed to delete meja'
        ],200);
    }
}
