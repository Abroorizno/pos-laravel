<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Order;
use App\Models\Products;
use Illuminate\Http\Request;

class TransactionContoller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Transaction Order Data';
        $orders = Order::with('category')->get();
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
        //
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
        //
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
}
