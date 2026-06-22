@extends('front.layouts.app')

@section('content')

<section class="max-w-7xl mx-auto p-8">

<h1 class="text-4xl font-bold mb-8">
    Shopping Cart
</h1>


@if(count($cart))


@foreach($cart as $id => $item)

<div class="flex items-center justify-between bg-white shadow rounded-xl p-4 mb-4">


<div>

<h2 class="font-bold">
    {{ $item['name'] }}
</h2>

<p class="text-sm text-gray-600">
    Ukuran: {{ $item['size'] }}
</p>

<p class="text-sm text-gray-600">
    Warna: {{ $item['color'] }}
</p>

<p>
    Rp {{ number_format($item['price']) }}
</p>

<form action="{{ route('cart.update',$id) }}" method="POST">

    @csrf
    @method('PATCH')


    <div class="flex items-center gap-3 mt-3">

        <button
        type="submit"
        name="quantity"
        value="{{ $item['quantity'] - 1 }}"
        class="px-3 py-1 bg-gray-200 rounded">
            -
        </button>


        <span>
            {{ $item['quantity'] }}
        </span>


        <button
        type="submit"
        name="quantity"
        value="{{ $item['quantity'] + 1 }}"
        class="px-3 py-1 bg-gray-200 rounded">
            +
        </button>

    </div>

</form>

</div>


<form action="{{ route('cart.remove',$id) }}" method="POST">

@csrf
@method('DELETE')

<button class="text-red-500">
Remove
</button>

</form>


</div>


@endforeach
<div class="mt-8 bg-white shadow rounded-xl p-6">

    @php
    $subtotal = $total;

    $discount = session('coupon_discount', 0);

    $discountAmount = ($subtotal * $discount) / 100;

    $grandTotal = $subtotal - $discountAmount;
@endphp

<h2 class="text-2xl font-bold">
    Total Belanja
</h2>

<p class="mt-3">
    Subtotal:
    Rp {{ number_format($subtotal) }}
</p>

@if($discount > 0)

    <p class="text-green-600">
        Diskon ({{ $discount }}%):
        - Rp {{ number_format($discountAmount) }}
    </p>

@endif

<p class="text-2xl font-bold mt-2">
    Rp {{ number_format($grandTotal) }}
</p>

    <form action="{{ route('coupon.apply') }}" method="POST" class="mt-4">
    @csrf

    <div class="flex gap-2">
        <input
            type="text"
            name="coupon_code"
            placeholder="Masukkan kode voucher"
            class="border rounded px-4 py-2 w-full"
        >

        <button class="bg-green-600 text-white px-4 py-2 rounded">
            Pakai
        </button>
    </div>

    @if(session('success'))

    <div class="mt-3 text-green-600">
        {{ session('success') }}
    </div>

@endif

@if(session('error'))

    <div class="mt-3 text-red-600">
        {{ session('error') }}
    </div>

@endif

</form>

    <a
    href="{{ route('checkout') }}"
    class="mt-5 inline-block bg-black text-white px-8 py-3 rounded-xl">

    Checkout

    </a>

</div>

@else

<p>
Keranjang masih kosong.
</p>


@endif


</section>

@endsection
