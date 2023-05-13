@extends('layouts.app')

@section('title', 'Detail - '.ucwords($object_type))

@section('head')
<script>
    var detailData = {!! json_encode($data) !!};
    var rekomendasi = {!! json_encode($recommendations) !!};
</script>
@endsection

@section('banner')
    <div class="banner-full"
        style="background: linear-gradient(to bottom, hsla(0, 0%, 30.2%, 0.7), hsla(0, 0%, 30.2%, 0.7)), url({{ asset('pictures/banner.png') }}) no-repeat center center / cover;">
        <div>
            <p class="banner-full__header">{{ $data->name }}</p>
            <p>{{ $data->address }}</p>
            <p> {{ $data->phone }}</p>
            <div class="flex justify-between items-center">
                <div class="recommend__rating" style="display: flex; gap: 8px; justify-items: center;">
                    @if ($data->rating)
                        <div class="recommend__star">★</div>
                        <div style="color: white; font-weight: 700;">({{ floatval($data->rating) }} / 5.0)</div> 
                    @else
                        <div class="italic text-white font-semibold">Belum ada rating</div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div style="position: absolute; padding: 30px 80px; top: 0px; width: 100%" class="notHome">
        @include('layouts.navigation')
    </div>

@endsection

@section('content')
<div x-data="{ showRatingModal: false}">
    <div class="map__detail" id="map"></div>
    
    <button type="button" x-on:click="showRatingModal = true" class="cursor-pointer flex items-center gap-2 bg-[#2A2A2A] text-white mb-4 rounded-md p-2 pr-3">
        <span>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                <path d="M2.695 14.763l-1.262 3.154a.5.5 0 00.65.65l3.155-1.262a4 4 0 001.343-.885L17.5 5.5a2.121 2.121 0 00-3-3L3.58 13.42a4 4 0 00-.885 1.343z" />
            </svg>
        </span>
        <span class="text-xl font-semibold">Beri Rating</span>
    </button>

    <p class="recommend__text">
        @if ($object_type == 'sarana olahraga')
            Rekomendasi Tempat Olahraga Lainnya
        @else
            Rekomendasi Tempat Wisata Lainnya
        @endif
    </p>
    <div class="recommend detail">
        @foreach ($recommendations as $item)
            <div class="rec-card flex mb-5 card__recommend items-center"
                data-latitude="{{ $item->latitude }}" 
                data-longitude="{{ $item->longitude }}"
                data-asset_name="{{ $item->name }}"
                >
                <div class="recommend__img"
                    style="background: url({{ $item->asset_link }}) no-repeat center center / cover;">
                </div>

                <div class="recommend__info">
                    <p class="recommend__header">{{ $item->name }}</p>
                    {{-- <p id="jarak{{$item->id}}">{{ number_format(($item->distance/1000), 1) }} km</p> --}}
                    <p id="jarak{{$item->id}}"></p>
                    @if ($item->rating)
                        <div class="recommend__rating items-center gap-2">
                            <span class="text-xl">
                                ({{ $item->rating }})
                            </span>

                            <span class="flex gap-[2px]">
                                @for ($i = 1; $i <=5; $i++)
                                    @if ($i <= $item->rating)
                                        <div class="recommend__star">★</div>
                                    @else
                                        <div class="recommend__star nofill">☆</div>
                                    @endif
                                @endfor
                            </span>
                        </div>
                    @else
                        <p class="block w-fit text-sm italic font-medium text-gray-500">Belum ada rating</p>
                    @endif

                    @if ($object_type == 'sarana olahraga')
                        <a class="text-base font-bold text-gray-600 hover:text-[#2A2A2A]" href="{{ route('olahraga.show', $item->id) }}">Lihat
                            Selengkapnya</a>
                    @else
                        <a class="text-base font-bold text-gray-600 hover:text-[#2A2A2A]" href="{{ route('wisata.show', $item->id) }}">Lihat
                            Selengkapnya</a>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    <!-- CREATE LATEST EVENT MODAL -->
    <div class="fixed z-[11000] inset-0" x-cloak x-show="showRatingModal">
        <div class="absolute z-[112] inset-0 bg-gray-600 bg-opacity-30 flex justify-center items-center py-4">
            <div class="bg-white w-10/12 md:w-2/3 lg:3/5 xl:w-1/2 rounded-md p-5" >
                <!-- POP UP HEADER -->
                <div class="flex justify-between items-center mb-6">
                    <p class="block m-0 text-lg font-semibold text-gray-900 tracking-wide">
                        Beri Rating
                    </p>
                    <button type="button" class="block border-none outline-none text-gray-900 hover:text-gray-800 font-medium" x-on:click="showRatingModal = false">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </span>
                    </button>
                </div>
                
                <!-- POP UP BODY -->
                <div class="relative" x-data="{ showDeleteReview : false, showUpdateReview : false }">
                    <!-- REVIEW HEADER -->
                    <div class="relative rounded-md bg-[#2a2a2a] px-3 pt-4 pb-[88px] sm:pb-16 mb-9">
                        <p class="font-bold text-white">StressLess</p>
                        <div class="w-[calc(100%-24px)] absolute top-14 rounded-md bg-white shadow-md p-3">
                            <div class="flex justify-between items-baseline mb-2">
                                <span>
                                    <p class="text-xl font-bold text-[#2a2a2a]">
                                        PENILAIAN TERHADAP LOKASI
                                    </p>
                                </span>
                                @if ($data->rating)
                                    <div class="w-fit flex gap-2">
                                        <button id="delete-review" x-on:click="showDeleteReview=true; showUpdateReview=false;" class="text-white flex justify-center items-center bg-red-500 hover:bg-red-600 focus:ring-2 focus:outline-none focus:ring-red-300 rounded-full h-7 w-7">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                                                <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                        <button id="edit-review" x-on:click="showUpdateReview=true; showDeleteReview=false;" class="text-white flex justify-center items-center bg-gray-500 hover:bg-gray-600 focus:ring-2 focus:outline-none focus:ring-blue-300 rounded-full h-7 w-7">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                                                <path d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.2z" />
                                            </svg>
                                        </button>
                                    </div>
                                @endif
                            </div>
                            <p class="text-xs font-semibold text-gray-400">{{ $data->name }}</p>
                        </div>
                    </div>
                    <!-- REVIEW BODY CONTENT -->
                    <div class="relative max-h-[55vh] px-2 pb-2 mt-2 overflow-y-auto custom-scrollbar">
                        <div class="pt-2 relative">
                            @if ($data->rating)
                                <div class="mb-3 text-gray-700 bg-gray-500-10 bg-opacity-20 rounded p-4">
                                    <p class="mb-3">
                                        Penilaian anda terkait lokasi :
                                    </p>
                                    <div class="p-3 rounded-md bg-white">
                                        <div class="mb-3">
                                            <p class="mb-2 text-center">Skor pada lokasi :</p>
                                            <div class="flex justify-center gap-3 text-gray-300">
                                                @for ($i =1; $i<=5; $i++)
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 {{ $data->rating >= $i ? 'text-yellow-500' : '' }}">
                                                        <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z" clip-rule="evenodd" />
                                                    </svg>
                                                @endfor
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <form action="{{ 
                                    $object_type == 'sarana olahraga' ? 
                                            route('rating.store.olahraga', $data->id) 
                                            : 
                                            route('rating.store.wisata', $data->id) 
                                    }}" method="POST">
                                    @csrf
                                    <div class="mb-3 text-gray-700 bg-gray-500-10 bg-opacity-20 rounded p-4">
                                        <p class="mb-3 text-center">
                                            Bagaimana pendapat anda terkait lokasi ini ?
                                        </p>
                                        <div class="p-3 rounded-md bg-white">
                                            <div class="mb-3">
                                                <p class="mb-2 text-center">Beri skor pada lokasi :</p>
                                                <div class="flex justify-center gap-3 text-gray-300">
                                                    <label for="score_1" id="score-select-1"
                                                        class="score-select cursor-pointer">
                                                        <input type="radio" name="score" id="score_1" value="1" class="hidden">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                                            <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z" clip-rule="evenodd" />
                                                        </svg>
                                                    </label>
                                                    <label for="score_2" id="score-select-2"
                                                        class="score-select cursor-pointer">
                                                        <input type="radio" name="score" id="score_2" value="2" class="hidden">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                                            <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z" clip-rule="evenodd" />
                                                        </svg>
                                                    </label>
                                                    <label for="score_3" id="score-select-3"
                                                        class="score-select cursor-pointer">
                                                        <input type="radio" name="score" id="score_3" value="3" class="hidden">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                                            <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z" clip-rule="evenodd" />
                                                        </svg>
                                                    </label>
                                                    <label for="score_4" id="score-select-4"
                                                        class="score-select cursor-pointer">
                                                        <input type="radio" name="score" id="score_4" value="4" class="hidden">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                                            <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z" clip-rule="evenodd" />
                                                        </svg>
                                                    </label>
                                                    <label for="score_5" id="score-select-5"
                                                        class="score-select cursor-pointer">
                                                        <input type="radio" name="score" id="score_5" value="5" class="hidden">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                                            <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z" clip-rule="evenodd" />
                                                        </svg>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="submit" class="block w-full text-white bg-gray-500 hover:bg-gray-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-md text-sm px-5 py-2.5 text-center">
                                            BERIKAN PENILAIAN
                                        </button>
                                    </div>
                                </form>
                            @endif
                        </div>
                        @if ($data->rating)
                            <div x-cloak x-show="showUpdateReview" class="absolute inset-0 bg-gray-50 rounded p-4 text-gray-700 flex flex-col justify-center items-center gap-4">
                                <form action="{{ 
                                    $object_type == 'sarana olahraga' ? 
                                            route('rating.update.olahraga', $data->id) 
                                            : 
                                            route('rating.update.wisata', $data->id) 
                                    }}" method="POST">
                                    @csrf
                                    <input type="text" name="review_id" class="hidden" value="">
                                    <div class="p-3 rounded-md bg-white">
                                        <div class="mb-3">
                                            <p class="mb-2 text-center">Ubah skor pada pelayanan <span class="text-gray-600 font-medium">Helio Official</span> :</p>
                                            <div class="flex justify-center gap-3 text-gray-300">
                                                <label for="update_score_1" id="update-score-select-1"
                                                    class="update-score-select cursor-pointer {{ $data->rating >= 1 ? 'text-yellow-500' : '' }}">
                                                    <input type="radio" name="score" id="update_score_1" value="1" @checked($data->rating == 1) class="hidden">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                                        <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z" clip-rule="evenodd" />
                                                    </svg>
                                                </label>
                                                <label for="update_score_2" id="update-score-select-2"
                                                    class="update-score-select cursor-pointer {{ $data->rating >= 2 ? 'text-yellow-500' : '' }}">
                                                    <input type="radio" name="score" id="update_score_2" value="2" @checked($data->rating == 2) class="hidden">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                                        <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z" clip-rule="evenodd" />
                                                    </svg>
                                                </label>
                                                <label for="update_score_3" id="update-score-select-3"
                                                    class="update-score-select cursor-pointer {{ $data->rating >= 3 ? 'text-yellow-500' : '' }}">
                                                    <input type="radio" name="score" id="update_score_3" value="3" @checked($data->rating == 3) class="hidden">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                                        <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z" clip-rule="evenodd" />
                                                    </svg>
                                                </label>
                                                <label for="update_score_4" id="update-score-select-4"
                                                    class="update-score-select cursor-pointer {{ $data->rating >= 4 ? 'text-yellow-500' : '' }}">
                                                    <input type="radio" name="score" id="update_score_4" value="4" @checked($data->rating == 4) class="hidden">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                                        <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z" clip-rule="evenodd" />
                                                    </svg>
                                                </label>
                                                <label for="update_score_5" id="update-score-select-5"
                                                    class="update-score-select cursor-pointer {{ $data->rating >= 5 ? 'text-yellow-500' : '' }}">
                                                    <input type="radio" name="score" id="update_score_5" value="5" @checked($data->rating == 5) class="hidden">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                                        <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z" clip-rule="evenodd" />
                                                    </svg>
                                                </label>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="grid grid-cols-2 gap-3 px-6">
                                        <button type="button" x-on:click="showUpdateReview=false" class="block w-full text-white bg-gray-500 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-md text-sm px-5 py-2.5 text-center">
                                            KEMBALI
                                        </button>
                                        <button type="submit" class="block w-full text-white bg-gray-500 hover:bg-gray-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-md text-sm px-5 py-2.5 text-center">
                                            UBAH PENILAIAN
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div x-cloak x-show="showDeleteReview" class="absolute inset-0 bg-gray-50 rounded p-4 text-gray-700 flex flex-col justify-center items-center gap-4">
                                <span class="block w-fit mx-auto text-yellow-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-14 h-14">
                                        <path fill-rule="evenodd" d="M9.401 3.003c1.155-2 4.043-2 5.197 0l7.355 12.748c1.154 2-.29 4.5-2.599 4.5H4.645c-2.309 0-3.752-2.5-2.598-4.5L9.4 3.003zM12 8.25a.75.75 0 01.75.75v3.75a.75.75 0 01-1.5 0V9a.75.75 0 01.75-.75zm0 8.25a.75.75 0 100-1.5.75.75 0 000 1.5z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                                <p class="block w-full text-lg font-medium text-center">
                                    Anda yakin akan menghapus penilaian ini? Aksi ini tidak dapat dibatalkan.
                                </p>
                                <form action="{{ 
                                    $object_type == 'sarana olahraga' ? 
                                        route('rating.destroy.olahraga', $data->id) 
                                        : 
                                        route('rating.destroy.wisata', $data->id) 
                                }}" method="POST">

                                    

                                    @csrf
                                    <div class="grid grid-cols-2 gap-3 px-6">
                                        <button type="button" x-on:click="showDeleteReview=false" class="block w-full text-white bg-gray-500 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-md text-sm px-5 py-2.5 text-center">
                                            KEMBALI
                                        </button>
                                        {{-- <input type="text" name="review_id" class="hidden" value="{{ $data->rating->id }}"> --}}
                                        <button type="submit" class="block w-full text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-md text-sm px-5 py-2.5 text-center">
                                            HAPUS
                                        </button>
                                    </div>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer')
    {{-- <script src="{{ asset('js/map.js') }}"></script> --}}
    <script>
        // Define variables to store the current location and the map
        let currentLocation;
        let map;
        let markerLayer;
        let permLayer;
        let routeLayer;

        // Get the user's current location
        navigator.geolocation.getCurrentPosition(function(position) {
            currentLocation = L.latLng(position.coords.latitude, position.coords.longitude);

            // Initialize the map
            map = L.map('map').setView(currentLocation, 13);
            L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="http://openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                maxZoom: 19,
                id: 'mapbox/streets-v11',
                tileSize: 512,
                zoomOffset: -1,
                accessToken:'pk.eyJ1IjoibWFya3VzLXRvZ2kiLCJhIjoiY2xobDNtNXczMHh0cDNlbzNwOHdicHdkZyJ9.w2nTfe54hWBDARFlAFNE-g'
            }).addTo(map);
            
            L.marker(currentLocation).addTo(map);
            
            permLayer   = L.layerGroup().addTo(map);
            markerLayer = L.layerGroup().addTo(map);
            routeLayer  = L.layerGroup().addTo(map);

            L.Routing.control({
                waypoints: [
                    L.latLng(position.coords.latitude, position.coords.longitude),
                    L.latLng(detailData.latitude, detailData.longitude)
                ]
            }).addTo(map);

            let startWayPoint = new L.Routing.Waypoint(currentLocation);

            let processedData = Object.values(rekomendasi);
            
            processedData.forEach(function(place) {
                
                let destinationWayPoint = new L.Routing.Waypoint(L.latLng(place.latitude, place.longitude));
                let routeUS = new L.Routing.osrmv1();
                routeUS.route([startWayPoint, destinationWayPoint], (err,obj) => {
                    if(!err){
                        let jarak = obj[0].summary.totalDistance ;
                        document.getElementById('jarak'+place.id).innerHTML = "Jarak " + (jarak/1000).toFixed(1) + " km";
                    }
                })
            });
        });

    </script>
    <script>

        function addMarker(lat, long){
            var marker = L.marker([lat, long],).addTo(map);
            return marker;
        }
        function cek (sortValue){
            let sort = document.getElementById('inputSort');
            sort.setAttribute('value',sortValue);
            document.getElementById('searchForm').submit();
        }

        function addCircle(lat,long,radius,fillColor,strokeColor){
            var circle = L.circle([lat, long], {
                color: strokeColor,
                fillColor: fillColor,
                fillOpacity: 0.5,
                radius: radius
            }).addTo(map);
            return circle;
        }

        function popMarker(lat,lang,title){
            marker = L.marker([lat,lang]).addTo(markerLayer)
            marker.bindPopup(title).openPopup();
        }

        function clearMarker(){
            markerLayer.clearLayers();
            map.closePopup();
        }
    </script>
    <script>
        $(document).ready(function () {
            $(".rec-card").mousemove(function () { 
                let lat = $(this).attr('data-latitude');
                let lng = $(this).attr('data-longitude');
                let assetName = $(this).attr('data-asset_name');
                popMarker(lat, lng, assetName)
            });
            $(".rec-card").mouseout(function () { 
                clearMarker();
            });
        });
        
        $(".score-select").click(function (e) { 
                let id = $(this).attr('id').split('-')[2];
                $(".score-select").removeClass('text-yellow-500');
                for(let i=1; i<=id; i++) {
                    $("#score-select-"+i).addClass("text-yellow-500");
                }
        });
        $(".update-score-select").click(function (e) { 
            let id = $(this).attr('id').split('-')[3];
            $(".update-score-select").removeClass('text-yellow-500');
            for(let i=1; i<=id; i++) {
                $("#update-score-select-"+i).addClass("text-yellow-500");
            }
        });
    </script>
@endsection