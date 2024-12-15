<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Category Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Category Card -->
            <div class="p-8 bg-white shadow sm:rounded-lg border border-gray-200">
                
                <!-- Category Details -->
                <div class="space-y-4">
                    <div class="flex gap-6">
                        <p class="font-medium text-gray-700">{{ __('English Name') }}:</p>
                        <p class="text-lg text-gray-900">{{ $category->translation('en')->first()->name }}</p>
                    </div>
                    <div class="flex gap-6">
                        <p class="font-medium text-gray-700">{{ __('Arabic Name') }}:</p>
                        <p class="text-lg text-gray-900">{{ $category->translation('ar')->first()->name }}</p>
                    </div>
                    <div class="flex gap-6">
                        <p class="font-medium text-gray-700">{{ __('Image') }}:</p>
                        <p class="text-lg text-gray-900">
                            @if($category->image)
                                <img src="{{ asset( $category->image) }}" alt="Category Image" class="w-24 h-24 object-cover rounded-lg">
                            @else
                                {{ __('No image available') }}
                            @endif
                        </p>
                    </div>
                    <div class="flex gap-6">
                        <p class="font-medium text-gray-700">{{ __('Created At') }}:</p>
                        <p class="text-lg text-gray-900">{{ $category->created_at->format('d M, Y') }}</p>
                    </div>
                    <div class="flex gap-6">
                        <p class="font-medium text-gray-700">{{ __('Updated At') }}:</p>
                        <p class="text-lg text-gray-900">{{ $category->updated_at->format('d M, Y') }}</p>
                    </div>
                </div>

                <!-- Edit Button -->
                <div class="mt-6">
                    <a href="{{ route('categories.edit', $category->id) }}" class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-semibold text-sm rounded-lg shadow-md hover:bg-blue-500 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5 mr-2">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3H6v7H3l6 6 6-6h-3z" />
                        </svg>
                        {{ __('Edit Category') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
