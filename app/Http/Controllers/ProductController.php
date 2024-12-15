<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\ProductTranslation;
use App\Models\ProductTranslationImage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;


class ProductController extends Controller
{
    // Show the list of products
    public function index()
    {
        $products = Product::with('translation')->get();
        return view('products.index', compact('products'));
    }

        // Show the details of a specific product
    public function show(Product $product)
    {
        // Instead of finding by $id, use the passed product instance
        $product->load('translations' ,'category' , 'images'); // Load translations for the given product
    
        // Return the view with the product
        return view('products.show', compact('product'));
    }
    // Show the form to create a new product
    public function create()
    {
        // Pass categories to the form
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    // Store a new product along with translations and images
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'en_name' => 'required|string|max:255',
            'ar_name' => 'required|string|max:255',
            'ar_location' => 'required|string|max:255',
            'en_location' => 'required|string|max:255',
            'en_phone' => 'required|string|max:255',
            'ar_phone' => 'required|string|max:255',
            'en_open_at' => 'required|string|max:255',
            'ar_open_at' => 'required|string|max:255',
            'en_close_at' => 'required|string|max:255',
            'ar_close_at' => 'required|string|max:255',
            'en_activities' => 'required',
            'ar_activities' => 'required',
            'rating' => 'required|numeric|min:0|max:5',
            'default_image' => 'required|image|mimetypes:image/jpeg,image/png,image/webp,image/jpg,image/gif,image/bmp,image/svg+xml,image/tiff,image/avif,image/heic,image/heif,image/psd|max:5120',
            'translation_images.*' => 'required|image|mimetypes:image/jpeg,image/png,image/webp,image/jpg,image/gif,image/bmp,image/svg+xml,image/tiff,image/avif,image/heic,image/heif,image/psd|max:5120',
        ]);

        // Start a database transaction
        DB::beginTransaction();

        try {
            // Handle default image upload with unique name
            $defaultImage = $request->file('default_image');
            $uniqueDefaultImageName = Str::uuid() . '.' . $defaultImage->getClientOriginalExtension();
            $defaultImagePath = $defaultImage->move(public_path('images'), $uniqueDefaultImageName);

            // Insert product and get product ID
            $product = Product::create([
                'category_id' => $request->input('category_id'),
                'default_name' => $request->input('en_name'),
                'default_location' => $request->input('en_location'),
                'default_phone' => $request->input('en_phone'),
                'default_open_at' => $request->input('en_open_at'),
                'default_closed_at' => $request->input('en_close_at'),
                'default_activities' => $request->input('en_activities'),
                'default_rating' => $request->input('rating'),
                'default_image' => 'images/' . $uniqueDefaultImageName, // Save the relative path
            ]);

            // Insert product translations (English & Arabic)
            DB::table('product_translations')->insert([
                [
                    'product_id' => $product->id,
                    'locale' => 'en',
                    'name' => $request->input('en_name'),
                    'location' => $request->input('en_location'),
                    'phone' => $request->input('en_phone'),
                    'open_at' => $request->input('en_open_at'),
                    'closed_at' => $request->input('en_close_at'),
                    'activities' => $request->input('en_activities'),
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'product_id' => $product->id,
                    'locale' => 'ar',
                    'name' => $request->input('ar_name'),
                    'location' => $request->input('ar_location'),
                    'phone' => $request->input('ar_phone'),
                    'open_at' => $request->input('ar_open_at'),
                    'closed_at' => $request->input('ar_close_at'),
                    'activities' => $request->input('ar_activities'),
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            ]);

            // Insert images for product translations
            if ($request->hasFile('translation_images')) {
                foreach ($request->file('translation_images') as $image) {
                    $uniqueImageName = Str::uuid() . '.' . $image->getClientOriginalExtension();
                    $imagePath = $image->move(public_path('images'), $uniqueImageName);

                    // Insert image for the product
                    $product->images()->create([
                        'image' => 'images/' . $uniqueImageName, // Save the relative path
                    ]);
                }
            }

            // Commit transaction
            DB::commit();

            return redirect()->route('products.index')->with('success', 'Product created successfully.');
        } catch (\Exception $e) {
            // Rollback transaction on error
            DB::rollBack();

            dd($e->getMessage());
        }
    }


    // Show the form to edit an existing product
    public function edit($id)
    {
        // Find the product and pass its translations for editing
        $product = Product::with('translations')->findOrFail($id);
        $categories = Category::all();
    
        return view('products.edit', compact('product', 'categories'));
    }
    

    // Update an existing product, including its translations and images
    public function update(Request $request, $id)
{
    // Validate the request
    $request->validate([
        'category_id' => 'required|exists:categories,id',
        'en_name' => 'required|string|max:255',
        'ar_name' => 'required|string|max:255',
        'ar_location' => 'required|string|max:255',
        'en_location' => 'required|string|max:255',
        'en_phone' => 'required|string|max:255',
        'ar_phone' => 'required|string|max:255',
        'en_open_at' => 'required|string|max:255',
        'ar_open_at' => 'required|string|max:255',
        'en_close_at' => 'required|string|max:255',
        'ar_close_at' => 'required|string|max:255',
        'en_activities' => 'required',
        'ar_activities' => 'required',
        'rating' => 'required|numeric|min:0|max:5',
        'default_image' => 'nullable|image|mimetypes:image/jpeg,image/png,image/webp,image/jpg,image/gif,image/bmp,image/svg+xml,image/tiff,image/avif,image/heic,image/heif,image/psd|max:5120',
        'translation_images.*' => 'nullable|image|mimetypes:image/jpeg,image/png,image/webp,image/jpg,image/gif,image/bmp,image/svg+xml,image/tiff,image/avif,image/heic,image/heif,image/psd|max:5120',
    ]);

    // Start a database transaction
    DB::beginTransaction();

    try {
        // Retrieve the product to be updated
        $product = Product::findOrFail($id);

        // Handle the default image upload (if new image is provided)
        if ($request->hasFile('default_image')) {
            // Delete the old default image if it exists
            if ($product->default_image && file_exists(public_path($product->default_image))) {
                unlink(public_path($product->default_image));
            }

            // Upload the new default image
            $defaultImage = $request->file('default_image');
            $uniqueDefaultImageName = Str::uuid() . '.' . $defaultImage->getClientOriginalExtension();
            $defaultImagePath = $defaultImage->move(public_path('images'), $uniqueDefaultImageName);
            $product->default_image = 'images/' . $uniqueDefaultImageName;
        }

        // Update the product details
        $product->category_id = $request->input('category_id');
        $product->default_name = $request->input('en_name');
        $product->default_location = $request->input('en_location');
        $product->default_phone = $request->input('en_phone');
        $product->default_open_at = $request->input('en_open_at');
        $product->default_closed_at = $request->input('en_close_at');
        $product->default_activities = $request->input('en_activities');
        $product->default_rating = $request->input('rating');
        $product->save();

        // Update product translations (English & Arabic)
        $product->translations()->updateOrCreate(
            ['locale' => 'en'],
            [
                'name' => $request->input('en_name'),
                'location' => $request->input('en_location'),
                'phone' => $request->input('en_phone'),
                'open_at' => $request->input('en_open_at'),
                'closed_at' => $request->input('en_close_at'),
                'activities' => $request->input('en_activities'),
                'updated_at' => now(),
            ]
        );

        $product->translations()->updateOrCreate(
            ['locale' => 'ar'],
            [
                'name' => $request->input('ar_name'),
                'location' => $request->input('ar_location'),
                'phone' => $request->input('ar_phone'),
                'open_at' => $request->input('ar_open_at'),
                'closed_at' => $request->input('ar_close_at'),
                'activities' => $request->input('ar_activities'),
                'updated_at' => now(),
            ]
        );

        // Handle translation images
        if ($request->hasFile('translation_images')) {
            // Delete all previous translation images if they exist
            $product->images()->delete();

            // Upload new translation images
            foreach ($request->file('translation_images') as $image) {
                $uniqueImageName = Str::uuid() . '.' . $image->getClientOriginalExtension();
                $imagePath = $image->move(public_path('images'), $uniqueImageName);

                // Insert the image for the product
                $product->images()->create([
                    'image' => 'images/' . $uniqueImageName, // Save the relative path
                ]);
            }
        }

        // Commit the transaction
        DB::commit();

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    } catch (\Exception $e) {
        // Rollback the transaction on error
        DB::rollBack();

        return back()->with('error', 'Failed to update the product. Please try again.');
    }
}


    // Delete a product along with its translations and images

    public function destroy(Product $product)
    {
        // Delete the main product image from the public/images directory
        if ($product->default_image) {
            $imagePath = public_path('images/' . $product->default_image);
            if (File::exists($imagePath)) {
                File::delete($imagePath); // Deleting with File facade
            }
        }
    
        // Delete all images associated with the product translation from the public/images directory
        if ($product->translation) {
            foreach ($product->translation->images as $image) {
                $imagePath = public_path('images/' . $image->image);
                if (File::exists($imagePath)) {
                    File::delete($imagePath); // Deleting with File facade
                }
                $image->delete(); // Delete image record from the database
            }
    
            // Delete the product translation record
            $product->translation->delete();
        }
    
        // Delete the product record
        $product->delete();
    
        // Redirect back with success message
        return redirect()->route('products.index')->with('success', __('Product deleted successfully.'));
    }
    

}
