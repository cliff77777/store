<h1>Hi {{ $user->name }}，提供您最新商品資訊</h1>

<table border="1">
    <tr>
        <th>商品名稱</th>
        <th>商品價格</th>
    </tr>
    @foreach ($merchandise_data as $merchandise)
        <tr>
            <td>
                <a href="{{ url('/merchandise' . $merchandise->id) }}">{{ $merchandise->name }}</a>
            </td>
            <td>{{ $merchandise->price }}</td>
        </tr>
    @endforeach
</table>
