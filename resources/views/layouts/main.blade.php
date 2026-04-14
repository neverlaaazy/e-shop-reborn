<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <meta name="keywords" content="{{ $keywords }}">
    <meta name="description" content="{{ $description }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <header class="flex justify-between">
        <div class="container">
            <div>
                <a href="{{route('products.index')}}"><i class="bi bi-box-fill site-icon"></i></a>
                <h1 class="site-name"><a href="{{route('products.index')}}">Интернет-магазин</a></h1>
            </div>
            <nav>
                <ul class="flex gap-4 main-menu">
                    <li><a href="{{route('products.index')}}">Главная</a></li>
                    <li><a href="{{route('products.index')}}">Каталог</a></li>
                    <li><a href="">Контакты</a></li>
                </ul>
            </nav>
            <div>
                <input class="search-input" type="text" placeholder="Поиск">
                <button class="search-button"><i class="bi bi-search"></i></button>
            </div>
            <nav>
                <ul class="flex gap-4 create-card">
                    <li><a href="{{route('products.create')}}">Создать продукт</a></li>
                </ul>
            </nav>
            <button class="trash-button"><i class="bi bi-trash-fill"></i></button>
        </div>
    </header>
    <main>
        {{ $slot }}
    </main>
    <footer>
        <div class="container">
            <p>&copy;Шаповалов Сергей Алексаднрович, ПИ-232. МИДиС, г.Челябинск</p>
        </div>
    </footer>
</body>

</html>