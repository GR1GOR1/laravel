@props([
    'title',
    'h1' => null
    ])
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    @vite(['resources/css/app.scss'])
</head>
<body>
    <header>
        <div class="container border-bottom pt-2 pb-2 mb-2">
            Logo
            <a href="/posts">POSTS</a>
            <a href="/cars">CARS</a>
        </div>
    </header>
    <div class="container">
        <h1>{{ $h1 ?? $title }}</h1>
        {{ $slot }}
    </div>
    <footer>
        <div class="container border-bottom pt-2">
            Footer
        </div>
    </footer>
    @vite(['resources/js/app.js'])
</body>
</html>