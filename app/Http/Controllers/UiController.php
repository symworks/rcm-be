<?php

namespace App\Http\Controllers;

use App\Models\AdsCampaign;
use App\Models\PriceRange;
use App\Models\Product;
use App\Models\ProductBrand;
use App\Models\ProductDemand;
use App\Models\ProductType;
use Illuminate\Support\Facades\DB;

class UiController extends Controller
{
    //
    public function rcm_category_menu($product_id)
    {
        return [
            'error_code' => 200,
            'msg' => 'Successfully',
            'payload' => [
                'product_brands' => ProductBrand::where('product_id', $product_id)->paginate(10),
                'price_ranges' => PriceRange::where('product_id', $product_id)->orderBy('min_price', 'asc')->paginate(10),
                'product_demands' => ProductDemand::where('product_id', $product_id)->select('id', 'name')->paginate(10),
                'trendings' => Product::where('is_trending', true)->select('id', 'name')->paginate(10),
            ],
        ];
    }

    public function rcm_product_list($product_type_id)
    {
        return [
            'error_code' => 200,
            'msg' => 'Successfully',
            'payload' => [
                'products' => Product::where('product_type_id', $product_type_id)->paginate(20),
            ]
        ];
    }
}
