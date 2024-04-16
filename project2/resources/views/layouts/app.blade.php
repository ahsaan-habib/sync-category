<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Categories')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <nav class="bg-white shadow-sm">
        <div class="container mx-auto py-4 px-6">
            <a href="{{ route('categories.index') }}" class="text-lg font-semibold text-gray-800">Categories</a>
        </div>
    </nav>

    <div class="py-8">
        @yield('content')
    </div>
</body>

</html>
