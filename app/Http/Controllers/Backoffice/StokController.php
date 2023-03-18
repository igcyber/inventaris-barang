<?php

namespace App\Http\Controllers\Backoffice;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StokController extends Controller
{
    public function index()
    {
        $products = Product::with(['supplier','category'])
                    ->search('name')
                    ->latest()
                    ->paginate(10)
                    ->withQueryString();
        return view('backoffice.stock.index', compact('products'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $product->update([
            'quantity' => $request->quantity
        ]);

        return back()->with('toast_success', 'Stok Berhasil Disimpan');
    }
}
