<x-guest-layout>

<div class="min-h-screen grid lg:grid-cols-2">

    {{-- Banner --}}
    <div class="hidden lg:block relative">

        <img
            src="{{ asset('storage/images/login-banner.jpg') }}"
            class="w-full h-screen object-cover"
        >

        <div class="absolute inset-0 bg-black/30"></div>

        <div class="absolute bottom-16 left-12 text-white">
            <h1 class="text-5xl font-bold mb-4">
                RATYS'TYLE
            </h1>

            <p class="text-lg max-w-md">
                Join our fashion community and discover your style.
            </p>
        </div>

    </div>

    {{-- Register Form --}}
    <div class="flex items-center justify-center bg-[#F8F5F1] p-8">

        <div class="w-full max-w-md bg-white rounded-3xl shadow-xl p-8">

            <h2 class="text-3xl font-bold mb-2">
                Create Account
            </h2>

            <p class="text-gray-500 mb-6">
                Daftar untuk mulai berbelanja
            </p>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                {{-- Nama --}}
                <div>
                    <x-input-label for="name" value="Nama" />
                    <x-text-input
                        id="name"
                        class="block mt-2 w-full"
                        type="text"
                        name="name"
                        :value="old('name')"
                        required
                    />
                </div>

                {{-- Email --}}
                <div class="mt-4">
                    <x-input-label for="email" value="Email" />
                    <x-text-input
                        id="email"
                        class="block mt-2 w-full"
                        type="email"
                        name="email"
                        :value="old('email')"
                        required
                    />
                </div>

                {{-- Password --}}
                <div class="mt-4">
                    <x-input-label for="password" value="Password" />
                    <x-text-input
                        id="password"
                        class="block mt-2 w-full"
                        type="password"
                        name="password"
                        required
                    />
                </div>

                {{-- Confirm Password --}}
                <div class="mt-4">
                    <x-input-label
                        for="password_confirmation"
                        value="Konfirmasi Password"
                    />
                    <x-text-input
                        id="password_confirmation"
                        class="block mt-2 w-full"
                        type="password"
                        name="password_confirmation"
                        required
                    />
                </div>

                <button
                    type="submit"
                    class="w-full mt-6 bg-[#8B7355] hover:bg-[#705c45]
                    text-white py-3 rounded-xl font-semibold"
                >
                    Register
                </button>

                <p class="text-center text-sm text-gray-500 mt-5">
                    Sudah punya akun?
                    <a
                        href="{{ route('login') }}"
                        class="text-[#8B7355] font-semibold"
                    >
                        Login
                    </a>
                </p>

            </form>

        </div>

    </div>

</div>

</x-guest-layout>
