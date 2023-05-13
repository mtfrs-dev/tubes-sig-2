<ul class="nav-container">
    <!-- Navigation item -->
    <li>
        <div class="logo flex justify-center items-center">
            <a href="/"><img src="{{ asset('pictures/logo.png') }}" alt="" ></a>
        </div>
    </li>

    <!-- Navigation item that sticks to the right -->
    <li class="nav__item--right">
        <a href="{{route('wisata.index')}}">
            <p>Wisata</p>
        </a>
        <a href="{{route('olahraga.index')}}">
            <p>Olahraga</p>
        </a>
        @auth
            <div x-data="{ profileMenuDropdown: false }" class="relative ml-20">
                <button x-on:click="profileMenuDropdown =! profileMenuDropdown" type="button" class="w-fit flex justify-start gap-3 items-center text-[#2A2A2A] hover:text-gray-800">
                    <p class="text-xl font-bold">
                        {{ explode(" ", Auth::user()->name)[0] }}
                    </p>
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                        </svg>
                    </span>
                </button>
                <div x-cloak x-show="profileMenuDropdown" x-on:click.outside="profileMenuDropdown = false" class="w-32 bg-white shadow shadow-gray-100 absolute top-full mt-4 right-0 rounded-b-md py-2 border-b-4 border-primary">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-red-500 font-medium hover:bg-red-500 hover:text-white flex gap-2 items-center py-1 px-2 mt-1">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 rotate-180">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                                </svg>
                            </span>
                            <p>
                                {{ __('Keluar') }}
                            </p>
                        </button>
                    </form>
                </div>
            </div>
        @else
            <a href="{{ route('login') }}" class="w-fit font-semibold text-[#2A2A2A] hover:text-white bg-transparent hover:bg-[#2A2A2A] border-2 border-[#2A2A2A] focus:ring-2 focus:outline-none focus:ring-gray-600 rounded-md text-sm p-1.5 text-center">
                {{ __('MASUK') }}
            </a>
            <a href="{{ route('register') }}" class="w-fit font-semibold text-[#2A2A2A] hover:text-white bg-transparent hover:bg-[#2A2A2A] border-2 border-[#2A2A2A] focus:ring-2 focus:outline-none focus:ring-gray-600 rounded-md text-sm p-1.5 text-center">
                {{ __('DAFTAR') }}
            </a>
        @endauth
    </li>
</ul>
