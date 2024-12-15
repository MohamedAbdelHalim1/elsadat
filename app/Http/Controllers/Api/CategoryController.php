<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use App\Models\Category;


use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $locale;


    public function __construct()
    {
        $this->locale = App::getLocale(); // Get the globally set locale
    }

    public function index()
    {
        $categories = Category::with(['translation' => function ($query) {
            $query->where('locale', $this->locale); // Use $locale to filter translations
        }])->get();

        $data = $categories->map(function ($category) {
            $translation = $category->translation; // Use 'translation' instead of 'translations'
            
            return [
                'id' => $category->id,
                'name' => $translation ? $translation->name : $category->default_name,
            ];
        });

        return response()->json([
            'status' => true,
            'message' => $this->locale === 'ar'
                ? 'تم جلب الفئات بنجاح'
                : 'Categories fetched successfully',
            'data' => $data,
        ]);
    }



    public function search(Request $request)
    {
        $search = $request->input('search', '');

        // Validate input
        if (empty($search)) {
            return response()->json([
                'status' => false,
                'message' => $this->locale === 'ar'
                    ? 'يرجى إدخال كلمة للبحث'
                    : 'Please enter a search term',
                'data' => [],
            ]);
        }

        // Use the Category model's helper method to search for categories
        $categories = Category::searchCategories($search);

        // Check if categories are found
        if ($categories->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => $this->locale === 'ar'
                    ? 'لم يتم العثور على نتائج'
                    : 'No results found',
                'data' => [],
            ]);
        }

        // Map the results
        $data = $categories->map(function ($category) {
            $translation = $category->translation;

            return [
                'id' => $category->id,
                'name' => $translation ? $translation->name : null, // Translated name only
                'image' => $category->image,

            ];
        });

        return response()->json([
            'status' => true,
            'message' => $this->locale === 'ar'
                ? 'تم العثور على النتائج'
                : 'Results found',
            'data' => $data,
        ]);
    }


}
