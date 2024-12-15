<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Category Dropdown -->
                <div class="mb-4">
                    <label for="category_id" class="block text-sm font-medium text-gray-700">{{ __('Category') }}</label>
                    <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror" required>
                        <option value="">{{ __('Select Category') }}</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>{{ $category->default_name }}</option>
                        @endforeach
                    </select>
                    @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <!-- Upper Form Section (All Fields Together) -->
                <div class="p-6 bg-white shadow sm:rounded-lg mb-6">
                    <h3 class="font-semibold text-lg mb-4">{{ __('Product Details') }}</h3>
                    <div class="grid grid-cols-2 gap-6">
                        <!-- English Fields -->
                        <div>
                            <label for="en_name" class="block text-sm font-medium text-gray-700">{{ __('Product Name (EN)') }}</label>
                            <input type="text" id="en_name" name="en_name" class="form-control @error('en_name') is-invalid @enderror" value="{{ $product->translation('en')->first()->name ?? ''}}" required>
                            @error('en_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <!-- Arabic Fields -->
                        <div>
                            <label for="ar_name" class="block text-sm font-medium text-gray-700">{{ __('Product Name (AR)') }}</label>
                            <input type="text" id="ar_name" name="ar_name" class="form-control @error('ar_name') is-invalid @enderror" value="{{ $product->translation('ar')->first()->name ?? ''}}" required>
                            @error('ar_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <br><hr style="border: 1px solid #ad9494; margin:auto; width: 50%;"><br>
                    <div class="grid grid-cols-2 gap-6">
                        <!-- English Fields -->
                        <div>
                            <label for="en_location" class="block text-sm font-medium text-gray-700">{{ __('Product Location (EN)') }}</label>
                            <input type="text" id="en_location" name="en_location" location="en_location" class="form-control @error('en_location') is-invalid @enderror" value="{{ $product->translation('en')->first()->location ?? ''}}" required>
                            @error('en_location') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <!-- Arabic Fields -->
                        <div>
                            <label for="ar_location" class="block text-sm font-medium text-gray-700">{{ __('Product Location (AR)') }}</label>
                            <input type="text" id="ar_location" name="ar_location" location="ar_location" class="form-control @error('ar_location') is-invalid @enderror" value="{{ $product->translation('ar')->first()->location ?? ''}}" required>
                            @error('ar_location') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <br><hr style="border: 1px solid #ad9494; margin:auto; width: 50%;"><br>
                    <div class="grid grid-cols-2 gap-6">
                        <!-- English Fields -->
                        <div>
                            <label for="en_phone" class="block text-sm font-medium text-gray-700">{{ __('Product Phone (EN)') }}</label>
                            <input type="text" id="en_phone" name="en_phone" phone="en_phone" class="form-control @error('en_phone') is-invalid @enderror" value="{{ $product->translation('en')->first()->phone ?? ''}}" required>
                            @error('en_phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <!-- Arabic Fields -->
                        <div>
                            <label for="ar_phone" class="block text-sm font-medium text-gray-700">{{ __('Product Phone (AR)') }}</label>
                            <input type="text" id="ar_phone" name="ar_phone" phone="ar_phone" class="form-control @error('ar_phone') is-invalid @enderror" value="{{ $product->translation('ar')->first()->phone ?? ''}}" required>
                            @error('ar_phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <br><hr style="border: 1px solid #ad9494; margin:auto; width: 50%;"><br>
                    <div class="grid grid-cols-2 gap-6">
                        <!-- English Fields -->
                        <div>
                            <label for="en_open_at" class="block text-sm font-medium text-gray-700">{{ __('Product Open At (EN)') }}</label>
                            <input type="text" id="en_open_at" name="en_open_at" open_at="en_open_at" class="form-control @error('en_open_at') is-invalid @enderror" value="{{ $product->translation('en')->first()->open_at ?? ''}}" required>
                            @error('en_open_at') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <!-- Arabic Fields -->
                        <div>
                            <label for="ar_open_at" class="block text-sm font-medium text-gray-700">{{ __('Product Open At (AR)') }}</label>
                            <input type="text" id="ar_open_at" name="ar_open_at" open_at="ar_open_at" class="form-control @error('ar_open_at') is-invalid @enderror" value="{{ $product->translation('ar')->first()->open_at ?? ''}}" required>
                            @error('ar_open_at') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <br><hr style="border: 1px solid #ad9494; margin:auto; width: 50%;"><br>
                    <div class="grid grid-cols-2 gap-6">
                        <!-- English Fields -->
                        <div>
                            <label for="en_close_at" class="block text-sm font-medium text-gray-700">{{ __('Product Close At (EN)') }}</label>
                            <input type="text" id="en_close_at" name="en_close_at" close_at="en_close_at" class="form-control @error('en_close_at') is-invalid @enderror" value="{{ $product->translation('en')->first()->closed_at ?? ''}}" required>
                            @error('en_close_at') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <!-- Arabic Fields -->
                        <div>
                            <label for="ar_close_at" class="block text-sm font-medium text-gray-700">{{ __('Product Close At (AR)') }}</label>
                            <input type="text" id="ar_close_at" name="ar_close_at" close_at="ar_close_at" class="form-control @error('ar_close_at') is-invalid @enderror" value="{{ $product->translation('ar')->first()->closed_at ?? ''}}" required>
                            @error('ar_close_at') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <br><hr style="border: 1px solid #ad9494; margin:auto; width: 50%;"><br>
                    <div class="grid grid-cols-2 gap-6">
                        <!-- English Fields -->
                        <div>
                            <label for="en_activities" class="block text-sm font-medium text-gray-700">{{ __('Product Activities (EN)') }}</label>
                            <input type="text" id="en_activities" name="en_activities" activities="en_activities" class="form-control @error('en_activities') is-invalid @enderror" value="{{ $product->translation('en')->first()->activities ?? ''}}" required>
                            @error('en_activities') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <!-- Arabic Fields -->
                        <div>
                            <label for="ar_activities" class="block text-sm font-medium text-gray-700">{{ __('Product Activities (AR)') }}</label>
                            <input type="text" id="ar_activities" name="ar_activities" activities="ar_activities" class="form-control @error('ar_activities') is-invalid @enderror" value="{{ $product->translation('ar')->first()->activities ?? ''}}" required>
                            @error('ar_activities') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>

                <!-- Rating -->
                <div class="mb-4">
                    <label for="rating" class="block text-sm font-medium text-gray-700">{{ __('Product Rating') }}</label>
                    <input type="number" name="rating" id="rating" min="0" max="5" class="form-control @error('rating') is-invalid @enderror" value="{{ $product->default_rating}}" required>
                    @error('rating') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <!-- Default Image -->
                <div class="mb-4">
                    <label for="default_image" class="block text-sm font-medium text-gray-700">{{ __('Product Default Image') }}</label>
                    <input type="file" name="default_image" id="default_image" class="form-control @error('default_image') is-invalid @enderror" accept="image/*">
                    <div id="preview_default_image_container" class="mt-2">
                        <img id="preview_default_image" src="{{ asset($product->default_image) }}" alt="Preview" class="w-40 h-40 object-cover" />
                        <button type="button" id="remove_default_image" class="remove-image text-red-500 mt-2">Remove</button>
                    </div>
                    @error('default_image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <!-- Translation Images -->
                <div class="mb-4">
                    <label for="translation_images" class="block text-sm font-medium text-gray-700">{{ __('Translation Images') }}</label>
                    <input type="file" name="translation_images[]" id="translation_images" class="form-control @error('translation_images') is-invalid @enderror" accept="image/*" multiple>
                    <div id="preview_translation_images" class="d-flex gap-4 mt-4">
                        @foreach ($product->images as $image)
                            <div class="image-preview">
                                <img src="{{ asset($image->image) }}" alt="Translation Image" class="w-24 h-24 object-cover" />
                                <button type="button" class="remove-image text-red-500">Remove</button>
                            </div>
                        @endforeach
                    </div>
                    @error('translation_images') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>


                <!-- Submit Button -->
                <div class="mb-4">
                    <button type="submit" class="btn btn-primary">{{ __('Update Product') }}</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Preview default image
        function previewDefaultImage() {
            const file = document.getElementById('default_image').files[0];
            const reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById('preview_default_image').src = e.target.result;
                // Show the remove button when the user selects a new default image
                document.getElementById('remove_default_image').style.display = 'inline';
            };
            reader.readAsDataURL(file);
        }
    
        // Preview translation images
        function previewTranslationImages() {
            const files = document.getElementById('translation_images').files;
            const previewContainer = document.getElementById('preview_translation_images');
            previewContainer.innerHTML = ''; // Clear the preview container
            for (let i = 0; i < files.length; i++) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const div = document.createElement('div');
                    div.classList.add('image-preview');
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.classList.add('w-24', 'h-24', 'object-cover');
                    const removeBtn = document.createElement('button');
                    removeBtn.type = 'button';
                    removeBtn.classList.add('remove-image', 'text-red-500');
                    removeBtn.textContent = 'Remove';
                    removeBtn.onclick = function () {
                        div.remove(); // Remove image preview
                    };
                    div.appendChild(img);
                    div.appendChild(removeBtn);
                    previewContainer.appendChild(div);
                };
                reader.readAsDataURL(files[i]);
            }
        }
    
        // Event listeners for input change events
        document.getElementById('default_image').addEventListener('change', previewDefaultImage);
        document.getElementById('translation_images').addEventListener('change', previewTranslationImages);
    
        // Remove default image preview when the "Remove" button is clicked
        document.getElementById('remove_default_image').addEventListener('click', function() {
            document.getElementById('preview_default_image').src = ''; // Clear the preview
            document.getElementById('remove_default_image').style.display = 'none'; // Hide the remove button
            document.getElementById('default_image').value = ''; // Clear the file input
        });
    
        // Remove image on click of the "Remove" button (for translation images)
        document.querySelectorAll('.remove-image').forEach(button => {
            button.addEventListener('click', function () {
                const previewDiv = button.closest('.image-preview');
                previewDiv.remove();
            });
        });
    </script>
    
</x-app-layout>
