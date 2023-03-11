<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DetailTransaksiController extends Controller
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
        $user = Detail_transaksi::get();
        return response()->json($user);
    }

    //show data
    public function show($id_detail_transaksi){
        $detail_transaksi_dt = Detail_transaksi::findOrFail($id_detail_transaksi);

        return response()->json([
            'success' => true,
            'message' => 'detail transaksi list',
            'data' => $detail_transaksi_dt
        ]);
    }

    //input data
    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'total_harga' => 'required',
        ]);

        if ($validator->fails()){
            return response()->json($validator->errors(),400);
        }

        $detail_transaksi_input = Detail_transaksi::create([
            'total_harga' => $request->get('total_harga'),

        ]);

        if ($detail_transaksi_input){
            return response()->json([
                'success' => true,
                'message' => 'detail transaksi created',
                'data' => $detail_transaksi_input
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'failed to create detail transaksi'
        ]);
    }

    //update data
    public function update(Request $request, $id_detail_transaksi)
    {
        $validator = Validator::make($request->all(), [
            'total_harga' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $update_detail_transaksi = Detail_transaksi::where('id_user', $id_detail_transaksi);

        if ($update_detail_transaksi) {
            $update_detail_transaksi->update([
                'total_harga' => $request->total_harga, 
            ]);
            return response()->json([
                'success' => true,
                'message' => 'user updated',
                'data' => $update_detail_transaksi
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => 'failed to update user'
        ]);
    }
    
    //delete data
    public function destroy($id_detail_transaksi){
        $detail_transaksi_delete = Detail_transaksi::findOrfail($id_detail_transaksi);

        if($detail_transaksi_delete){
            $detail_transaksi_delete->delete();

            return response()->json([
                'success' => true,
                'message' => 'user deleted',
                'data' => $detail_transaksi_delete
            ],200);
        }
        return response()->json([
            'success' => false,
            'message' => 'failed to delete user'
        ],200);
    }
}
