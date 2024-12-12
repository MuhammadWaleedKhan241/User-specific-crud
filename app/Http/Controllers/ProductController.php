<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        // Fetch products that belong to the logged-in user and paginate them (e.g., 10 products per page)
        $products = Product::where('user_id', Auth::id())->orderBy('created_at', 'ASC')->paginate(10);

        return view('products.index', [
            'products' => $products
        ]);
    }



    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|min:5',
            'sku' => 'required|min:3',
            'price' => 'required|numeric'
        ];

        if ($request->image != "") {
            $rules['image'] = 'image';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('products.create')->withInput()->withErrors($validator);
        }

        // Create and save the product with the user_id
        $product = new Product();
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->user_id = Auth::id(); // Save the authenticated user's ID
        $product->save();

        if ($request->image != "") {
            // Store image
            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = time() . '.' . $ext; // Unique image name

            // Save image to products directory
            $image->move(public_path('uploads/products'), $imageName);

            // Save image name in database
            $product->image = $imageName;
            $product->save();
        }

        return redirect()->route('products.index')->with('success', 'Product added successfully.');
    }



    public function edit(Product $product)
    {
        // Returning the edit page with the product details
        return view('products.edit', compact('product'));
    }

    public function update($id, Request $request)
    {
        $product = Product::findOrFail($id);

        // Ensure the product belongs to the logged-in user
        if ($product->user_id != Auth::id()) {
            return redirect()->route('products.index')->with('error', 'Unauthorized access.');
        }

        $rules = [
            'name' => 'required|min:5',
            'sku' => 'required|min:3',
            'price' => 'required|numeric'
        ];

        if ($request->image != "") {
            $rules['image'] = 'image';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('products.edit', $product->id)->withInput()->withErrors($validator);
        }

        // Update product details
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->save();

        if ($request->image != "") {
            // Delete old image
            File::delete(public_path('uploads/products/' . $product->image));

            // Store new image
            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = time() . '.' . $ext; // Unique image name

            // Save image to products directory
            $image->move(public_path('uploads/products'), $imageName);

            // Save new image name in database
            $product->image = $imageName;
            $product->save();
        }

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }


    public function destroy(Product $product)
    {
        // If there's an associated image, delete it
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        // Delete the product
        $product->delete();

        // Redirect back with a success message
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
