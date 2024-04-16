<?php

namespace App\Console\Commands;

use App\Models\Category;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class PushCategories extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:push-categories';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Categories pushed to Project 2';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Retrieve categories that need to be pushed (not already pushed)
        $categories = Category::where('time', '<', now())->get();

        // Filter out already pushed categories
        $categories = $categories->reject(function ($category) {
            return Cache::has('pushed_category_' . $category->id);
        });

        // If no categories need to be pushed, exit early
        if ($categories->isEmpty()) {
            $this->info('No categories to push to Project 2.');
            return;
        }

        // Get the base URL for Project 2 from the .env file
        $baseUrl = env('PROJECT2_URL');

        // Send categories to Project 2
        $response = Http::post($baseUrl . '/api/categories/push', $categories);

        // Check if the request was successful
        if ($response->successful()) {
            // Mark categories as pushed in cache
            $categories->each(function ($category) {
                Cache::put('pushed_category_' . $category->id, true);
            });

            $this->info('Categories pushed to Project 2 successfully.');
        } else {
            $this->error('Failed to push categories to Project 2.');
        }
    }
}
