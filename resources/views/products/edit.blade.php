<x-main-layout>
    <div class="container mx-auto">
        <form class="edit-form" method="POST" action="{{ route('products.update',['product'=>$product]) }}">
            @csrf
            @method('put')
            <label for="title">Название продукта</label><br>
            <input type="text" name="title" id="title" value="{{ $product->title }}" required><br>
            <label for="price">Цена продукта</label><br>
            <input type="number" step="any" name="price" id="price" value="{{ $product->price }}" required><br>
            <label for="description">Описание продукта</label><br>
            <textarea class="desc-update" name="description" id="description" required>{{ $product->description }}</textarea><br>
            <label for="category_id">Категория продукта</label><br>
            <select name="category_id" id="category_id">
                @foreach ($categories as $category)
                <option value="{{$category->id}}" {{$category->id == $product->category_id ? 'selected' : ''}}
                    >
                    {{ $category->title }}
                </option>
                @endforeach
            </select><br>

            <input class="btn-edit" type="submit" value="Обновить">
        </form>
    </div>
</x-main-layout>