<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $productCategories = ProductCategory::all();
        $test = Product::all()->first();

        // foreach($product as $p) {
        //     var_dump($p->member->halal_license);
        // };

        return view('product.index', [
            'products' => $products,
            'productCategories' => $productCategories,
            'test' => $test
        ]);
    }

    public function detail($id)
    {
        $product = Product::with('member')->where('id', $id)->first();

        return view('product.detail', [
            'product' => $product
        ]);
    }

    public function search(Request $request)
    {
        $product_categories = ProductCategory::all();
        $filtered_product = Product::with('productCategory')
            ->where('name', 'like', $request['search-product'] . '%')
            ->orWhereHas('productCategory', function ($query) use ($request) {
                $query->where('name', 'like', $request['search-product'] . '%');
            })
            ->get();

        return view("product.index", [
            'filtered_product' => $filtered_product,
            'search_input' => $request['search-product'],
            'productCategories' => $product_categories
        ]);
    }
}
