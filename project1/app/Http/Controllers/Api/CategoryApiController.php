<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryApiController extends Controller
{

    /**
     * Insert category push from project 1
     */
    public function push(Request $request)
    {

        $validatedData = $request->validate([
            '*.name' => 'required|string|max:255',
            '*.time' => 'nullable|date',
        ]);
        // Extract new categories from validated data
        $newCategories = collect($validatedData)->reject(function ($data) {
            return Category::where('name', $data['name'])->where('time', $data['time'])->exists();
        });

        // Bulk insert new categories
        if ($newCategories->isNotEmpty()) {
            $categoriesToInsert = $newCategories->map(function ($data) {
                return [
                    'name' => $data['name'],
                    'time' => $data['time'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            });

            DB::table('categories')->insert($categoriesToInsert->toArray());
        }

        return response()->json(['message' => 'Categories data received and stored successfully'], 200);
    }
}
