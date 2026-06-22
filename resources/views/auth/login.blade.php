<x-guest-layout>

    <div class="min-h-screen grid lg:grid-cols-2">

        {{-- KIRI - BANNER --}}
        <div class="hidden lg:block relative">

            <img
                src="{{ asset('storage/images/login-banner.jpg') }}"
                alt="Login Banner"
                class="w-full h-screen object-cover"
            >

            <div class="absolute inset-0 bg-black/30"></div>

            <div class="absolute bottom-16 left-12 text-white">
                <h1 class="text-5xl font-bold mb-4">
                    RATYS'TYLE
                </h1>

                <p class="text-lg max-w-md">
                    Modern fashion brand that combines comfort,
                    elegance, and timeless style for everyone.
                </p>
            </div>

        </div>

        {{-- KANAN - FORM LOGIN --}}
        <div class="flex items-center justify-center bg-[#F8F5F1] p-8">

            <div class="w-full max-w-md bg-white rounded-3xl shadow-xl p-8">

                <h2 class="text-3xl font-bold mb-2">
                    Welcome Back
                </h2>

                <p class="text-gray-500 mb-6">
                    Login untuk melanjutkan belanja
                </p>

                <x-auth-session-status
                    class="mb-4"
                    :status="session('status')"
                />

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    {{-- Email --}}
                    <div>
                        <x-input-label
                            for="email"
                            :value="__('Email')"
                        />

                        <x-text-input
                            id="email"
                            class="block mt-2 w-full"
                            type="email"
                            name="email"
                            :value="old('email')"
                            required
                            autofocus
                        />

                        <x-input-error
                            :messages="$errors->get('email')"
                            class="mt-2"
                        />
                    </div>

                    {{-- Password --}}
                    <div class="mt-4">

                        <x-input-label
                            for="password"
                            :value="__('Password')"
                        />

                        <x-text-input
                            id="password"
                            class="block mt-2 w-full"
                            type="password"
                            name="password"
                            required
                        />

                        <x-input-error
                            :messages="$errors->get('password')"
                            class="mt-2"
                        />
                    </div>

                    {{-- Remember --}}
                    <div class="flex justify-between items-center mt-4">

                        <label class="flex items-center gap-2">
                            <input
                                type="checkbox"
                                name="remember"
                                class="rounded"
                            >
                            <span class="text-sm text-gray-600">
                                Remember me
                            </span>
                        </label>

                        @if (Route::has('password.request'))
                            <a
                                href="{{ route('password.request') }}"
                                class="text-sm text-[#8B7355] hover:underline"
                            >
                                Forgot Password?
                            </a>
                        @endif

                    </div>

                    {{-- Login Button --}}
                    <button
                        type="submit"
                        class="w-full mt-6 bg-[#8B7355] hover:bg-[#705c45]
                        text-white font-semibold py-3 rounded-xl transition"
                    >
                        Log In
                    </button>

                    {{-- Divider --}}
                    <div class="flex items-center my-6">
                        <div class="flex-1 h-px bg-gray-200"></div>
                        <span class="px-3 text-gray-400 text-sm">
                            ATAU
                        </span>
                        <div class="flex-1 h-px bg-gray-200"></div>
                    </div>

                    {{-- Google Login --}}
                    <a
                        href="{{ route('google.login') }}"
                        class="w-full flex justify-center items-center gap-3 border
                        py-3 rounded-xl hover:bg-gray-50 transition"
                    >
                        <span>🔵</span>
                        Login dengan Google
                    </a>

                    <div class="mt-6 text-center">
                        <p class="text-gray-500">
                            Belum punya akun?
                            <a
                                href="{{ route('register') }}"
                                class="text-[#8B7355] font-semibold hover:underline"
                            >
                                Daftar Sekarang
                            </a>
                        </p>
                    </div>

                </form>

            </div>

        </div>

    </div>

</x-guest-layout>
