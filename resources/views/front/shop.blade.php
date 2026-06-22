@extends('front.layouts.app')

@section('content')

<section class="max-w-7xl mx-auto p-8" x-data="{ openFilter:false }">

<div class="flex justify-between items-center mb-8">

    <div>
        <h1 class="text-3xl font-bold">
            Semua Produk
        </h1>

        <p class="text-gray-500 mt-1">
            Temukan fashion terbaik pilihan RATYS'TYLE
        </p>

        <p class="text-sm text-gray-400 mt-2">
            {{ $products->total() }} produk ditemukan
        </p>

    </div>

    <button
        @click="openFilter = true"
        type="button"
        class="flex items-center gap-2 bg-white border border-gray-200 px-4 py-2 rounded-xl shadow-sm hover:shadow-md transition"
    >
        ⚙️ Filter
    </button>

</div>

{{-- Modal Filter --}}
<div
    x-show="openFilter"
    x-transition
    class="fixed inset-0 bg-black/40 z-50 flex justify-end"
>

    <div class="bg-white w-80 h-full p-6">

        <div class="flex justify-between items-center mb-5">
            <h3 class="font-bold text-xl">
                Filter
            </h3>

            <button
                @click="openFilter = false"
                type="button"
            >
                ✕
            </button>
        </div>

        {{-- Form Filter --}}
        <form method="GET">

    <select
        name="category"
        class="w-full border rounded-xl p-3 mb-4"
    >
        <option value="">Semua Kategori</option>

        @foreach($categories as $category)
            <option
                value="{{ $category->id }}"
                @selected(request('category') == $category->id)
            >
                {{ $category->name }}
            </option>
        @endforeach
    </select>

    <select
        name="brand"
        class="w-full border rounded-xl p-3 mb-4"
    >
        <option value="">Semua Brand</option>

        @foreach($brands as $brand)
            <option
                value="{{ $brand->id }}"
                @selected(request('brand') == $brand->id)
            >
                {{ $brand->name }}
            </option>
        @endforeach
    </select>

    <select
        name="sort"
        class="w-full border rounded-xl p-3 mb-4"
    >
        <option value="">Urutkan</option>
        <option value="low">Harga Termurah</option>
        <option value="high">Harga Termahal</option>
    </select>

    <button
        class="w-full bg-[#8B7355] text-white py-3 rounded-xl"
    >
        Terapkan Filter
    </button>

</form>
    </div>

</div>

<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

        @forelse($products as $product)

                <div
                    class="group relative bg-white rounded-3xl overflow-hidden
                    border border-gray-100 hover:shadow-2xl
                    hover:-translate-y-1 transition duration-300"
                >

                    @auth
<form
    action="{{ route('wishlist.add', $product->id) }}"
    method="POST"
    class="absolute top-3 right-3 z-10"
>
    @csrf

    <button
        class="w-10 h-10 bg-white/90 backdrop-blur rounded-full shadow-lg
        flex items-center justify-center
        hover:bg-red-50 hover:text-red-500 transition"
    >
        ♡
    </button>
</form>
@endauth

                @if($product->image)

@if($product->sale_price)

    @php
        $discount = round(
            (($product->price - $product->sale_price) / $product->price) * 100
        );
    @endphp

    <div class="absolute top-3 left-3 bg-red-500 text-white px-3 py-1 rounded-full text-xs font-bold">
        -{{ $discount }}%
    </div>

@else
    <div class="absolute top-3 left-3 bg-[#8B7355] text-white px-3 py-1 rounded-full text-xs">
        NEW
    </div>
@endif

                    <img
                        src="{{ asset('storage/'.$product->image) }}"
                        class="w-full h-72 object-cover group-hover:scale-105 transition duration-500"
                    >

                @else

                    <div class="h-64 bg-gray-200 flex items-center justify-center">
                        No Image
                    </div>

                @endif


                <div class="p-4">

                    <h2 class="font-semibold text-base line-clamp-2 min-h-[48px]">
                        {{ $product->name }}
                    </h2>

                    @if($product->reviews_avg_rating)
                        <p class="text-yellow-500 mt-1">
                            ⭐ {{ number_format($product->reviews_avg_rating, 1) }}
                            <span class="text-gray-500 text-sm">
                                ({{ $product->reviews()->count() }} review)
                            </span>
                        </p>
                    @endif


                    @if($product->sale_price)

    <p class="text-[#8B7355] font-bold text-lg mt-2">
        Rp {{ number_format($product->sale_price) }}
    </p>

    <p class="text-gray-400 line-through text-sm">
        Rp {{ number_format($product->price) }}
    </p>

@else

    <p class="text-gray-600 mt-2">
        Rp {{ number_format($product->price) }}
    </p>

@endif


                    <a
                        href="{{ route('product.detail', $product->slug) }}"
                        class="block mt-4 text-center bg-[#8B7355] text-white py-3 rounded-xl hover:bg-[#6D5B45] transition"
                    >
                        Lihat Produk
                    </a>

                </div>

            </div>


        @empty

<div class="col-span-full text-center py-20">
    <div class="text-6xl mb-4">🛍️</div>

    <h3 class="text-xl font-semibold">
        Produk tidak ditemukan
    </h3>

    <p class="text-gray-500 mt-2">
        Coba ubah filter atau kata kunci pencarian.
    </p>
</div>

@endforelse


    </div>


    <div class="mt-8">
        {{ $products->links() }}
    </div>


</section>

@endsection
