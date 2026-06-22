<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice</title>

    <style>
        body{
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color:#333;
        }

        .header{
            text-align:center;
            margin-bottom:20px;
        }

        .title{
            font-size:24px;
            font-weight:bold;
        }

        .section{
            margin-top:20px;
        }

        table{
            width:100%;
            border-collapse:collapse;
            margin-top:10px;
        }

        table th,
        table td{
            border:1px solid #ddd;
            padding:8px;
        }

        table th{
            background:#f5f5f5;
        }

        .total{
            text-align:right;
            margin-top:15px;
            font-size:16px;
            font-weight:bold;
        }

        .footer{
            margin-top:30px;
            text-align:center;
            color:#777;
        }
    </style>
</head>
<body>

    <div class="header">
        <div class="title">RATYSTYLE</div>
        <p>Fashion Store Indonesia</p>
    </div>

    <hr>

    <h2>INVOICE</h2>

    <table>
        <tr>
            <td>Invoice ID</td>
            <td>INV-{{ date('Y') }}-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</td>
        </tr>

        <tr>
            <td>Order ID</td>
            <td>#{{ $order->id }}</td>
        </tr>

        <tr>
            <td>Tanggal</td>
            <td>{{ $order->created_at->format('d-m-Y H:i') }}</td>
        </tr>

        <tr>
            <td>Status Pesanan</td>
            <td>{{ strtoupper($order->status) }}</td>
        </tr>

        <tr>
            <td>Status Pembayaran</td>
            <td>{{ strtoupper($order->payment_status ?? 'pending') }}</td>
        </tr>
    </table>

    <div class="section">
        <h3>Data Customer</h3>

        <table>
            <tr>
                <td>Nama</td>
                <td>{{ $order->name }}</td>
            </tr>

            <tr>
                <td>Email</td>
                <td>{{ $order->user?->email }}</td>
            </tr>

            <tr>
                <td>Telepon</td>
                <td>{{ $order->phone }}</td>
            </tr>

            <tr>
                <td>Alamat</td>
                <td>{{ $order->address }}</td>
            </tr>

            @if($order->tracking_number)
            <tr>
                <td>Nomor Resi</td>
                <td>{{ $order->tracking_number }}</td>
            </tr>
            @endif
        </table>
    </div>

    <div class="section">
        <h3>Detail Produk</h3>

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
                    <td>
                        {{ $item->product->name }}<br>
                        Size: {{ $item->size }} |
                        Color: {{ $item->color }}
                    </td>

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

        <div class="total">
            TOTAL PEMBAYARAN :
            Rp {{ number_format($order->total,0,',','.') }}
        </div>
    </div>

    <div class="footer">
        <p>Terima kasih telah berbelanja di RATYSTYLE ❤️</p>
        <p>Fashion Store Indonesia</p>
        <p>Invoice dibuat otomatis oleh sistem.</p>
    </div>

</body>
</html>
