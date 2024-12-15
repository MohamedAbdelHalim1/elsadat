<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Category') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Translations -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">{{ __('Category Translations') }}</label>
                        <div>
                            <!-- Example for English -->
                            <div class="mb-3">
                                <label for="translations[en][name]" class="form-label">{{ __('English Name') }}</label>
                                <input type="text" id="translations[en][name]" name="translations[en][name]" class="form-control @error('translations.en.name') is-invalid @enderror" value="{{ old('translations.en.name', $category->translation('en')->first()->name ?? '') }}">
                                @error('translations.en.name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Example for Arabic -->
                            <div class="mb-3">
                                <label for="translations[ar][name]" class="form-label">{{ __('Arabic Name') }}</label>
                                <input type="text" id="translations[ar][name]" name="translations[ar][name]" class="form-control @error('translations.ar.name') is-invalid @enderror" value="{{ old('translations.ar.name', $category->translation('ar')->first()->name ?? '') }}">
                                @error('translations.ar.name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Image Upload -->
                    <div class="mb-4">
                        <label for="image" class="block text-sm font-medium text-gray-700">{{ __('Category Image') }}</label>
                        <input type="file" id="image" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*" onchange="previewImage(event)">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <div class="mt-3">
                            <div id="image-container" style="display: flex; gap: 10px; flex-wrap: wrap;">
                                <!-- Preview the current image -->
                                @if ($category->image)
                                    <div style="position: relative; display: inline-block;">
                                        <img src="{{ asset($category->image) }}" alt="Category Image" style="max-width: 200px; max-height: 200px; border: 1px solid #ccc; margin-right: 10px;">
                                        <button type="button" class="btn btn-danger" onclick="removeImagePreview()">Remove</button>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">{{ __('Update Category') }}</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function previewImage(event) {
            const imageContainer = document.getElementById('image-container');
            const file = event.target.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    // Create a wrapper div for the image and delete button
                    const imageWrapper = document.createElement('div');
                    imageWrapper.style.position = 'relative';
                    imageWrapper.style.display = 'inline-block';

                    // Create the image element
                    const imagePreview = document.createElement('img');
                    imagePreview.src = e.target.result;
                    imagePreview.style.maxWidth = '200px';
                    imagePreview.style.maxHeight = '200px';
                    imagePreview.style.border = '1px solid #ccc';
                    imagePreview.style.marginRight = '10px';

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
                        imageContainer.removeChild(imageWrapper);
                        event.target.value = ''; // Clear the file input
                    });

                    // Append the image and delete button to the wrapper
                    imageWrapper.appendChild(imagePreview);
                    imageWrapper.appendChild(deleteButton);

                    // Append the wrapper to the image container
                    imageContainer.appendChild(imageWrapper);
                };
                reader.readAsDataURL(file);
            }
        }

        function removeImagePreview() {
            const imageContainer = document.getElementById('image-container');
            imageContainer.innerHTML = ''; // Remove the existing image preview
        }
    </script>
</x-app-layout>
