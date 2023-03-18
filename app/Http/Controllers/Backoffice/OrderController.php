<?php

namespace App\Http\Controllers\Backoffice;

use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Traits\HasImage;
use App\Enums\OrderStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    use HasImage;
    public $path = 'public/orders';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->hasRole('admin')){
            $orders = Order::with('user')
                    ->search('name')
                    ->latest()
                    ->paginate(10)
                    ->withQueryString();

                    $categories = Category::get();
                    $suppliers = Supplier::get();

            return view('backoffice.order.index', compact('orders', 'categories', 'suppliers'));
        }else{
            $orders = Order::with('user')
                    ->where('user_id', Auth::id())
                    ->search('name')
                    ->latest()
                    ->paginate(10)
                    ->withQueryString();

                    $product = [];

                    foreach( $orders as $order){
                        $product = Product::where('name', $order->name)->where('quantity', $order->quantity)->first();
                    }

                    return view('backoffice.order.index', compact('orders', 'product'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $image = $this->uploadImage($request, $this->path);

        $request->user()->orders()->create([
            'name' => $request->name,
            'quantity' => $request->quantity,
            'image' => $image->hashName(),
            'unit' => $request->unit,
        ]);

        return back()->with('toast_success', 'Data Berhasil Disimpan');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {

        if($order->status == OrderStatus::Pending){
            $order->update([
                'status' => OrderStatus::Verified
            ]);
        }else{
            $image = $this->uploadImage($request, $this->path);
            Product::create([
                'category_id' => $request->category_id,
                'supplier_id' => $request->supplier_id,
                'name' => $request->name,
                'image' => $image->hashName(),
                'unit' => $request->unit,
                'description' => $request->description,
                'quantity' => $request->quantity
            ]);

            $order->update([
                'status' => OrderStatus::Success
            ]);
        }

        return back()->with('toast_success', 'Data Berhasil Diperbarui');
    }

    public function destroy(Order $order)
    {
        Storage::disk('local')->delete($this->path. basename($order->image));

        $order->delete();

        return back()->with('toast_success', 'Data berhasil dihapus');
    }

}
