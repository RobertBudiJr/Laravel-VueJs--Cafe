<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransaksiController extends Controller
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
        $transaksi = Transaksi::get();
        return response()->json($transaksi);
    }

    //show data
    public function show($id_transaksi){
        $transaksi_dt = Transaksi::findOrFail($id_transaksi);

        return response()->json([
            'success' => true,
            'message' => 'transaksi list',
            'data' => $transaksi_dt
        ]);
    }

    //input data
    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'tgl_transaksi' => 'required',
            'nama_pelanggan' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()){
            return response()->json($validator->errors(),400);
        }

        $transaksi_input = Transaksi::create([
            'tgl_transaksi' => $request->get('tgl_transaksi'),
            'nama_pelanggan' => $request->get('nama_pelanggan'),
            'status' => $request->get('status'),
        ]);

        if ($transaksi_input){
            return response()->json([
                'success' => true,
                'message' => 'transaksi created',
                'data' => $transaksi_input
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'failed to create transaksi'
        ]);
    }

    //update data
    public function update(Request $request, $id_transaksi)
    {
        $validator = Validator::make($request->all(), [
            'tgl_transaksi' => 'required',
            'nama_pelanggan' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $update_transaksi = Transaksi::where('id_transaksi', $id_transaksi);

        if ($update_transaksi) {
            $update_transaksi->update([
                'tgl_transaksi' => $request->tgl_transaksi,
                'nama_pelanggan' => $request->nama_pelanggan,
                'status' => $request->status, 
            ]);
            return response()->json([
                'success' => true,
                'message' => 'transaksi updated',
                'data' => $update_transaksi
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => 'failed to update transaksi'
        ]);
    }
    
    //delete data
    public function destroy($id_transaksi){
        $transaksi_delete = Transaksi::findOrfail($id_transaksi);

        if($transaksi_delete){
            $transaksi_delete->delete();

            return response()->json([
                'success' => true,
                'message' => 'transaksi deleted',
                'data' => $transaksi_delete
            ],200);
        }
        return response()->json([
            'success' => false,
            'message' => 'failed to delete transaksi'
        ],200);
    }
}
