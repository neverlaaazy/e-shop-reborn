<x-main-layout>
    <div class="container index-con mx-auto">
        <form action="{{route('products.store')}}" method="POST" class="create-form">
            @csrf
            <input type="text" name="title" id="title" placeholder="Название продукта" required><br>
            <input type="number" step="any" name="price" id="price" placeholder="Цена продукта" required><br>
            <textarea class="desc-create" name="description" id="description" placeholder="Описание продукта" required></textarea><br>
            <select name="category_id" id="category_id">
                @foreach ($categories as $category)
                <option value="{{$category->id}}">{{ $category->title }}</option>
                @endforeach
            </select><br>
            <input class="btn-create" type="submit" value="Создать">
        </form>
    </div>
</x-main-layout>