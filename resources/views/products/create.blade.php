<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Category Dropdown -->
                <div class="mb-4">
                    <label for="category_id" class="block text-sm font-medium text-gray-700">{{ __('Category') }}</label>
                    <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror" required>
                        <option value="">{{ __('Select Category') }}</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->default_name }}</option>
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
                            <input type="text" id="en_name" name="en_name" class="form-control @error('en_name') is-invalid @enderror" value="{{ old('en_name') }}" required>
                            @error('en_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <!-- Arabic Fields -->
                        <div>
                            <label for="ar_name" class="block text-sm font-medium text-gray-700">{{ __('Product Name (AR)') }}</label>
                            <input type="text" id="ar_name" name="ar_name" class="form-control @error('ar_name') is-invalid @enderror" value="{{ old('ar_name') }}" required>
                            @error('ar_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <br><hr style="border: 1px solid #ad9494; margin:auto; width: 50%;"><br>
                    <div class="grid grid-cols-2 gap-6">
                        <!-- English Fields -->
                        <div>
                            <label for="en_location" class="block text-sm font-medium text-gray-700">{{ __('Product Location (EN)') }}</label>
                            <input type="text" id="en_location" name="en_location" location="en_location" class="form-control @error('en_location') is-invalid @enderror" value="{{ old('en_location') }}" required>
                            @error('en_location') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <!-- Arabic Fields -->
                        <div>
                            <label for="ar_location" class="block text-sm font-medium text-gray-700">{{ __('Product Location (AR)') }}</label>
                            <input type="text" id="ar_location" name="ar_location" location="ar_location" class="form-control @error('ar_location') is-invalid @enderror" value="{{ old('ar_location') }}" required>
                            @error('ar_location') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <br><hr style="border: 1px solid #ad9494; margin:auto; width: 50%;"><br>
                    <div class="grid grid-cols-2 gap-6">
                        <!-- English Fields -->
                        <div>
                            <label for="en_phone" class="block text-sm font-medium text-gray-700">{{ __('Product Phone (EN)') }}</label>
                            <input type="text" id="en_phone" name="en_phone" phone="en_phone" class="form-control @error('en_phone') is-invalid @enderror" value="{{ old('en_phone') }}" required>
                            @error('en_phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <!-- Arabic Fields -->
                        <div>
                            <label for="ar_phone" class="block text-sm font-medium text-gray-700">{{ __('Product Phone (AR)') }}</label>
                            <input type="text" id="ar_phone" name="ar_phone" phone="ar_phone" class="form-control @error('ar_phone') is-invalid @enderror" value="{{ old('ar_phone') }}" required>
                            @error('ar_phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <br><hr style="border: 1px solid #ad9494; margin:auto; width: 50%;"><br>
                    <div class="grid grid-cols-2 gap-6">
                        <!-- English Fields -->
                        <div>
                            <label for="en_open_at" class="block text-sm font-medium text-gray-700">{{ __('Product Open At (EN)') }}</label>
                            <input type="text" id="en_open_at" name="en_open_at" open_at="en_open_at" class="form-control @error('en_open_at') is-invalid @enderror" value="{{ old('en_open_at') }}" required>
                            @error('en_open_at') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <!-- Arabic Fields -->
                        <div>
                            <label for="ar_open_at" class="block text-sm font-medium text-gray-700">{{ __('Product Open At (AR)') }}</label>
                            <input type="text" id="ar_open_at" name="ar_open_at" open_at="ar_open_at" class="form-control @error('ar_open_at') is-invalid @enderror" value="{{ old('ar_open_at') }}" required>
                            @error('ar_open_at') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <br><hr style="border: 1px solid #ad9494; margin:auto; width: 50%;"><br>
                    <div class="grid grid-cols-2 gap-6">
                        <!-- English Fields -->
                        <div>
                            <label for="en_close_at" class="block text-sm font-medium text-gray-700">{{ __('Product Close at (EN)') }}</label>
                            <input type="text" id="en_close_at" name="en_close_at" close_at="en_close_at" class="form-control @error('en_close_at') is-invalid @enderror" value="{{ old('en_close_at') }}" required>
                            @error('en_close_at') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <!-- Arabic Fields -->
                        <div>
                            <label for="ar_close_at" class="block text-sm font-medium text-gray-700">{{ __('Product Close At (AR)') }}</label>
                            <input type="text" id="ar_close_at" name="ar_close_at" close_at="ar_close_at" class="form-control @error('ar_close_at') is-invalid @enderror" value="{{ old('ar_close_at') }}" required>
                            @error('ar_close_at') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <br><hr style="border: 1px solid #ad9494; margin:auto; width: 50%;"><br>
                    <div class="grid grid-cols-2 gap-6">
                        <!-- English Fields -->
                        <div>
                            <label for="en_activities" class="block text-sm font-medium text-gray-700">{{ __('Product Activities (EN)') }}</label>
                            <input type="text" id="en_activities" name="en_activities" activities="en_activities" class="form-control @error('en_activities') is-invalid @enderror" value="{{ old('en_activities') }}" required>
                            @error('en_activities') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <!-- Arabic Fields -->
                        <div>
                            <label for="ar_activities" class="block text-sm font-medium text-gray-700">{{ __('Product Activities (AR)') }}</label>
                            <input type="text" id="ar_activities" name="ar_activities" activities="ar_activities" class="form-control @error('ar_activities') is-invalid @enderror" value="{{ old('ar_activities') }}" required>
                            @error('ar_activities') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <br><hr style="border: 1px solid #ad9494; margin:auto; width: 50%;"><br>
                    <div class="grid">
                        <!-- English Fields -->
                        <div>
                            <label for="rating" class="block text-sm font-medium text-gray-700">{{ __('Rating') }}</label>
                            <input type="number" id="rating" name="rating" activities="rating" class="form-control @error('rating') is-invalid @enderror" value="{{ old('rating') }}" required max="5" min="0">
                            @error('rating') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                </div>

                <!-- Images Section -->
                <div class="p-6 bg-white shadow sm:rounded-lg">
                    <h3 class="font-semibold text-lg mb-4">{{ __('Images') }}</h3>

                    <!-- Default Image Upload -->
                    <div class="mb-4">
                        <label for="default_image" class="block text-sm font-medium text-gray-700">{{ __('Default Image') }}</label>
                        <input type="file" id="default_image" name="default_image" class="form-control" accept="image/*" onchange="previewDefaultImage(this)" required aria-label="{{ __('Default Image') }}">
                        <div id="default-image-preview" class="d-flex gap-4 mt-4"></div>
                    </div>

                    <!-- Multiple Translation Images Upload -->
                    <div class="mb-4">
                        <label for="translation_images" class="block text-sm font-medium text-gray-700">{{ __('Translation Images') }}</label>
                        <input type="file" id="translation_images" name="translation_images[]" class="form-control" multiple accept="image/*" onchange="previewTranslationImages(this)" required required aria-label="{{ __('Translation Images') }}">
                        <div id="translation-images-preview" class="d-flex flex-wrap gap-4 mt-4"></div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="mt-6 text-right">
                    <button type="submit" class="btn btn-primary">{{ __('Create Product') }}</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Image Preview Scripts -->
    <script>
function previewDefaultImage(input) {
    const previewContainer = document.getElementById('default-image-preview');
    previewContainer.innerHTML = '';

    if (input.files && input.files[0]) {
        const file = input.files[0];
        const reader = new FileReader();

        reader.onload = function (e) {
            // Create a wrapper div for each image and delete button
            const imageWrapper = document.createElement('div');
            imageWrapper.style.position = 'relative';
            imageWrapper.style.display = 'inline-block';
            imageWrapper.style.margin = '10px';

            // Create an image element
            const imagePreview = document.createElement('img');
            imagePreview.src = e.target.result;
            imagePreview.classList.add('img-thumbnail');
            imagePreview.style.maxWidth = '350px';
            imagePreview.style.maxHeight = '300px';

            // Create the delete button
            const deleteButton = document.createElement('button');
            deleteButton.textContent = 'X';
            deleteButton.style.position = 'absolute';
            deleteButton.style.top = '5px';
            deleteButton.style.right = '5px';
            deleteButton.style.background = 'red';
            deleteButton.style.color = 'white';
            deleteButton.style.border = 'none';
            deleteButton.style.borderRadius = '50%';
            deleteButton.style.width = '20px';
            deleteButton.style.height = '20px';
            deleteButton.style.cursor = 'pointer';

            deleteButton.addEventListener('click', function () {
                imageWrapper.removeChild(imagePreview);
                imageWrapper.removeChild(deleteButton);
                input.value = ''; // Clear the file input
            });

            // Append the image and delete button to the wrapper
            imageWrapper.appendChild(imagePreview);
            imageWrapper.appendChild(deleteButton);

            // Append the wrapper to the preview container
            previewContainer.appendChild(imageWrapper);
        };
        reader.readAsDataURL(file);
    }
}

function previewTranslationImages(input) {
    const previewContainer = document.getElementById('translation-images-preview');
    previewContainer.innerHTML = '';

    const files = input.files; // Get the current list of files

    for (let i = 0; i < files.length; i++) {
        const file = files[i];
        const reader = new FileReader();

        reader.onload = function (e) {
            // Create a wrapper div for each image and delete button
            const imageWrapper = document.createElement('div');
            imageWrapper.style.position = 'relative';
            imageWrapper.style.display = 'inline-block';
            imageWrapper.style.margin = '10px';

            // Create an image element
            const imagePreview = document.createElement('img');
            imagePreview.src = e.target.result;
            imagePreview.classList.add('img-thumbnail');
            imagePreview.style.maxWidth = '150px';
            imagePreview.style.maxHeight = '150px';

            // Create the delete button
            const deleteButton = document.createElement('button');
            deleteButton.textContent = 'X';
            deleteButton.style.position = 'absolute';
            deleteButton.style.top = '5px';
            deleteButton.style.right = '5px';
            deleteButton.style.background = 'red';
            deleteButton.style.color = 'white';
            deleteButton.style.border = 'none';
            deleteButton.style.borderRadius = '50%';
            deleteButton.style.width = '20px';
            deleteButton.style.height = '20px';
            deleteButton.style.cursor = 'pointer';

            deleteButton.addEventListener('click', function () {
                // Remove the image preview and delete button
                imageWrapper.removeChild(imagePreview);
                imageWrapper.removeChild(deleteButton);

                // Remove the file from the input element
                const newFileList = Array.from(input.files).filter(f => f !== file);
                const dataTransfer = new DataTransfer();
                newFileList.forEach(f => dataTransfer.items.add(f));
                input.files = dataTransfer.files; // Update the input's files
            });

            // Append the image and delete button to the wrapper
            imageWrapper.appendChild(imagePreview);
            imageWrapper.appendChild(deleteButton);

            // Append the wrapper to the preview container
            previewContainer.appendChild(imageWrapper);
        };
        reader.readAsDataURL(file);
    }
}

    </script>
</x-app-layout>
