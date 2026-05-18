<x-main-layout title="Каталог товаров" description="Полный каталог товаров магазина" keywords="каталог, товары, мебель">
    <div class="container index-con mx-auto">
        <h2>Каталог товаров</h2>

        <div class="categories-menu mb-6">
            <div class="flex flex-wrap gap-3">
                @foreach ($categories as $category)
                    <a href="{{ route('categories.show', $category) }}" class="px-4 py-2 bg-slate-100 rounded hover:bg-slate-200 transition">
                        {{ $category->title }}
                        @if($category->products->count())
                            ({{ $category->products->count() }})
                        @endif
                    </a>
                @endforeach
            </div>
        </div>

        <div>
            @foreach ($categories as $category)
            <h3 class="categ-title" id="category-{{ $category->id }}">{{ $category->title }}</h3>
            @foreach ($category->products as $product)
            <div class="border mb-4 flex card">
                @if($product->image_url)
                    <img class="w-28 h-full aspect-1 mr-4" src="{{ $product->image_url }}"
                        alt="{{ $product->title }}">
                @endif
                <div>
                    <a href="{{route('products.show',['product'=>$product])}}">
                        <h4>{{ $product->title }}</h4>
                    </a>
                    <p>{{ $product->description }}</p>
                    <p>{{ $product->price}}</p>
                    <p>{{ $product->category->title}}</p>
                </div>
                <div class="ml-auto manipulator-div">
                    <a class="watch-card manipulator-card" href="{{route('products.show',['product'=>$product])}}">Посмотреть</a>
                    <a class="edit-card manipulator-card" href="{{ route('products.edit',['product'=>$product]) }}">Редактировать</a>
                    <form class="form-delete manipulator-card" action="{{ route('products.destroy',['product'=>$product]) }}" method="POST">
                        @csrf
                        @method('delete')
                        <input class="delete-card" type="submit" value="Удалить">
                    </form>
                </div>


            </div>
            @endforeach
            @endforeach
        </div>
    </div>
</x-main-layout>