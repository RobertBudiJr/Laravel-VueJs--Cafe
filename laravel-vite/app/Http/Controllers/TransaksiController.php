<?php

namespace App\Http\Controllers;

use DateTime;
use App\Helpers\ApiResponse;
use App\Models\DetailTransaksi;
use App\Models\Meja;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use App\Policies\OrdersDetailPolicy;
use Dflydev\DotAccessData\Data;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $transaksi = Transaksi::get();
        return response()->json($transaksi);
    }

    public function show($id_transaksi){
        $transaksi_dt = Transaksi::findOrFail($id_transaksi);

        return response()->json([
            'success' => true,
            'message' => 'transaksi list',
            'data' => $transaksi_dt
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // Validation
        $validator = Validator::make($request->all(),[
            'id_user' => 'required|integer',
            'id_meja' => 'required|integer',
            'nama_pelanggan' => 'required|string',
            'status' => 'required|in:belum_bayar,lunas',
            'items' => 'required|array',
            'items.*.id_menu' => 'required|integer',
            'items.*.total_harga' => 'required|integer',
            'items.*.jumlah' => 'required|integer',
        ])->safe()->all();

        // if ($validator->fails()){
        //     return response()->json($validator->errors());
        // }

        // Check user available
        $user_check = User::where('id_user', $request->id_user)->first();
        if (!$user_check) return response()->json([
            'message' => 'User tidak tersedia'
        ]);

        // Check if User is Kasir
        $role = User::find($request->id_user);
        $role = $role->role;
        $check_role = ($role == 'kasir');

        if (!$check_role) return response()->json([
            'message' => 'User terpilih bukan kasir'
        ]);
        
        $meja_check = Meja::where('id_meja', $request->id_meja)->first();
        // Check meja available
        if (!$meja_check) return response()->json([
            'message' => 'Meja tidak tersedia'
        ]);

        // Check meja occupied
        $meja_status = Meja::find($request->id_meja);
        $meja_status = $meja_status->status_meja;

        if ($meja_status == 'terisi') return response()->json([
            'message' => 'Meja penuh'
        ]);


        // Query to Transaksis table
        $transaksi_input = Transaksi::create([
            'id_user' => $request->get('id_user'),
            'status_meja' => $request->get('status_meja'),
            'id_meja' => $request->get('id_meja'),
            'nama_pelanggan' => $request->get('nama_pelanggan'),
            'status' => $request->get('status'),
        ]);

        // Get Current Transaction Id
        $transaksi_id = Transaksi::latest('id_transaksi')->first();
        $id = $transaksi_id->id_transaksi;

        // Query to Detail Transaksi table
        // Loop by Item array count
        foreach ($validator['items'] as $item) {
            $detail_input = DetailTransaksi::create([
                'id_transaksi' => $id,
                'id_menu' => $item['id_menu'],
                'jumlah' => $item['jumlah'],
                'total_harga' => $item['total_harga'],            
            ]);
        }

        // Query to Update Status Meja to Occupied
        $currentIdMeja = $request->get('id_meja');
        $meja_update = Meja::where('id_meja', $currentIdMeja);

        if ($meja_update) {
            $meja_update->update([
                'status_meja' => 'terisi',
            ]);
        }

        // Success Message
        if ($transaksi_input && $detail_input && $meja_update){
            return response()->json([
                'success' => true,
                'message' => 'transaksi created',
                'data' => $transaksi_input, $detail_input, $meja_update
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'failed to create meja'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaksi  $transaksi
     * @param  \App\Models\Meja  $meja
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_transaksi)
    {
        $validator = Validator::make($request->all(),[
            'status' => 'required|in:belum_bayar,lunas',
            // 'status_meja' => 'in:kosong,terisi',
        ]);

        if ($validator->fails()){
            return response()->json($validator->errors(),400);
        }

        $update_transaksi = Transaksi::where('id_transaksi', $id_transaksi);

        if ($update_transaksi) {
            $update_transaksi->update([
                'status' => $request->status,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'status transaksi updated',
                'data' => $update_transaksi
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => 'failed to update transaksi'
        ]);
    }

     // filter data which paid off or not
     public function statusfilter(Request $request) {
        $status = $request->status;

        $results= [];

        $results = DB::table('transaksis')
        ->select('id_transaksi','tgl_transaksi', 'id_user', 'id_meja', 'nama_pelanggan', 'status')
        ->where("status", "$status")
        ->get();

        return response()->json(([
            'data' => $results
        ]));
    } 
}
