<?php

namespace App\Http\Controllers\Landing;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    public function index()
    {
        $carts = Cart::with('product')
                ->latest()
                ->whereBelongsTo(Auth::user())->get();

        $grandQty = $carts->sum('quantity');

        return view('cart.index', compact('carts', 'grandQty'));
    }

    public function store(Request $request, Product $product)
    {
        $inCart = Cart::with('product')
                ->whereBelongsTo($request->user())
                ->where('product_id', $product->id)
                ->first();

        if($inCart)
        {
            return back()->with('toast_error', 'Produk Sudah Didalam Keranjang');
        }else{
            $request->user()->carts()->create([
                'product_id' => $product->id,
                'quantity' => 1
            ]);

            return redirect(route('cart.index'))->with('toast_success', 'Produk Ditambakan Dalam Keranjang');
        }
    }

    public function update(Request $request, Cart $cart)
    {
        $product = Product::whereId($cart->product_id)->first();

        if($product->quantity < $request->quantity)
        {
            return back()->with('toast_error', 'Stok Produk Kurang');
        }elseif($request->quantity <= 0){
            return back()->with('toast_error', 'Masukan Jumlah Produk');
        }else{
            $cart->update([
                'quantity' => $request->quantity
            ]);
            return back()->with('toast_success', 'Jumlah Produk Berhasil Diperbarui');
        }
    }

    public function delete(Cart $cart)
    {
        $cart->delete();
        return back()->with('toast_success', 'Produk Berhasil Dikeluarkan Dari Keranjang');
    }
}
