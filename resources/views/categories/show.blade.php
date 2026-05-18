<x-main-layout title="Категория: {{ $category->title }}" description="Товары категории {{ $category->title }}" keywords="категория, {{ $category->title }}, мебель">
    <div class="container index-con mx-auto">
        <h2>Категория: {{ $category->title }}</h2>

        <div class="mb-6">
            <a href="{{ route('categories.index') }}" class="px-4 py-2 bg-slate-100 rounded hover:bg-slate-200 transition">
                Вернуться к категориям
            </a>
        </div>

        @if($category->products->isEmpty())
            <p>Товары в этой категории отсутствуют.</p>
        @else
            <div class="grid gap-4">
                @foreach ($category->products as $product)
                    <div class="border mb-4 flex card">
                        @if($product->image_url)
                            <img class="w-28 h-full aspect-1 mr-4" src="{{ $product->image_url }}" alt="{{ $product->title }}">
                        @endif
                        <div>
                            <a href="{{ route('products.show', ['product' => $product]) }}">
                                <h4>{{ $product->title }}</h4>
                            </a>
                            <p>{{ $product->description }}</p>
                            <p>{{ $product->price }}</p>
                            <p>{{ $product->category->title }}</p>
                        </div>
                        <div class="ml-auto manipulator-div">
                            <a class="watch-card manipulator-card" href="{{ route('products.show', ['product' => $product]) }}">Посмотреть</a>
                            <a class="edit-card manipulator-card" href="{{ route('products.edit', ['product' => $product]) }}">Редактировать</a>
                            <form class="form-delete manipulator-card" action="{{ route('products.destroy', ['product' => $product]) }}" method="POST">
                                @csrf
                                @method('delete')
                                <input class="delete-card" type="submit" value="Удалить">
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-main-layout>
