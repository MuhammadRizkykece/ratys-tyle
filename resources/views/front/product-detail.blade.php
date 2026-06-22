@extends('front.layouts.app')

@section('content')

<section class="max-w-7xl mx-auto p-8">

    <div class="mb-6 text-sm text-gray-500">
    <a href="{{ route('home') }}" class="hover:text-[#8B7355]">
        Home
    </a>
    /
    <a href="{{ route('shop') }}" class="hover:text-[#8B7355]">
        Shop
    </a>
    /
    <span class="text-black">
        {{ $product->name }}
    </span>
</div>

    <div class="grid lg:grid-cols-2 gap-12">

        <div>

            <div>
  @php
    $mainImage = $product->images->first();
@endphp

@if($mainImage)
    <img
        id="main-image"
        src="{{ asset('storage/'.$mainImage->image) }}"
        class="w-full h-[650px] object-cover rounded-3xl shadow-xl mb-4"
    >
@elseif($product->image)
    <img
        id="main-image"
        src="{{ asset('storage/'.$product->image) }}"
        class="w-full h-[650px] object-cover rounded-3xl shadow-xl mb-4"
    >
@endif

    <div class="grid grid-cols-4 gap-2">
    @foreach($product->images as $image)
    <img
        src="{{ asset('storage/'.$image->image) }}"
        onclick="changeImage(this)"
        class="h-24 w-full object-cover rounded-xl border-2 border-transparent hover:border-[#8B7355] cursor-pointer transition"    >
@endforeach
</div>
</div>

        </div>


        <div>
            <div class="bg-white rounded-3xl shadow-lg p-8">

            <h1 class="text-4xl font-bold">
                {{ $product->name }}
            </h1>

            @if($product->reviews_avg_rating)
                <p class="text-yellow-500 mt-2">
                    ⭐ {{ number_format($product->reviews_avg_rating, 1) }}/5
                    ({{ $product->reviews->count() }} review)
                </p>
            @endif

            @if($product->sale_price)

                <span class="bg-red-500 text-white px-3 py-1 rounded-full text-xs font-bold">
                    SALE
                    -{{ round((($product->price - $product->sale_price) / $product->price) * 100) }}%
                </span>

                <p class="text-3xl font-bold text-[#8B7355] mt-3">
                    Rp {{ number_format($product->sale_price) }}
                </p>

                <p class="text-gray-400 line-through">
                    Rp {{ number_format($product->price) }}
                </p>

                        <div class="flex gap-4 mt-4 text-sm">

    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full">
        ✓ Stok Tersedia
    </span>

    <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full">
        🚚 Gratis Ongkir
    </span>

</div>

            @else

                <p class="text-3xl font-bold">
                    Rp {{ number_format($product->price) }}
                </p>

            @endif


            <p class="mt-6">
                {{ $product->description }}
            </p>


            <form action="{{ route('cart.add') }}" method="POST">
            @csrf

            <input
                type="hidden"
                name="product_id"
                value="{{ $product->id }}"
            >

            {{-- Warna --}}
            <div class="mt-6">
                <label class="font-semibold">Warna</label>

                <select
                    name="color"
                    class="w-full border rounded p-2 mt-2"
                    required
                >
                    <option value="">Pilih Warna</option>

                    @foreach($variants->unique('color') as $variant)
                        <option value="{{ $variant->color }}">
                            {{ $variant->color }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Ukuran --}}
            <div class="mt-4">
                <label class="font-semibold">Ukuran</label>

                <select
                    name="size"
                    class="w-full border rounded p-2 mt-2"
                    required
                >
                    <option value="">Pilih Ukuran</option>

                    @foreach($variants->unique('size') as $variant)
                        <option value="{{ $variant->size }}">
                            {{ $variant->size }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Jumlah --}}
            <div class="mt-4">
                <label class="font-semibold">Jumlah</label>

                <input
                    type="number"
                    name="quantity"
                    value="1"
                    min="1"
                    class="w-24 border rounded p-2 mt-2"
                >
            </div>

   <div class="flex gap-3 mt-6">

    <button
        class="flex-1 bg-[#8B7355] text-white py-4 rounded-xl font-semibold hover:bg-[#705c45] transition"
    >
        🛒 Add To Cart
    </button>

</form>

@auth

<form
    action="{{ route('wishlist.add', $product->id) }}"
    method="POST"
    class="flex-1"
>
    @csrf

    <button
        class="w-full border border-[#8B7355] text-[#8B7355]
        py-4 rounded-xl hover:bg-[#8B7355]
        hover:text-white transition"
    >
        ❤️ Wishlist
    </button>

</form>

@endauth

</div>

</div>
<hr class="my-10">

<h2 class="text-2xl font-bold mb-6">
    Customer Reviews
</h2>

@auth

<form
    action="{{ route('product.review', $product) }}"
    method="POST"
    class="bg-white shadow rounded-xl p-6 mb-8"
>
    @csrf

    <div>
        <label class="font-semibold">
            Rating
        </label>

        <select
            name="rating"
            class="w-full border rounded p-2 mt-2"
            required
        >
            <option value="">Pilih Rating</option>
            <option value="5">⭐⭐⭐⭐⭐</option>
            <option value="4">⭐⭐⭐⭐</option>
            <option value="3">⭐⭐⭐</option>
            <option value="2">⭐⭐</option>
            <option value="1">⭐</option>
        </select>
    </div>

    <div class="mt-4">
        <label class="font-semibold">
            Ulasan
        </label>

        <textarea
            name="comment"
            rows="4"
            class="w-full border rounded p-2 mt-2"
            required
        ></textarea>
    </div>

    <button
        class="mt-4 bg-black text-white px-6 py-2 rounded"
    >
        Kirim Review
    </button>

</form>

@else

<p class="mb-6 text-gray-500">
    Login terlebih dahulu untuk memberikan review.
</p>

@endauth

@forelse($product->reviews as $review)

<div class="bg-white border border-gray-100 shadow-sm rounded-2xl p-5 mb-4">

    <h3 class="font-bold">
        {{ $review->user->name }}
    </h3>

    <p class="text-yellow-500 mt-1">
        {{ str_repeat('⭐', $review->rating) }}
    </p>

    <p class="mt-3">
        {{ $review->comment }}
    </p>

</div>

@empty

<p>
    Belum ada review.
</p>

@endforelse

<hr class="my-10">

<h2 class="text-3xl font-bold mb-6">
    Produk Terkait
</h2>

<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

@foreach($relatedProducts as $item)

<a href="{{ route('product.detail', $item->slug) }}"
   class="group bg-white rounded-3xl border border-gray-100 overflow-hidden hover:shadow-xl hover:-translate-y-1 transition">

    @if($item->image)
        <img
            src="{{ asset('storage/'.$item->image) }}"
            class="w-full h-52 object-cover group-hover:scale-105 transition duration-500"
        >
    @endif

    <div class="p-4">

        <h3 class="font-bold">
            {{ $item->name }}
        </h3>

        @if($item->sale_price)

            <div class="mt-2">

                <span class="bg-red-500 text-white px-2 py-1 rounded-full text-xs font-bold">
                    SALE
                    -{{ round((($item->price - $item->sale_price) / $item->price) * 100) }}%
                </span>

                <p class="text-[#8B7355] font-bold text-lg mt-2">
                    Rp {{ number_format($item->sale_price) }}
                </p>

                <p class="text-gray-400 line-through text-sm">
                    Rp {{ number_format($item->price) }}
                </p>

            </div>

        @else

            <p class="mt-2 font-semibold">
                Rp {{ number_format($item->price) }}
            </p>

        @endif

    </div>

</a>

@endforeach
</div>

</section>

<script>
function changeImage(element) {
    document.getElementById('main-image').src = element.src;
}
</script>

@endsection
