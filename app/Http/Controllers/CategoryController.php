<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;




class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with('translations')->get();
        return view('categories.index', compact('categories'));
    }

    public function show(Category $category)
    {
        // Retrieve the category with its translations and related data
        $category->load('translations');

        // Pass the category data to the show view
        return view('categories.show', compact('category'));
    }

    public function create()
    {
        return view('categories.create');
    }



    public function store(Request $request)
    {
        $request->validate([
            'translations.en.name' => 'required', // Ensure English name is mandatory
            'translations.ar.name' => 'required', // Ensure Arabic name is mandatory
            'image' => 'required|image|mimetypes:image/jpeg,image/png,image/webp,image/jpg,image/gif,image/bmp,image/svg+xml,image/tiff,image/avif,image/heic,image/heif,image/psd|max:5120',
        ]);

        // Begin transaction
        DB::beginTransaction();

        try {
            // Insert the category
            $categoryId = DB::table('categories')->insertGetId([
                'default_name' => $request->translations['en']['name'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Handle image upload
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $uniqueName = Str::uuid() . '.' . $image->getClientOriginalExtension();

                // Move the image to the 'public/images' folder
                $image->move(public_path('images'), $uniqueName);

                // Store only the relative path in the database
                $imagePath = 'images/' . $uniqueName;
                DB::table('categories')->where('id', $categoryId)->update(['image' => $imagePath]);
            }

            // Insert translations
            foreach ($request->translations as $locale => $translation) {
                DB::table('category_translations')->insert([
                    'category_id' => $categoryId,
                    'locale' => $locale,
                    'name' => $translation['name'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            // Commit the transaction
            DB::commit();

            return redirect()->route('categories.index')->with('success', __('Category created successfully.'));
        } catch (\Exception $e) {
            // Rollback transaction if any error occurs
            DB::rollBack();

            dd($e->getMessage());
        }
    }

    

    public function edit($id)
    {
        $category = Category::with('translations')->findOrFail($id);
        return view('categories.edit', compact('category'));  // Return edit view with category data
    }


   
    public function update(Request $request, $id)
    {
        // Validate request
        $request->validate([
            'translations.en.name' => 'required', // Ensure English name is mandatory
            'translations.ar.name' => 'required', // Ensure Arabic name is mandatory
            'image' => 'nullable|image|mimetypes:image/jpeg,image/png,image/webp,image/jpg,image/gif,image/bmp,image/svg+xml,image/tiff,image/avif,image/heic,image/heif,image/psd|max:5120',
        ]);
    
        // Begin transaction
        DB::beginTransaction();
    
        try {
            // Find the category
            $category = DB::table('categories')->where('id', $id)->first();
    
            if (!$category) {
                return redirect()->back()->with('error', __('Category not found.'));
            }
    
            // Update base category fields
            DB::table('categories')->where('id', $id)->update([
                'default_name' => $request->translations['en']['name'],
                'updated_at' => now(),
            ]);
    
            // Handle image upload if a new image is provided
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $uniqueName = Str::uuid() . '.' . $image->getClientOriginalExtension();
    
                // Delete the old image if it exists
                if ($category->image && file_exists(public_path($category->image))) {
                    unlink(public_path($category->image));
                }
    
                // Move the image to the 'public/images' folder
                $image->move(public_path('images'), $uniqueName);
    
                // Store only the relative path in the database
                $imagePath = 'images/' . $uniqueName;
                DB::table('categories')->where('id', $id)->update(['image' => $imagePath]);
            }
    
            // Update translations
            foreach ($request->translations as $locale => $translation) {
                $existingTranslation = DB::table('category_translations')
                    ->where('category_id', $id)
                    ->where('locale', $locale)
                    ->first();
    
                if ($existingTranslation) {
                    // Update existing translation
                    DB::table('category_translations')
                        ->where('id', $existingTranslation->id)
                        ->update([
                            'name' => $translation['name'],
                            'updated_at' => now(),
                        ]);
                } else {
                    // Insert new translation
                    DB::table('category_translations')->insert([
                        'category_id' => $id,
                        'locale' => $locale,
                        'name' => $translation['name'],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
    
            // Commit transaction
            DB::commit();
    
            return redirect()->route('categories.index')->with('success', __('Category updated successfully.'));
        } catch (\Exception $e) {
            // Rollback transaction on error
            DB::rollBack();
    
            return redirect()->back()->with('error', __('An error occurred: ') . $e->getMessage());
        }
    }
    
    

    public function destroy(Category $category)
    {
        // Define the image path based on the stored database value
        $imagePath = 'images/' . $category->image; // assuming the 'images' folder is inside the 'public' folder
    
        // Check if the image exists before attempting to delete it
        if ($category->image && Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath); // Delete the image using Storage facade
        } else {
            // Log or handle if the image file does not exist
            dd($category->id);
        }
    
        // Delete the category and its translations
        $category->delete();
    
        return redirect()->route('categories.index')->with('success', __('Category deleted successfully.'));
    }
    


}
