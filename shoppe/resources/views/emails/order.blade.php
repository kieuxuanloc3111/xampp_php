<h2>Xin chào {{ $user->email }}</h2>

<p>Cảm ơn bạn đã mua hàng tại shop.</p>

<table border="1" cellpadding="8" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Sản phẩm</th>
            <th>Giá</th>
            <th>Số lượng</th>
            <th>Tổng</th>
        </tr>
    </thead>
    <tbody>
        @foreach($cart as $item)
            <tr>
                <td>{{ $item['name'] }}</td>
                <td>${{ $item['price'] }}</td>
                <td>{{ $item['qty'] }}</td>
                <td>${{ $item['price'] * $item['qty'] }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<h3>Tổng tiền thanh toán: ${{ $total }}</h3>

<p>Chúng tôi sẽ liên hệ sớm để xác nhận đơn hàng.</p>
<p>Trân trọng!</p>
