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
            // Kode di bawah tidak work, pinginku valuene id transaksi
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
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaksi $id_transaksi)
    {
        // Update hanya dapat dilakukan untuk mengubah status belum bayar menjadi lunas
        // Melakukan validasi input user pada bagian status
        $validateData = $request->validate([
            'status' => 'required|in:belum_bayar,lunas'
        ]);

        // Melakukan update record status
        $id_transaksi->status = $validateData['status'];
        $id_transaksi->save();

        // melakukan pengecekan jika status lunas maka meja kembali avaible untuk di pesan kembali
        if ($id_transaksi->status == "lunas") {
            $meja = Meja::where('id_meja', $id_transaksi->id_meja)->first();
            $meja->status = true;
            $meja->save();

            return response()->json([
                'success' => true,
                'message' => 'success update meja'
            ]);
        }
    }
}
