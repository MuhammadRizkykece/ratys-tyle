<body>

    <div class="title">
        <h1>RATYSTYLE</h1>
        <p>Fashion Store Indonesia</p>
    </div>

    <hr>

    <p><strong>Invoice #{{ $order->id }}</strong></p>
    <p>Tanggal: {{ $order->created_at->format('d-m-Y') }}</p>
    <p>Status: {{ strtoupper($order->status) }}</p>

    <br>

    <h3>Data Customer</h3>

    <p>
        <strong>Nama:</strong>
        {{ $order->name }}
    </p>

    <p>
        <strong>Telepon:</strong>
        {{ $order->phone }}
    </p>

    <p>
        <strong>Alamat:</strong>
        {{ $order->address }}
    </p>

    <br>

    <h3>Detail Pesanan</h3>

    <table>
        <thead>
            <tr>
                <th>Produk</th>
                <th>Qty</th>
                <th>Harga</th>
                <th>Subtotal</th>
            </tr>
        </thead>

        <tbody>

            @foreach($order->items as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>
                        Rp {{ number_format($item->price,0,',','.') }}
                    </td>
                    <td>
                        Rp {{ number_format($item->price * $item->quantity,0,',','.') }}
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>

    <br>

    <h2 style="text-align:right">
        Total: Rp {{ number_format($order->total,0,',','.') }}
    </h2>

    @if($order->tracking_number)
        <p>
            <strong>No. Resi:</strong>
            {{ $order->tracking_number }}
        </p>
    @endif

    <hr>

    <p style="text-align:center">
        Terima kasih telah berbelanja di RATYSTYLE ❤️
    </p>

</body>
