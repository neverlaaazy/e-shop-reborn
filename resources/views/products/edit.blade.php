<x-main-layout title="Редактировать продукт {{ $product->title }}" description="Редактирование продукта {{ $product->title }}" keywords="редактировать продукт, изменить товар">
    <div class="container mx-auto">
        <form class="edit-form" method="POST" action="{{ route('products.update',['product'=>$product]) }}" enctype="multipart/form-data">
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

            @if($product->image_url)
                <div class="mb-4">
                    <img class="w-28 h-full aspect-1 mr-4" src="{{ $product->image_url }}" alt="Текущее изображение {{ $product->title }}">
                </div>
            @endif

            <label for="path_img">Поменять изображение</label><br>
            <input type="file" name="path_img" id="path_img" accept="image/*"><br>

            <input class="btn-edit" type="submit" value="Обновить">
        </form>
    </div>
</x-main-layout>