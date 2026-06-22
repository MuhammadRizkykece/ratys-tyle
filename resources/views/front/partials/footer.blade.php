<footer class="bg-black text-white mt-20">

    <div class="max-w-7xl mx-auto px-8 py-16">

        <div class="grid md:grid-cols-3 gap-10">

            {{-- Brand --}}
            <div>
                <h2 class="text-2xl font-bold mb-4">
                    RATYS'TYLE
                </h2>

                <p class="text-gray-400 leading-relaxed">
                    Modern fashion brand that combines comfort,
                    elegance, and timeless style for everyone.
                </p>
            </div>

            {{-- Quick Links --}}
            <div>
                <h3 class="font-semibold text-lg mb-4">
                    Quick Links
                </h3>

                <ul class="space-y-2 text-gray-400">
                    <li>
                        <a href="{{ route('home') }}" class="hover:text-white">
                            Home
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('shop') }}" class="hover:text-white">
                            Shop
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('category.index') }}" class="hover:text-white">
                            Category
                        </a>
                    </li>
                </ul>
            </div>

            {{-- Contact --}}
            <div>
                <h3 class="font-semibold text-lg mb-4">
                    Contact
                </h3>

                <ul class="space-y-2 text-gray-400">
                    <li>📍 Medan, Indonesia</li>
                    <li>✉️ ratystyle@gmail.com</li>
                </ul>
            </div>

        </div>

        <div class="border-t border-gray-800 mt-10 pt-6 text-center text-gray-500 text-sm">
            © 2026 RATYS'TYLE. All Rights Reserved.
        </div>

    </div>

</footer>
