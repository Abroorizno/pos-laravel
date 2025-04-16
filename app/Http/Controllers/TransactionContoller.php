<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Order;
use App\Models\orderDetails;
use App\Models\Products;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;


class TransactionContoller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Transaction Order Data';
        $orders = Order::with('orderDetails', 'category', 'product')->orderBy('id', 'desc')->get();
        // return $orders;

        $categories = Categories::orderBy('id', 'desc')->get();
        // return $products;
        return view('pos.index', compact('title', 'orders', 'categories'));
        // return view('products.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //ORDER CODE
        $order_code = Order::max('id');
        $order_code++;
        $order_code = 'TRX-' . date('dmY') . sprintf('%04d', $order_code);

        $data = [
            'order_code' => $order_code,
            'order_mount' => $request->grandTotal,
            'order_change' => 1,
            'order_status' => 0,
        ];

        $order = Order::create($data);

        $qty = $request->product_qty;
        foreach ($qty as $key => $value) {
            $data = [
                'order_id' => $order->id,
                'product_id' => $request->product_id[$key],
                'qty' => $request->product_qty[$key],
                'order_price' => $request->product_price[$key],
                'order_subtotal' => $request->product_subtotal[$key],
            ];
            orderDetails::create($data);
        };

        Alert::success('Success', 'Order Success!');
        return redirect()->route('pos.index')->with('success', 'Transaction Success');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Order::where('id', $id)->update([
            'order_change' => $request->change_amount, // ← pakai change_amount sesuai input
            'order_status' => "1"
        ]);

        return redirect()->to('pos');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function getProduct($category_id)
    {
        $products = Products::where('category_id', $category_id)->get();
        $resonse = [
            'status' => 'success',
            'message' => 'Data found',
            'data' => $products
        ];
        return response()->json($resonse, 200);
    }

    public function print($id)
    {
        // $order = Order::find($id);
        // $orderDetails = orderDetails::where('order_id', $id)->get();
        // $resonse = [
        //     'status' => 'success',
        //     'message' => 'Data found',
        //     'data' => $order,
        //     'orderDetails' => $orderDetails
        // ];
        // return response()->json($resonse, 200);
        $orders = Order::with('orderDetails', 'category', 'product')->find($id);
        return view('pos.print', compact('id', 'orders'));
    }
}
