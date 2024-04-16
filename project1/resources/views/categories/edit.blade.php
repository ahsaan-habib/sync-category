@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-3xl font-semibold mb-4 text-center">Edit Category</h1>

        <form action="{{ route('categories.update', $category->id) }}" method="POST" class="max-w-md mx-auto">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}"
                    class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>

            <div class="mb-4">
                <label for="time" class="block text-sm font-medium text-gray-700">Time</label>
                <input type="datetime-local" name="time" id="time"
                    value="{{ old('time', \Carbon\Carbon::parse($category->time)->format('Y-m-d\TH:i')) }}"
                    class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>
            @if ($errors->any())
                <div class="text-red-600">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="flex mt-8">
                <button type="submit"
                    class="w-1/2 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Update<button />
                    <button class="w-1/2 bg-gray-300 rounded hover:bg-gray-200"><a href="{{ route('categories.index') }}"
                            class="text-center ">Cancel</a><button />
            </div>
        </form>
    </div>
@endsection
