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
           <div class="row">
                <div class="col"><div class="alert">Logo</div></div>
                <div class="col d-flex justify-content-end">
                    Hello hot boyyyyy
                </div>
           </div>
            <a href="/posts">POSTS</a>
            <a href="/cars">CARS</a>
            <a href="/cars/trashed">Deleted Cars</a>
        </div>
    </header>
    <!-- Лучше сделать отдельным компонентом -->
    <!-- Можно сразу подготовить конфиг гед будут текст и тип сообщения, т.е. не писать отдельно успешный алерт -->
    <div class="container">
    <div class="row">
        <div class="col col-3">
            <div class="list-group">
               <ul>
                    @can('cars')
                    <li class="list-group-item">
                        <a href="{{ route('cars.index') }}">Cars</a>
                    </li>
                    @endif
                    <li class="list-group-item">
                        <a href="{{ route('brands.index') }}">Brands</a>
                    </li>
                    <li class="list-group-item">
                        <a href="{{ route('account.index') }}">Account</a>
                    </li>
               </ul>
            </div>
        </div>
        <div class="col col-9">
            @if (session('alert'))
                <div class="alert alert-infp d-flex align-items-center" role="alert">
                        {{ session('alert') }}
                </div>
            @endif
            <div class="container">
                <h1>{{ $h1 ?? $title }}</h1>
                {{ $slot }}
            </div>
        </div>
    </div>
    </div>
    <footer>
        <div class="container border-bottom pt-2">
            Footer
        </div>
    </footer>
    <script>
        window.appData = {{ Js::from([ 'apiRoot' => '/api' ]) }};
    </script>
    @vite(['resources/js/app.js'])
</body>
</html>