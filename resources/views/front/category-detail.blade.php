@extends('front.layouts.app')

@section('content')

<section class="max-w-7xl mx-auto p-8">

    <h1 class="text-4xl font-bold mb-2">
        {{ $category->name }}
    </h1>

    <p class="text-gray-600 mb-8">
        {{ $category->description }}
    </p>


    <div class="grid grid-cols-4 gap-6">


        @forelse($products as $product)


        <div class="bg-white rounded-xl shadow overflow-hidden">


            @if($product->image)

            <img
                src="{{ asset('storage/'.$product->image) }}"
                class="w-full h-64 object-cover"
            >

            @endif


            <div class="p-4">

                <h2 class="font-bold text-lg">
                    {{ $product->name }}
                </h2>


                <p class="mt-2">
                    Rp {{ number_format($product->price) }}
                </p>


                <a
                href="{{ route('product.detail',$product->slug) }}"
                class="inline-block mt-4 bg-black text-white px-4 py-2 rounded">
                    Detail
                </a>

            </div>


        </div>


        @empty

        <p>
            Belum ada produk.
        </p>

        @endforelse


    </div>

</section>


@endsection
