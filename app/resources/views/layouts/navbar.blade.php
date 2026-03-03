<nav class="bg-white border-b-[6px] border-black px-4 py-4 mb-8">
    <div class="max-w-7xl mx-auto flex flex-wrap items-center justify-between">

        <div class="flex items-center">
            <a href="{{ url('/') }}" class="text-2xl font-[1000] italic tracking-tighter text-black">
                PRIETO<span class="text-[#FF5722]">EATS</span>
            </a>
        </div>

        <ul class="hidden md:flex space-x-8">
            <li><a href="{{ url('/') }}" class="font-black text-sm uppercase hover:text-[#FF5722] transition-colors">Home</a></li>
            <li><a href="#" class="font-black text-sm uppercase hover:text-[#FF5722] transition-colors">Features</a></li>
            <li><a href="#" class="font-black text-sm uppercase hover:text-[#FF5722] transition-colors">Pricing</a></li>
            <li><a href="#" class="font-black text-sm uppercase hover:text-[#FF5722] transition-colors">About</a></li>
        </ul>

        <div class="flex items-center gap-4">

            @if (Route::has('login'))
            
                @auth
                    {{-- Usuario Logueado --}}
                    <a href="{{ url('/dashboard') }}"
                        class="bg-yellow-300 border-4 border-black px-4 py-2 rounded-xl font-black text-xs uppercase shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-0.5 hover:translate-y-0.5 hover:shadow-none transition-all">
                        Dashboard
                    </a>

                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit"
                                class="bg-red-500 text-white border-4 border-black px-4 py-2 rounded-xl font-black text-xs uppercase shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-0.5 hover:translate-y-0.5 hover:shadow-none transition-all">
                            Saca el hambre (Logout)
                        </button>
                    </form>
                @else
                    {{-- Usuario Invitado --}}
                    <a href="{{ route('login') }}"
                       class="font-black text-sm uppercase px-4 py-2 border-4 border-transparent hover:border-black rounded-xl transition-all">
                        Login
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                           class="bg-[#FF5722] text-white border-4 border-black px-6 py-2 rounded-xl font-black text-sm uppercase shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-0.5 hover:translate-y-0.5 hover:shadow-none transition-all">
                            ¡Regístrate!
                        </a>
                    @endif

                @endauth

            @endif
        </div>
    </div>
</nav>
