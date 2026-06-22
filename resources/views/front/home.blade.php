@extends('front.layouts.app')

@section('content')

<section class="bg-[#F3EEE8] py-20">

    <div class="max-w-7xl mx-auto px-8">

        <div class="grid md:grid-cols-2 gap-12 items-center">

            <div>

                <p class="uppercase tracking-[6px] text-[#8B7355] font-semibold">
                    Fashion Collection 2026
                </p>

                <h1 class="text-6xl font-bold text-[#1F1F1F] mt-4">
                    Modern Fashion
                    <br>
                    For Everyone
                </h1>

                <p class="mt-6 text-lg text-gray-600">
                    Discover premium fashion with elegant style
                    and timeless design.
                </p>

                <a
                    href="{{ route('shop') }}"
                    class="inline-block mt-8 bg-[#8B7355] text-white px-8 py-4 rounded-lg"
                >
                    Shop Now
                </a>

            </div>

            <div>

                <img
                    src="{{ asset('storage/banner-fashion.jpg') }}"
                    class="rounded-3xl shadow-xl"
                >

            </div>

        </div>

    </div>

</section>

<section class="bg-white py-10">
    <div class="max-w-7xl mx-auto px-8">

        <div class="grid md:grid-cols-3 gap-6">

            <div class="bg-[#F3EEE8] rounded-2xl p-6 text-center">
                <div class="text-3xl">🚚</div>
                <h3 class="font-bold mt-3">
                    Gratis Ongkir
                </h3>
                <p class="text-gray-600 mt-2">
                    Seluruh Indonesia
                </p>
            </div>

            <div class="bg-[#F3EEE8] rounded-2xl p-6 text-center">
                <div class="text-3xl">💳</div>
                <h3 class="font-bold mt-3">
                    Pembayaran Aman
                </h3>
                <p class="text-gray-600 mt-2">
                    Transfer terverifikasi
                </p>
            </div>

            <div class="bg-[#F3EEE8] rounded-2xl p-6 text-center">
                <div class="text-3xl">⭐</div>
                <h3 class="font-bold mt-3">
                    Rating Tinggi
                </h3>
                <p class="text-gray-600 mt-2">
                    Kepuasan pelanggan
                </p>
            </div>

        </div>

    </div>
</section>

<section class="max-w-7xl mx-auto p-8">

    <h2 class="text-3xl font-bold mb-6">
        Best Seller 🔥
    </h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">

        @foreach($bestSellers as $product)

<div class="relative bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-xl transition">

    @if($product->image)
        <img
            src="{{ asset('storage/'.$product->image) }}"
            class="w-full h-64 object-cover"
        >
    @endif

    <div class="p-4">

        <span class="bg-orange-500 text-white px-2 py-1 rounded-full text-xs">
            🔥 BEST SELLER
        </span>

        <h3 class="font-bold text-lg mt-3">
            {{ $product->name }}
        </h3>

        <p class="text-gray-500 mt-2">
            Terjual {{ $product->order_items_sum_quantity ?? 0 }} pcs
        </p>

        @if($product->sale_price)

            <p class="text-[#8B7355] font-bold text-lg mt-2">
                Rp {{ number_format($product->sale_price) }}
            </p>

            <p class="text-gray-400 line-through text-sm">
                Rp {{ number_format($product->price) }}
            </p>

        @else

            <p class="font-bold mt-2">
                Rp {{ number_format($product->price) }}
            </p>

        @endif

        <a
            href="{{ route('product.detail', $product->slug) }}"
            class="inline-block mt-4 bg-[#8B7355] text-white px-4 py-2 rounded-lg"
        >
            Lihat Detail
        </a>

    </div>

</div>

@endforeach

    </div>

</section>

<section class="max-w-7xl mx-auto p-8">

    <h2 class="text-3xl font-bold mb-6">
        Featured Products
    </h2>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">

    @forelse($featuredProducts as $product)

        <div class="relative bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-xl transition">

            @if($product->image)

            @if($product->sale_price)

                <div class="absolute top-3 left-3 bg-red-500 text-white px-3 py-1 rounded-full text-xs font-bold">

                    -{{ round((($product->price - $product->sale_price) / $product->price) * 100) }}%

                </div>

            @endif

                <img
                    src="{{ asset('storage/' . $product->image) }}"
                    alt="{{ $product->name }}"
                    class="w-full h-64 object-cover"
                >

            @else

                <div class="h-64 bg-gray-200 flex items-center justify-center">
                    No Image
                </div>

            @endif

            <div class="p-4">

                <h3 class="font-semibold text-lg">
                    {{ $product->name }}
                </h3>

                @if($product->sale_price)

                <div class="mt-2">

                    <span class="bg-red-500 text-white text-xs px-2 py-1 rounded-full">
                        SALE
                    </span>

                    <p class="text-[#8B7355] font-bold text-lg mt-2">
                        Rp {{ number_format($product->sale_price) }}
                    </p>

                    <p class="text-gray-400 line-through text-sm">
                        Rp {{ number_format($product->price) }}
                    </p>

                </div>

            @else

                <p class="text-gray-600 mt-2">
                    Rp {{ number_format($product->price) }}
                </p>

            @endif

                <a
                    href="{{ route('product.detail', $product->slug) }}"
                    class="inline-block mt-4 bg-[#8B7355] text-white px-4 py-2 rounded-lg"
                >
                    Lihat Detail
                </a>

            </div>

        </div>

    @empty

        <p class="text-gray-500">
            Belum ada produk unggulan.
        </p>

     @endforelse

</div>

</section>

@endsection
