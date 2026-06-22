@extends('front.layouts.app')

@section('content')

<div class="max-w-6xl mx-auto p-8">

    <h1 class="text-3xl font-bold mb-6">
        My Orders
    </h1>

    <div class="space-y-4">

        @forelse($orders as $order)

            <div class="border rounded-lg p-4 bg-white">

                <h3 class="font-bold">
                    Order #{{ $order->id }}
                </h3>

                @php
                    $statusClass = 'bg-red-500';

                    if ($order->status === 'pending') {
                        $statusClass = 'bg-yellow-500';
                    } elseif ($order->status === 'processing') {
                        $statusClass = 'bg-blue-500';
                    } elseif ($order->status === 'shipped') {
                        $statusClass = 'bg-purple-500';
                    } elseif ($order->status === 'completed') {
                        $statusClass = 'bg-green-500';
                    }
                @endphp

                <span class="px-3 py-1 rounded-full text-white text-sm {{ $statusClass }}">
                    {{ ucfirst($order->status) }}
                </span>

                <p>
                    Total:
                    Rp {{ number_format($order->total) }}
                </p>

                <a
                    href="{{ route('my-orders.show', $order->id) }}"
                    class="text-blue-600"
                >
                    Lihat Detail
                </a>

                <p>
                    {{ $order->created_at->format('d M Y H:i') }}
                </p>

            </div>

        @empty

            <p>
                Belum ada pesanan.
            </p>

        @endforelse

    </div>

</div>

@endsection
