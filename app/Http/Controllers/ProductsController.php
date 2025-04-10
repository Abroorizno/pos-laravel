<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Products Data';
        $products = Products::with('category')->get();
        $categories = Categories::orderBy('id', 'desc')->get();
        // return $products;
        return view('products.index', compact('title', 'products', 'categories'));
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
        $isActive = $request->has('is_active') ? 1 : 0;
        $data = [
            'category_id' => $request->product_category,
            'product_name' => $request->product_name,
            'product_code' => $request->product_code,
            'product_price' => $request->price_product,
            'product_description' => $request->desc_product,
            'is_active' => $request->is_active,
        ];

        if ($request->hasFile('photo_product')) {
            $file = $request->file('photo_product')->store('products', 'public');
            $data['product_photo'] = $file;
        }

        Products::create($data);
        Alert::success('Success', 'Success Added Product');
        // toast('Success Added Product', 'success')->autoClose(3000);
        return redirect()->to('products');
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
        $edit = Products::findOrFail($id);
        $categories = Categories::orderBy('id', 'desc')->get();
        return view('products.index', compact('edit', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = [
            'category_id' => $request->product_category,
            'product_name' => $request->product_name,
            'product_code' => $request->product_code,
            'product_price' => $request->price_product,
            'product_description' => $request->desc_product,
            'is_active' => $request->is_active,
        ];


        $product = Products::findOrFail($id);
        if ($request->hasFile('photo_product')) {
            if ($product->product_photo) {
                File::delete(public_path('storage/' . $product->product_photo));
            }

            $file = $request->file('photo_product')->store('products', 'public');
            $data['product_photo'] = $file;
        }

        $product->update($data);
        Alert::success('Success', 'Update Product Success');
        return redirect()->to('products');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Products::findOrFail($id);
        File::delete(public_path('storage/' . $product->product_photo));

        $product->delete();
        Alert::success('Success', 'Delete Product Success');
        return redirect()->to('products');
    }
}
