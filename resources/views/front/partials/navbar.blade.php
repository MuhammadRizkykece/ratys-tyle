<nav
    x-data="{
        open: false,
        profileOpen: false
    }"
    class="sticky top-0 z-50 bg-[#FAF8F5]/90 backdrop-blur-md border-b border-[#E8E2DA] shadow-sm"
>
    <div class="max-w-7xl mx-auto px-8 py-5 flex items-center justify-between">

        {{-- Logo --}}
        <a href="/" class="flex items-center gap-3 mr-6">
            <img
                src="{{ asset('storage/ratystyle-logo.png') }}"
                class="h-10 w-auto"
                alt="RATYS'TYLE"
            >

            <span class="text-2xl font-bold tracking-wider text-[#1F1F1F]">
                RATYS'TYLE
            </span>
        </a>

        <button
    @click="open = !open"
    class="md:hidden text-2xl"
>
    ☰
</button>

        {{-- Menu Kiri --}}
        <div class="hidden md:flex items-center gap-8 ml-6">
            <a href="/" class="hover:text-[#8B7355] transition">
                Home
            </a>

            <a href="{{ route('shop') }}" class="hover:text-[#8B7355] transition">
                Shop
            </a>

            <a href="{{ route('category') }}" class="hover:text-[#8B7355] transition">
                Category
            </a>

        </div>

<div class="hidden lg:flex flex-1 justify-center px-8">

    <form action="{{ route('shop') }}" method="GET" class="w-full max-w-md">

        <input
            type="text"
            name="search"
            placeholder="Cari produk..."
            value="{{ request('search') }}"
            class="w-full border rounded-full px-5 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-[#8B7355]"
        >

    </form>

</div>

<a href="{{ route('cart') }}"
   class="relative hidden md:flex items-center justify-center text-xl hover:text-[#8B7355] transition mr-6">
    🛒

    @if($cartCount > 0)
        <span
            class="absolute -top-2 -right-3 min-w-[18px] h-[18px]
                   bg-red-500 text-white text-[10px]
                   rounded-full flex items-center justify-center"
        >
            {{ $cartCount }}
        </span>
    @endif
</a>

        {{-- User Menu --}}
        <div class="hidden md:flex items-center gap-4 ml-6">
            @auth

                <span class="text-sm text-gray-600 max-w-[160px] truncate">
                    Hi, <strong>{{ auth()->user()->name }}</strong>
                </span>

                <div class="relative">

    <button
    @click="profileOpen = !profileOpen"
    class="w-10 h-10 rounded-full bg-[#8B7355] text-white
           flex items-center justify-center font-bold
           hover:bg-[#6D5B45] transition"
>
    {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
</button>

    <div
        x-show="profileOpen"
        @click.away="profileOpen = false"
        x-transition
        class="absolute right-0 mt-3 w-56 bg-white rounded-2xl shadow-2xl border border-gray-100 z-50 overflow-hidden"
    >

        <div class="p-4 border-b">
            <p class="font-semibold">
                {{ auth()->user()->name }}
            </p>

            <p class="text-sm text-gray-500">
                Akun Saya
            </p>
        </div>

        <a
            href="{{ route('profile.edit') }}"
            class="block px-4 py-3 hover:bg-gray-100"
        >
            Profil
        </a>

        <a
            href="{{ route('my-orders') }}"
            class="block px-4 py-3 hover:bg-gray-100"
        >
            Pesanan Saya
        </a>

        <a
            href="{{ route('wishlist') }}"
            class="block px-4 py-3 hover:bg-gray-100"
        >
            Wishlist
        </a>

        <form
            method="POST"
            action="{{ route('logout') }}"
            class="border-t border-gray-100"
        >
            @csrf

            <button
                class="w-full text-left px-4 py-3 text-red-500 hover:bg-gray-100"
            >
                Logout
            </button>
        </form>

    </div>

</div>

            @else

                <a
                    href="{{ route('login') }}"
                    class="bg-[#8B7355] text-white px-5 py-2 rounded-lg hover:bg-[#6D5B45] transition"
                >
                    Login
                </a>

            @endauth
        </div>

    </div>
    <div
    x-show="open"
    x-transition
    class="md:hidden px-6 pb-5 space-y-3"
>
    <a href="/" class="block">Home</a>
    <a href="{{ route('shop') }}" class="block">Shop</a>
    <a href="{{ route('category') }}" class="block">Category</a>
    <a href="{{ route('cart') }}" class="block">Cart</a>

    @auth
    <a href="{{ route('profile.edit') }}" class="block">Profil</a>
    <a href="{{ route('my-orders') }}" class="block">Pesanan Saya</a>
    <a href="{{ route('wishlist') }}" class="block">Wishlist</a>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="text-red-500">
            Logout
        </button>
    </form>
@else
    <a href="{{ route('login') }}" class="block">
        Login
    </a>
@endauth
</div>
</nav>
