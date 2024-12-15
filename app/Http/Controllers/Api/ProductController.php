<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use App\Models\Product;

class ProductController extends Controller
{
    protected $locale;

    public function __construct()
    {
        $this->locale = App::getLocale();
    }

    /**
     * Get all products with default name and image for better performance.
     */
    public function index()
    {
        $products = Product::select('id', 'default_name', 'default_image')->get();

        $data = $products->map(function ($product) {
            return [
                'id' => $product->id,
                'name' => $product->default_name,
                'image' => $product->default_image,
            ];
        });

        return response()->json([
            'status' => true,
            'message' => $this->locale === 'ar'
                ? 'تم جلب المنتجات بنجاح'
                : 'Products fetched successfully',
            'data' => $data,
        ]);
    }

    /**
     * Get a single product with full details and related images.
     */
    public function show($id)
{
    try {
        $product = Product::with([
            'translation' => function ($query) {
                $query->where('locale', app()->getLocale()); // Use the current locale
            },
            'images' // Directly fetch images related to the product
        ])->findOrFail($id);

        $translation = $product->translation;

        $data = [
            'id' => $product->id,
            'name' => $translation ? $translation->name : $product->default_name,
            'location' => $translation ? $translation->location : $product->default_location,
            'phone' => $translation ? $translation->phone : $product->default_phone,
            'open_at' => $translation ? $translation->open_at : $product->default_open_at,
            'closed_at' => $translation ? $translation->closed_at : $product->default_closed_at,
            'activities' => $translation ? $translation->activities : $product->default_activities,
            'rating' => $product->default_rating,
            'default_image' => $product->default_image,
            'translation_images' => $product->images->pluck('image'), // Use images directly from the product
        ];

        return response()->json([
            'status' => true,
            'message' => app()->getLocale() === 'ar'
                ? 'تم جلب المنتج بنجاح'
                : 'Product fetched successfully',
            'data' => $data,
        ]);
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        return response()->json([
            'status' => false,
            'message' => app()->getLocale() === 'ar'
                ? 'رقم منتج خاطئ , لم يتم العثور على المنتج'
                : 'Product not found , Wrong ID Passed',
            'data' => [],
        ]);
    }
}

    
}
