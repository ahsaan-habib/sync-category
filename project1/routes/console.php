<?php

use App\Console\Commands\PushCategories;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

// Artisan::command('app:push-categories', function () {
//     // Query the database for categories (set time is earlier than current time)
//     $this->comment('Pushing categories to Project 2...');
//     $categories = Category::where('time', '<', now())->get();

//     // Push the data to Project 2
//     foreach ($categories as $category) {
//         Http::post('http://127.0.0.1:8001/categories', $category->toArray());
//     }

//     $this->info('Categories pushed to Project 2 successfully.');
// })->purpose('Push Categories to Project2')->everyMinute();

Schedule::command(PushCategories::class)->everyMinute();
