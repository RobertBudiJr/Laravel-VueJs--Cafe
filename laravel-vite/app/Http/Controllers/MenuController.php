<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MenuController extends Controller
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
        $menu = Menu::get();
        return response()->json($menu);
    }

    //show data
    public function show($id_menu){
        $menu_dt = Menu::findOrFail($id_menu);

        return response()->json([
            'success' => true,
            'message' => 'menu list',
            'data' => $menu_dt
        ]);
    }

    //input data
    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'nama_menu' => 'required',
            'jenis' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'required',
            'harga' => 'required',
        ]);

        if ($validator->fails()){
            return response()->json($validator->errors(),400);
        }

        $menu_input = Menu::create([
            'nama_menu' => $request->get('nama_menu'),
            'jenis' => $request->get('jenis'),
            'deskripsi' => $request->get('deskripsi'),
            'gambar' => $request->get('gambar'),
            'harga' => $request->get('harga'),
        ]);

        if ($menu_input){
            return response()->json([
                'success' => true,
                'message' => 'menu created',
                'data' => $menu_input
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'failed to create menu'
        ]);
    }

    //update data
    public function update(Request $request, $id_menu)
    {
        $validator = Validator::make($request->all(), [
            'nama_menu' => 'required',
            'jenis' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'required',
            'harga' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $update_menu = Menu::where('id_menu', $id_menu);

        if ($update_menu) {
            $update_menu->update([
                'nama_menu' => $request->nama_menu,
                'jenis' => $request->jenis,
                'deskripsi' => $request->deskripsi,
                'gambar' => $request->gambar,
                'harga' => $request->harga,
 
            ]);
            return response()->json([
                'success' => true,
                'message' => 'menu updated',
                'data' => $update_menu
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => 'failed to update menu'
        ]);
    }
    
    //delete data
    public function destroy($id_menu){
        $menu_delete = Menu::findOrfail($id_menu);

        if($menu_delete){
            $menu_delete->delete();

            return response()->json([
                'success' => true,
                'message' => 'menu deleted',
                'data' => $menu_delete
            ],200);
        }
        return response()->json([
            'success' => false,
            'message' => 'failed to delete menu'
        ],200);
    }
}
