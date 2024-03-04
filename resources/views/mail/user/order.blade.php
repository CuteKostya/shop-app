<x-mail::message>

    <div> О пользователе</div>
    <p>id: {{$user->id}}</p>
    <p>name: {{$user->name}}</p>
    <p>email: {{$user->email}}</p>
    <p>admin: {{$user->admin}}</p>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Наименование товара</th>
            <th scope="col">Цена</th>
            <th scope="col">Количество</th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
            <tr>
                <td>
                    {{ $product->id}}
                </td>
                <td>
                {{ $product->name}}
                <td>
                    {{ $product->price}}
                </td>
                <td>
                    {{ $product->count}}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

</x-mail::message>
