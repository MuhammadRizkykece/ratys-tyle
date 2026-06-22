@extends('front.layouts.app')

@section('content')

<div class="max-w-6xl mx-auto p-8">

    <h1 class="text-3xl font-bold mb-6">
        Order #{{ $order->id }}
    </h1>

    <div class="bg-white border rounded-lg p-6">

        <span class="
        px-3 py-1 rounded-full text-white text-sm

        @if($order->status == 'pending')
            bg-yellow-500
        @elseif($order->status == 'processing')
            bg-blue-500
        @elseif($order->status == 'shipped')
            bg-purple-500
        @elseif($order->status == 'completed')
            bg-green-500
        @else
            bg-red-500
        @endif
        ">
            {{ ucfirst($order->status) }}
        </span>

        @if($order->tracking_number)

            <div class="mt-4 p-3 bg-gray-100 rounded">

                <p class="font-semibold">
                    Nomor Resi:
                </p>

                <p class="text-blue-600 font-bold">
                    {{ $order->tracking_number }}
                </p>

            </div>

        @endif

        <p class="mt-4">
            Total:
            Rp {{ number_format($order->total) }}
        </p>

        <a
    href="{{ route('invoice.download', $order->id) }}"
    class="inline-block mt-4 bg-green-600 text-white px-5 py-3 rounded-lg hover:bg-green-700"
>
    📄 Download Invoice PDF
</a>

        {{-- @if($order->payment_status != 'paid')
    <button
        id="pay-button"
        class="mt-4 bg-[#8B7355] text-white px-6 py-3 rounded-lg hover:bg-[#6f5d46]"
    >
        Bayar Sekarang
    </button>
@endif --}}

        @if(!$order->payment_proof)

            <form
                action="{{ route('my-orders.upload-proof', $order->id) }}"
                method="POST"
                enctype="multipart/form-data"
                class="mt-4"
            >
                @csrf

                <input
                    type="file"
                    name="payment_proof"
                    required
                    class="border p-2"
                >

                <button
                    type="submit"
                    class="bg-black text-white px-4 py-2 rounded ml-2"
                >
                    Upload Bukti Transfer
                </button>
            </form>

        @endif

        @if($order->payment_proof)

            <div class="mt-4">

                <p class="font-semibold">
                    Bukti Transfer:
                </p>

                <img
                    src="{{ asset('storage/' . $order->payment_proof) }}"
                    alt="Bukti Transfer"
                    class="w-64 rounded border mt-2"
                >

            </div>

        @endif

        @if($order->tracking_number)
            <div class="bg-blue-100 p-3 rounded">
                <strong>Nomor Resi:</strong>
                {{ $order->tracking_number }}
            </div>
        @endif

    </div>

    <div class="mt-6 bg-white border rounded-lg p-6">

    <h2 class="text-xl font-bold mb-4">
        Status Pesanan
    </h2>


    <div class="space-y-4">


        {{-- Pending --}}
        <div class="flex items-center gap-3">

            <div class="
            w-4 h-4 rounded-full
            @if(in_array($order->status, [
                'pending',
                'processing',
                'shipped',
                'completed'
            ]))
                bg-green-500
            @else
                bg-gray-300
            @endif
            ">
            </div>

            <p>
                Pesanan dibuat
            </p>

        </div>


        {{-- Processing --}}
        <div class="flex items-center gap-3">

            <div class="
            w-4 h-4 rounded-full

            @if(in_array($order->status, [
                'processing',
                'shipped',
                'completed'
            ]))
                bg-green-500
            @else
                bg-gray-300
            @endif
            ">
            </div>

            <p>
                Pembayaran diterima
            </p>

        </div>


        {{-- Shipped --}}
        <div class="flex items-center gap-3">

            <div class="
            w-4 h-4 rounded-full

            @if(in_array($order->status, [
                'shipped',
                'completed'
            ]))
                bg-green-500
            @else
                bg-gray-300
            @endif
            ">
            </div>

            <p>
                Pesanan dikirim
            </p>

        </div>


        {{-- Completed --}}
        <div class="flex items-center gap-3">

            <div class="
            w-4 h-4 rounded-full

            @if($order->status == 'completed')
                bg-green-500
            @else
                bg-gray-300
            @endif
            ">
            </div>

            <p>
                Pesanan selesai
            </p>

        </div>


    </div>

</div>

        <h2 class="text-xl font-bold mb-4">
            Produk
        </h2>

        @foreach($order->items as $item)

            <div class="border rounded p-4 mb-3">

                <h3>{{ $item->product->name }}</h3>

                <p>
                    Qty: {{ $item->quantity }}
                </p>

                <p>
                    Harga:
                    Rp {{ number_format($item->price) }}
                </p>

            </div>

        @endforeach

    </div>

</div>


{{-- <script
    src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="{{ config('midtrans.client_key') }}">
</script>

<script>
document.getElementById('pay-button')?.addEventListener('click', function () {

    window.snap.pay('{{ $order->snap_token }}', {

        onSuccess: function(result) {
            window.location.reload();
        },

        onPending: function(result) {
            alert('Menunggu pembayaran');
        },

        onError: function(result) {
            alert('Pembayaran gagal');
        }

    });

});
</script> --}}

@endsection
