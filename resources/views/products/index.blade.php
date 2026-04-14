<x-main-layout>
    <div class="container index-con mx-auto">
        <h2>Каталог товаров</h2>
        <div>
            @foreach ($categories as $category)
            <h3 class="categ-title">{{ $category->title }}</h3>
            @foreach ($category->products as $product)
            <div class="border mb-4 flex card">
                <img class="w-28 h-full aspect-1 mr-4" src="{{ Vite::asset($product->path_img) }}"
                    alt="{{ $product->title }}">
                <div>
                    <a href="{{route('products.show',['product'=>$product])}}">
                        <h4>{{ $product->title }}</h4>
                    </a>
                    <p>{{ $product->description }}</p>
                    <p>{{ $product->price}}</p>
                    <p>{{ $product->category->title}}</p>
                </div>
                <div class="ml-auto">
                    <a href="{{ route('products.edit',['product'=>$product]) }}">Редактировать</a>
                    <form action="{{ route('products.destroy',['product'=>$product]) }}" method="POST">
                        @csrf
                        @method('delete')
                        <input type="submit" value="Удалить">
                    </form>
                </div>


            </div>
            @endforeach
            @endforeach
        </div>
    </div>
</x-main-layout>