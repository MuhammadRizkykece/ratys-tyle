@extends('front.layouts.app')

@section('content')

<section class="max-w-7xl mx-auto p-8">

    <h1 class="text-4xl font-bold mb-8">
        Category
    </h1>


    <div class="grid grid-cols-2 gap-8">

        @foreach($categories as $category)

        <a href="{{ route('category.show', $category->slug) }}"
           class="bg-white rounded-xl shadow overflow-hidden">


            @if($category->image)

            <img
                src="{{ asset('storage/'.$category->image) }}"
                class="w-full h-64 object-cover"
            >

            @endif


            <div class="p-6">

                <h2 class="text-2xl font-bold">
                    {{ $category->name }}
                </h2>

                <p class="mt-2 text-gray-600">
                    {{ $category->description }}
                </p>

            </div>


        </a>

        @endforeach

    </div>


</section>

@endsection
