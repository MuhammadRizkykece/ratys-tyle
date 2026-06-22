@extends('front.layouts.app')

@section('content')

<section class="max-w-5xl mx-auto p-8">

    <h1 class="text-4xl font-bold mb-8">
        Checkout
    </h1>


    <div class="grid grid-cols-2 gap-8">


        {{-- FORM CUSTOMER --}}

        <div class="bg-white shadow rounded-xl p-6">


            <h2 class="text-xl font-bold mb-5">
                Data Pengiriman
            </h2>


            <form action="{{ route('checkout.store') }}" method="POST">

                @csrf


                <div class="mb-4">

                    <label class="block mb-2">
                        Nama
                    </label>

                    <input
                    type="text"
                    name="name"
                    class="w-full border rounded p-3"
                    required>

                </div>



                <div class="mb-4">

                    <label class="block mb-2">
                        Nomor HP
                    </label>

                    <input
                    type="text"
                    name="phone"
                    class="w-full border rounded p-3"
                    required>

                </div>



                <div class="mb-4">

                    <label class="block mb-2">
                        Alamat
                    </label>

                    <textarea
                    name="address"
                    class="w-full border rounded p-3"
                    required></textarea>

                </div>



                <button
                class="bg-black text-white px-6 py-3 rounded-xl">

                    Pesan Sekarang

                </button>


            </form>


        </div>



        {{-- SUMMARY --}}

        <div class="bg-white shadow rounded-xl p-6">


            <h2 class="text-xl font-bold mb-5">
                Ringkasan Pesanan
            </h2>



            @foreach($cart as $item)


            <div class="flex justify-between mb-4">

                <div>

                    <p class="font-semibold">
                        {{ $item['name'] }}
                    </p>


                    <p>
                        Qty: {{ $item['quantity'] }}
                    </p>

                </div>


                <p>
                    Rp {{ number_format($item['price'] * $item['quantity']) }}
                </p>


            </div>


            @endforeach



            <hr class="my-5">



            <div class="flex justify-between text-xl font-bold">

                <span>
                    Total
                </span>


                <span>
                    Rp {{ number_format($total) }}
                </span>

            </div>


        </div>


    </div>


</section>


@endsection
