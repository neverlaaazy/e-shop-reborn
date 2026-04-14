<x-main-layout>
    <div class="container mx-auto">
        <form action="{{route('products.store')}}" method="POST">
            @csrf
            <input type="text" name="title" id="title" placeholder="Название продукта" required><br>
            <input type="number" step="any" name="price" id="price" placeholder="Цена продукта" required><br>
            <textarea name="description" id="description" placeholder="Описание продукта" required></textarea><br>
            <select name="category_id" id="category_id">
                @foreach ($categories as $category)
                <option value="{{$category->id}}">{{ $category->title }}</option>
                @endforeach
            </select><br>
            <input type="submit" value="Создать">
        </form>
    </div>
</x-main-layout>