<x-main-layout title="Категории" description="Список категорий товаров" keywords="категории, мебель, товары">
    <div class="container index-con mx-auto">
        <h2>Категории</h2>

        <div class="grid gap-4">
            @foreach ($categories as $category)
                <a href="{{ route('categories.show', $category) }}" class="block border p-4 rounded hover:bg-slate-50">
                    <h3>{{ $category->title }}</h3>
                    <p>Товаров: {{ $category->products_count }}</p>
                </a>
            @endforeach
        </div>
    </div>
</x-main-layout>
