@extends('front.layouts.app')

@section('content')

<section class="max-w-7xl mx-auto p-8">

    <h1 class="text-4xl font-bold mb-8">
        Wishlist
    </h1>

    @forelse($wishlists as $wishlist)

        <div class="bg-white p-4 rounded shadow mb-4">

            <h2 class="font-bold">
                {{ $wishlist->product->name }}
            </h2>

            <p>
                Rp {{ number_format($wishlist->product->price) }}
            </p>

            <a
                href="{{ route('product.detail', $wishlist->product->slug) }}"
                class="text-blue-500"
            >
                Lihat Produk
            </a>

        </div>

    @empty

        <p>Wishlist masih kosong.</p>

    @endforelse

</section>

@endsection
