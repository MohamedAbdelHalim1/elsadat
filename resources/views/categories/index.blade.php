<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Categories') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <!-- Display Flash Message (if any) -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @elseif(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="flex justify-end mb-4">
                <a href="{{ route('categories.create') }}" class="btn btn-success">
                    {{ __('Add New Category') }}
                </a>
            </div>
            <!-- Table of Categories -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <table id="datatable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>{{ __('Default Name') }}</th>
                            <th>{{ __('Image') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>{{ $category->default_name }}</td>
                                <td>
                                    @if($category->image)
                                        <img src="{{ asset( $category->image) }}" alt="Category Image" style="max-width: 100px; max-height: 100px;">
                                    @else
                                        <small><i><b>no image inserted</b></i></small>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('categories.show', $category->id) }}" class="btn btn-primary">{{ __('Show') }}</a>
                                    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-secondary">{{ __('Edit') }}</a>
                                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this category?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">{{ __('Delete') }}</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</x-app-layout>
