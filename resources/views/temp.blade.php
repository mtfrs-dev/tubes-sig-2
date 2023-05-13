<!-- HEADER -->
<nav class="w-full flex justify-between items-center p-4 lg:p-6">
    <div class="w-20 p-1.5 md:w-28 md:p-2 lg:w-36 lg:p-2.5 rounded-md bg-[#2A2A2A]">
        <img src="{{ asset('pictures/logo.png') }}" alt="main logo" class="w-full h-auto">
    </div>
    <div class="w-fit flex justify-end items-center gap-4">
        <a href="" class="font-semibold text-lg tracking-wider text-[#2A2A2A]">
            Olahraga
        </a>
        <a href="" class="font-semibold text-lg tracking-wider text-[#2A2A2A]">
            Wisata
        </a>
        @auth
            <div x-data="{ profileMenuDropdown: false }" class="relative">
                <button x-on:click="profileMenuDropdown =! profileMenuDropdown" type="button" class="w-fit flex justify-start gap-3 items-center">
                    <p class="font-medium text-[#2A2A2A] hover:text-gray-500">
                        {{ explode(" ", Auth::user()->name)[0] }}
                    </p>
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                        </svg>
                    </span>
                </button>
                <div x-cloak x-show="profileMenuDropdown" x-on:click.outside="profileMenuDropdown = false" class="w-32 bg-white shadow shadow-gray-100 absolute top-full mt-4 right-0 rounded-b-md py-2 border-b-4 border-primary">
                    <a href="" class="w-full text-[#2A2A2A] font-medium hover:bg-[#2A2A2A] hover:text-white flex gap-2 items-center py-1 px-2">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </span>
                        <p>
                            {{ __('Profil') }}
                        </p>
                    </a>
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
            <a href="" class="w-fit font-semibold text-[#2A2A2A] hover:text-white bg-transparent hover:bg-[#2A2A2A] border-2 border-[#2A2A2A] focus:ring-2 focus:outline-none focus:ring-gray-600 rounded-md text-sm p-1.5 text-center">
                {{ __('MASUK') }}
            </a>
            <a href="" class="w-fit font-semibold text-[#2A2A2A] hover:text-white bg-transparent hover:bg-[#2A2A2A] border-2 border-[#2A2A2A] focus:ring-2 focus:outline-none focus:ring-gray-600 rounded-md text-sm p-1.5 text-center">
                {{ __('DAFTAR') }}
            </a>
        @endauth
    </div>
</nav>