<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product Details') }} - {{ $product->category->default_name }} <!-- Display category name -->
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Product Details Card -->
            <div class="p-8 bg-white shadow sm:rounded-lg border border-gray-200">
                
                <!-- Product Information -->
                <div class="space-y-4">
                    <div class="flex gap-6">
                        <p class="font-medium text-gray-700">{{ __('English Name') }}:</p>
                        <p class="text-lg text-gray-900">{{ $product->translation('en')->first()->name }}</p>
                    </div>
                    <div class="flex gap-6">
                        <p class="font-medium text-gray-700">{{ __('Arabic Name') }}:</p>
                        <p class="text-lg text-gray-900">{{ $product->translation('ar')->first()->name }}</p>
                    </div>
                    <div class="flex gap-6">
                        <p class="font-medium text-gray-700">{{ __('Category') }}:</p>
                        <p class="text-lg text-gray-900">{{ $product->category->default_name }}</p> <!-- Display category name -->
                    </div>

                    <div class="flex gap-6">
                        <p class="font-medium text-gray-700">{{ __('Rating') }}:</p>
                        <p class="text-lg text-gray-900">{{ $product->default_rating }}</p> <!-- Display category name -->
                    </div>

                    <!-- Other Product Details -->
                    <div class="flex gap-6">
                        <p class="font-medium text-gray-700">{{ __('English Location') }}:</p>
                        <p class="text-lg text-gray-900">{{ $product->translation('en')->first()->location }}</p>
                    </div>
                    <div class="flex gap-6">
                        <p class="font-medium text-gray-700">{{ __('Arabic Location') }}:</p>
                        <p class="text-lg text-gray-900">{{ $product->translation('ar')->first()->location }}</p>
                    </div>
                    <div class="flex gap-6">
                        <p class="font-medium text-gray-700">{{ __('English phone') }}:</p>
                        <p class="text-lg text-gray-900">{{ $product->translation('en')->first()->phone }}</p>
                    </div>
                    <div class="flex gap-6">
                        <p class="font-medium text-gray-700">{{ __('Arabic phone') }}:</p>
                        <p class="text-lg text-gray-900">{{ $product->translation('ar')->first()->phone }}</p>
                    </div>
                    <div class="flex gap-6">
                        <p class="font-medium text-gray-700">{{ __('English activities') }}:</p>
                        <p class="text-lg text-gray-900">{{ $product->translation('en')->first()->activities }}</p>
                    </div>
                    <div class="flex gap-6">
                        <p class="font-medium text-gray-700">{{ __('Arabic activities') }}:</p>
                        <p class="text-lg text-gray-900">{{ $product->translation('ar')->first()->activities }}</p>
                    </div>
                    <div class="flex gap-6">
                        <p class="font-medium text-gray-700">{{ __('English Open at') }}:</p>
                        <p class="text-lg text-gray-900">{{ $product->translation('en')->first()->open_at }}</p>
                    </div>
                    <div class="flex gap-6">
                        <p class="font-medium text-gray-700">{{ __('Arabic Open at') }}:</p>
                        <p class="text-lg text-gray-900">{{ $product->translation('ar')->first()->open_at }}</p>
                    </div>
                    <div class="flex gap-6">
                        <p class="font-medium text-gray-700">{{ __('English closed at') }}:</p>
                        <p class="text-lg text-gray-900">{{ $product->translation('en')->first()->closed_at }}</p>
                    </div>
                    <div class="flex gap-6">
                        <p class="font-medium text-gray-700">{{ __('Arabic Closed at') }}:</p>
                        <p class="text-lg text-gray-900">{{ $product->translation('ar')->first()->closed_at }}</p>
                    </div>

                    <!-- Default Image (Category Image) -->
                    <div class="flex gap-6">
                        <p class="font-medium text-gray-700">{{ __('Default Image') }}:</p>
                        <p class="text-lg text-gray-900">
                            @if($product->default_image)
                                <img src="{{ asset($product->default_image) }}" alt="Category Image" style="width: 250px ; height: auto;" class="object-cover rounded-lg">
                            @else
                                {{ __('No image available') }}
                            @endif
                        </p>
                    </div>

                    <!-- Display Images -->
                    <div class="flex gap-6">
                        <p class="font-medium text-gray-700">{{ __('Images') }}:</p>
                        <div class="d-flex gap-4">
                            @foreach($product->images as $image)
                                <img src="{{ asset($image->image) }}" alt="Product Image" class="w-24 h-24 object-cover rounded-lg">
                            @endforeach
                        </div>
                    </div>
                    <div class="flex gap-6">
                        <p class="font-medium text-gray-700">{{ __('Created At') }}:</p>
                        <p class="text-lg text-gray-900">{{ $product->category->created_at->format('d M, Y') }}</p>
                    </div>
                    <div class="flex gap-6">
                        <p class="font-medium text-gray-700">{{ __('Updated At') }}:</p>
                        <p class="text-lg text-gray-900">{{ $product->category->updated_at->format('d M, Y') }}</p>
                    </div>
                </div>

                <!-- Edit Button -->
                <div class="mt-6">
                    <a href="{{ route('products.edit', $product->id) }}" class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-semibold text-sm rounded-lg shadow-md hover:bg-blue-500 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5 mr-2">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3H6v7H3l6 6 6-6h-3z" />
                        </svg>
                        {{ __('Edit Product') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
