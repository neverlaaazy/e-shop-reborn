<x-main-layout 
    title="{{$product->page_title}}"
    description="{{$product->page_description}}"
    keywords="{{$product->keywords}}"
    >
    <div class="container mx-auto">
        <h2>{{$product->title}}</h2>
        <div class="border mb-4 flex showcard">
            @if($product->image_url)
                <img class="w-28 h-full aspect-1 mr-4" src="{{ $product->image_url }}"
                    alt="{{ $product->title }}">
            @endif
            <div>
                <p>{{ $product->description }}</p>
                <p>Цена: {{ $product->price}}</p>
                <p>Категория: {{ $product->category->title }}</p>
                <p>Количество: {{ $product->count }}</p>
            </div>
            <button>Купить</button>
        </div>
    </div>
</x-main-layout>