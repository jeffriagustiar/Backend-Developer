<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Product;
use Exception;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{
    public function add(Request $request){
        $a = Auth::user()->role;
        if ($a == 'admin') {

            $request->validate([
                'uuid' => ['required'],
                'name' => ['required'],
                'type' => ['required'],
                'price' => ['required'],
                'quantity' => ['required'],
            ]);

            Product::create([
                'uuid' => $request->uuid,
                'name' => $request->name,
                'type' => $request->type,
                'price' => $request->price,
                'quantity' => $request->quantity,
            ]);

            return 'berhasil di simpan';
            // return $a;
        }else{
            return ' error unauthorized';
        }
    }

    public function edit(Request $request){
        $a = Auth::user()->role;
        if ($a == 'admin') {
            $uuid = $request->input('uuid');

            

            if ($uuid) {
                try {
                    $dp = Product::where('uuid',$uuid);
                $dp->update([
                    'name' => $request->name,
                    'type' => $request->type,
                        'price' => $request->price,
                        'quantity' => $request->quantity,
                ]);
                return 'berhasil update data';
                } catch (Exception $e) {
                    return 'gagal update data';
                }
                
            }

        }else{
            return ' error unauthorized';
        }
    }

    public function delete(Request $request){
        $a = Auth::user()->role;
        if ($a == 'admin') {
            $uuid = $request->input('uuid');

            

            if ($uuid) {
                try {
                    $dp=Product::where('uuid',$uuid);
                    // ->destroy();
                $dp->delete();
                return 'berhasil hapus data';
                } catch (Exception $e) {
                    return 'gagal hapus data'.$e;
                }
                
            }

        }else{
            return ' error unauthorized';
        }
    }

    public function all(Request $request){

        $limit = $request->input('limit');
        $name = $request->input('name');
        $type = $request->input('type');
        $price = $request->input('price');
        $quantity = $request->input('quantity');

        if ($name) {
            $a=Product::orderBy('name', $name);
        }

        if ($type) {
            $a=Product::orderBy('type', $type);
        }
        if ($price) {
            $a=Product::orderBy('price', $price);
        }
        
        if ($quantity) {
            $a=Product::orderBy('price', $quantity);
        }





        return $a->paginate($limit);

    }
}
