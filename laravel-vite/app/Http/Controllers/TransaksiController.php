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
            // 'tgl_transaksi' => 'required',
            'id_user' => 'required|integer',
            'id_meja' => 'required|integer',
            'nama_pelanggan' => 'required|string',
            'status' => 'required|in:belum_bayar,lunas',
            'id_menu' => 'required|integer',
            'jumlah' => 'required|integer',
            'total_harga' => 'required|integer',
        ]);

        if ($validator->fails()){
            return response()->json($validator->errors(),400);
        }

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

        // Check user available
        $user_check = User::where('id_user', $request->id_user)->first();
        if (!$user_check) return response()->json([
            'success' => false,
            'message' => 'User tidak tersedia'
        ]);

        // Query to Transaksis table
        $transaksi_input = Transaksi::create([
            // 'tgl_transaksi' => $request->get('tgl_transaksi'),
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
        $detail_input = DetailTransaksi::create([
            'id_transaksi' => $id,
            'id_menu' => $request->get('id_menu'),
            'jumlah' => $request->get('jumlah'),
            'total_harga' => $request->get('total_harga'),            
        ]);

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

        // // Goal = Get status meja
        // $select_transaksi = Transaksi::find($id_transaksi);
        // // Find meja
        // // Find column id_meja on Transaksi table
        // $select_meja = $select_transaksi->id_meja;
        // // Get current value of id_meja and search on Meja table
        // $find_meja = Meja::where('id_meja', $select_meja);
        // // Find column status_meja on Meja table based on id_meja
        // $status_meja = $find_meja->status_meja;

        if ($update_transaksi) {
            $update_transaksi->update([
                'status' => $request->status,
            ]);
            // if ($request->status == 'lunas') {
            //     $status_meja->update([
            //         'status_meja' => 'kosong'
            //     ]);
            // } else {
            //     $status_meja->update([
            //         'status_meja' => 'terisi'
            //     ]);
            // }

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
}
