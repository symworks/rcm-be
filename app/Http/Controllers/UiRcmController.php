<?php

namespace App\Http\Controllers;

use App\Models\CategoryProduct;
use App\Models\PriceRange;
use App\Models\Product;
use App\Models\CategoryProductBrand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UiRcmController extends Controller
{
    //
    public function menuProduct()
    {
        $categoryProducts = CategoryProduct::where('is_active', true)->select('id', 'name', 'ui_icon')->limit(5)->get();

        return
        [
            'error_code' => 200,
            'msg' => 'Successfully',
            'payload' => [
                'categoryProducts' => $categoryProducts,
            ]
        ];
    }

    public function menuDetail($product_id)
    {
        $productBrands = CategoryProductBrand::where('product_id', $product_id)->paginate(10);
        $priceRanges = PriceRange::where('product_id', $product_id)->orderBy('min_price', 'asc')->paginate(10);
        $categoryCurrency = DB::table('category_currencies')
            ->join('products', 'products.category_currency_id', '=', 'category_currencies.id')
            ->where('products.id', $product_id)
            ->select('category_currencies.name')
            ->get();

        return
        [
            'error_code' => 200,
            'msg' => 'Successfully',
            'payload' => [
                'product_brands' => $productBrands,
                'price_ranges' => $priceRanges,
                'category_currency' => $categoryCurrency,
            ]
        ];
    }
}
