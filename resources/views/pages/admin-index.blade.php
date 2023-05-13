@extends('layouts.app')

@section('title', 'STRESSLESS - Admin')

@section('content')

    @include('layouts.navigation')

    <main class="overflow-y-auto overflow-x-hidden flex-1 bg-slate-200 mt-8">
        <div class="container px-6 py-8 mx-auto">
            <div class="bg-white shadow-sm rounded-lg mb-4 p-4 custom-scrollbar">
                <livewire:location-object-table />
            </div>
        </div>
    </main>

    
@endsection

@section('footer')
    <!-- SHOW MEDICINE DETAIL MODAL -->
    <div id="locationDetailModal" class="fixed z-[11100] inset-0 hidden">
        <div class="absolute z-[112] inset-0 bg-gray-600 bg-opacity-30 flex justify-center items-center py-4">
            <div class="bg-white w-10/12 md:w-3/5 lg:1/2 xl:w-1/3 rounded-md p-5">
                <!-- POP UP HEADER -->
                <div class="flex justify-between items-center mb-6">
                    <p class="block m-0 text-lg font-semibold text-gray-900 tracking-wide">
                        Detail Lokasi
                    </p>
                    <button type="button" id="closeLocationDetailButton" class="block border-none outline-none text-gray-900 hover:text-gray-800 font-medium">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </span>
                    </button>
                </div>
                <div class="relative overflow-x-auto sm:rounded-lg">
                    <div class="rounded-md mb-3 w-full aspect-[3/2]">
                        <img id="location_asset" src="" alt="" class="w-full max-w-full h-full max-h-full">
                    </div>
                    <div id="location_rating" class="mb-3"></div>
                    <table class="w-full text-sm text-left text-gray-600">
                        <tbody class="w-full">
                            <tr class="bg-white border-b">
                                <th scope="row" class="px-2 py-1 align-baseline font-medium text-gray-900 whitespace-nowrap">
                                    Nama
                                </th>
                                <td class="px-2 py-1 align-baseline">:</td>
                                <td id="location_name" class="px-2 py-1 align-baseline"></td>
                            </tr>
                            <tr class="bg-white border-b">
                                <th scope="row" class="px-2 py-1 align-baseline font-medium text-gray-900 whitespace-nowrap">
                                    Jenis
                                </th>
                                <td class="px-2 py-1 align-baseline">:</td>
                                <td id="location_type" class="px-2 py-1 align-baseline"></td>
                            </tr>
                            <tr class="bg-white border-b">
                                <th scope="row" class="px-2 py-1 align-baseline font-medium text-gray-900 whitespace-nowrap">
                                    Alamat
                                </th>
                                <td class="px-2 py-1 align-baseline">:</td>
                                <td id="location_phone" class="px-2 py-1 flex flex-start gap-1.5 flex-wrap"></td>
                            </tr>
                            <tr class="bg-white border-b">
                                <th scope="row" class="px-2 py-1 align-baseline font-medium text-gray-900 whitespace-nowrap">
                                    Latitude
                                </th>
                                <td class="px-2 py-1 align-baseline">:</td>
                                <td id="location_latitude" class="px-2 py-1 flex flex-start gap-1.5 flex-wrap"></td>
                            </tr>
                            <tr class="bg-white border-b">
                                <th scope="row" class="px-2 py-1 align-baseline font-medium text-gray-900 whitespace-nowrap">
                                    Longitude
                                </th>
                                <td class="px-2 py-1 align-baseline">:</td>
                                <td id="location_longitude" class="px-2 py-1 flex flex-start gap-1.5 flex-wrap"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="mx-auto"></div>
    </div>
    

    {{-- <!-- STORE MEDICINE DETAIL MODAL -->
    <div id="medicineStoreModal" 
        class="fixed @if(auth()->user()->role == "ADMIN" && $errors->hasBag('store_medicine')) z-[110] @else z-[-110] @endif inset-0">
        <div class="absolute z-[112] inset-0 bg-gray-600 bg-opacity-30 flex justify-center items-center py-4">
            <div class="bg-white w-10/12 md:w-3/5 lg:1/2 xl:w-1/3 rounded-md p-5">
                <!-- POP UP HEADER -->
                <div class="flex justify-between items-center mb-6">
                    <p class="block m-0 text-lg font-semibold text-gray-900 tracking-wide">
                        Tambah Data Obat
                    </p>
                    <button type="button" id="closeMedicineStoreButton" class="block border-none outline-none text-gray-900 hover:text-gray-800 font-medium">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </span>
                    </button>
                </div>
                
                <!-- POP UP BODY -->
                <form action="{{ route('medicines.store') }}" method="POST">
                    @method('POST')
                    @csrf
                    <div class="w-full max-h-[60vh] overflow-y-auto mb-6 px-2 custom-scrollbar">
                        <!-- Medicine Name -->
                        <div class="mb-4">
                            <label for="store_name" class="block mb-2 text-base font-medium text-gray-900">{{ __('Nama Obat') }}</label>
                            <input type="text" id="store_name" name="name" value="{{ old('name') }}"
                                class="border-2 border-primary-20 text-primary-50 text-sm rounded-md focus:ring-primary-70 focus:border-primary-70 block w-full p-2.5 custom-placeholder" 
                                autocomplete="off" placeholder="Nama Obat">
                            @error('name', 'store_medicine')
                                <p class="block mt-1 text-xs font-medium text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Medicine Code -->
                        <div class="mb-4">
                            <label for="store_code" class="block mb-2 text-base font-medium text-gray-900">{{ __('Kode Obat') }}</label>
                            <input type="text" id="store_code" name="code" value="{{ old('code') }}"
                                class="border-2 border-primary-20 text-primary-50 text-sm rounded-md focus:ring-primary-70 focus:border-primary-70 block w-full p-2.5 custom-placeholder" 
                                autocomplete="off" placeholder="Kode Obat">
                            @error('code', 'store_medicine')
                                <p class="block mt-1 text-xs font-medium text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Medicine QR Code -->
                        <div class="mb-4">
                            <label for="store_qr_code" class="block mb-2 text-base font-medium text-gray-900">{{ __('Barcode Obat') }}</label>
                            <input type="text" id="store_qr_code" name="qr_code" value="{{ old('qr_code') }}"
                                class="border-2 border-primary-20 text-primary-50 text-sm rounded-md focus:ring-primary-70 focus:border-primary-70 block w-full p-2.5 custom-placeholder" 
                                autocomplete="off" placeholder="Barcode Obat">
                            @error('qr_code', 'store_medicine')
                                <p class="block mt-1 text-xs font-medium text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Medicine Category -->
                        <div class="mb-4">
                            <label for="store_categories" class="block mb-2 text-base font-medium text-gray-900">{{ __('Kategori Obat') }}</label>
                            <select name="categories[]" id="store_categories" multiple="multiple"
                                class="border-2 border-primary-20 text-primary-50 text-sm rounded-md focus:ring-primary-70 focus:border-primary-70 block w-full p-2.5 custom-placeholder">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" 
                                        @selected(old('categories') && in_array($category->id, old('categories')))>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('categories', 'store_medicine')
                                <p class="block mt-1 text-xs font-medium text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Medicine Buy Price -->
                        <div class="mb-4">
                            <label for="store_buy_price" class="block mb-2 text-base font-medium text-gray-900">{{ __('Harga Beli') }}</label>
                            <input type="number" id="store_buy_price" name="buy_price" value="{{ old('buy_price') }}"
                                class="border-2 border-primary-20 text-primary-50 text-sm rounded-md focus:ring-primary-70 focus:border-primary-70 block w-full p-2.5 custom-placeholder" 
                                autocomplete="off" placeholder="Harga Beli">
                            @error('buy_price', 'store_medicine')
                                <p class="block mt-1 text-xs font-medium text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Medicine Sell Price -->
                        <div class="mb-4">
                            <label for="store_sell_price" class="block mb-2 text-base font-medium text-gray-900">{{ __('Harga Jual') }}</label>
                            <input type="number" id="store_sell_price" name="sell_price" value="{{ old('sell_price') }}"
                                class="border-2 border-primary-20 text-primary-50 text-sm rounded-md focus:ring-primary-70 focus:border-primary-70 block w-full p-2.5 custom-placeholder" 
                                autocomplete="off" placeholder="Harga Jual">
                            @error('sell_price', 'store_medicine')
                                <p class="block mt-1 text-xs font-medium text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Medicine Quantity -->
                        <div class="mb-4">
                            <label for="store_quantity" class="block mb-2 text-base font-medium text-gray-900">{{ __('Kuantitas') }}</label>
                            <input type="number" id="store_quantity" name="quantity" value="{{ old('quantity') }}"
                                class="border-2 border-primary-20 text-primary-50 text-sm rounded-md focus:ring-primary-70 focus:border-primary-70 block w-full p-2.5 custom-placeholder" 
                                autocomplete="off" placeholder="Kuantitas">
                            @error('quantity', 'store_medicine')
                                <p class="block mt-1 text-xs font-medium text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Medicine Unit -->
                        <div class="mb-4">
                            <label for="store_unit_id" class="block mb-2 text-base font-medium text-gray-900">{{ __('Satuan Obat') }}</label>
                            <select name="unit_id" id="store_unit_id"
                                class="border-2 border-primary-20 text-primary-50 text-sm rounded-md focus:ring-primary-70 focus:border-primary-70 block w-full p-2.5 custom-placeholder">
                                <option value="" selected disabled hidden>Pilih Satuan Obat</option>
                                @foreach ($units as $unit)
                                    <option value="{{ $unit->id }}" 
                                        @selected(old('unit_id') == $unit->id)>
                                        {{ $unit->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('unit_id', 'store_medicine')
                                <p class="block mt-1 text-xs font-medium text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Medicine Description -->
                        <div class="mb-4">
                            <label for="store_description" class="block mb-2 text-base font-medium text-gray-900">{{ __('Deskripsi Obat') }}</label>
                            <input type="text" id="store_description" name="description" value="{{ old('description') }}"
                                class="border-2 border-primary-20 text-primary-50 text-sm rounded-md focus:ring-primary-70 focus:border-primary-70 block w-full p-2.5 custom-placeholder" 
                                autocomplete="off" placeholder="Deskripsi">
                            @error('description', 'store_medicine')
                                <p class="block mt-1 text-xs font-medium text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>
                    <!-- SUBMIT BUTTON -->
                    <div class="flex justify-end">
                        <button type="submit" class="w-fit text-white bg-primary hover:bg-primary-70 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-md text-sm px-5 py-2.5 text-center">
                            {{ __('Simpan Data') }}
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- UPDATE MEDICINE DETAIL MODAL -->
    <div id="medicineUpdateModal" 
        class="fixed @if(auth()->user()->role == "ADMIN" && $errors->hasBag('update_medicine')) z-[110] @else z-[-110] @endif inset-0">
        <div class="absolute z-[112] inset-0 bg-gray-600 bg-opacity-30 flex justify-center items-center py-4">
            <div class="bg-white w-10/12 md:w-3/5 lg:1/2 xl:w-1/3 rounded-md p-5">
                <!-- POP UP HEADER -->
                <div class="flex justify-between items-center mb-6">
                    <p class="block m-0 text-lg font-semibold text-gray-900 tracking-wide">
                        Ubah Detail Obat
                    </p>
                    <button type="button" id="closeMedicineUpdateButton" class="block border-none outline-none text-gray-900 hover:text-gray-800 font-medium">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </span>
                    </button>
                </div>
                
                <!-- POP UP BODY -->
                <form action="{{ route('medicines.update') }}" method="POST">
                    @method('POST')
                    @csrf
                    <div class="w-full max-h-[60vh] overflow-y-auto mb-6 px-2 custom-scrollbar">
                        <input type="hidden" name="id" id="update_id">
                        <!-- Medicine Name -->
                        <div class="mb-4">
                            <label for="update_name" class="block mb-2 text-base font-medium text-gray-900">{{ __('Nama Obat') }}</label>
                            <input type="text" id="update_name" name="name" value="{{ old('name') }}"
                                class="border-2 border-primary-20 text-primary-50 text-sm rounded-md focus:ring-primary-70 focus:border-primary-70 block w-full p-2.5 custom-placeholder" 
                                autocomplete="off" placeholder="Nama Obat">
                            @error('name', 'update_medicine')
                                <p class="block mt-1 text-xs font-medium text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Medicine Code -->
                        <div class="mb-4">
                            <label for="update_code" class="block mb-2 text-base font-medium text-gray-900">{{ __('Kode Obat') }}</label>
                            <input type="text" id="update_code" name="code" value="{{ old('code') }}"
                                class="border-2 border-primary-20 text-primary-50 text-sm rounded-md focus:ring-primary-70 focus:border-primary-70 block w-full p-2.5 custom-placeholder" 
                                autocomplete="off" placeholder="Kode Obat">
                            @error('code', 'update_medicine')
                                <p class="block mt-1 text-xs font-medium text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Medicine QR Code -->
                        <div class="mb-4">
                            <label for="update_qr_code" class="block mb-2 text-base font-medium text-gray-900">{{ __('Barcode Obat') }}</label>
                            <input type="text" id="update_qr_code" name="qr_code" value="{{ old('qr_code') }}"
                                class="border-2 border-primary-20 text-primary-50 text-sm rounded-md focus:ring-primary-70 focus:border-primary-70 block w-full p-2.5 custom-placeholder" 
                                autocomplete="off" placeholder="Barcode Obat">
                            @error('qr_code', 'update_medicine')
                                <p class="block mt-1 text-xs font-medium text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Medicine Category -->
                        <div class="mb-4">
                            <label for="update_categories" class="block mb-2 text-base font-medium text-gray-900">{{ __('Kategori Obat') }}</label>
                            <select name="categories[]" id="update_categories" multiple="multiple"
                                class="border-2 border-primary-20 text-primary-50 text-sm rounded-md focus:ring-primary-70 focus:border-primary-70 block w-full p-2.5 custom-placeholder">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" 
                                        @selected(old('categories') && in_array($category->id, old('categories')))>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('categories', 'update_medicine')
                                <p class="block mt-1 text-xs font-medium text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Medicine Buy Price -->
                        <div class="mb-4">
                            <label for="update_buy_price" class="block mb-2 text-base font-medium text-gray-900">{{ __('Harga Beli') }}</label>
                            <input type="number" id="update_buy_price" name="buy_price" value="{{ old('buy_price') }}"
                                class="border-2 border-primary-20 text-primary-50 text-sm rounded-md focus:ring-primary-70 focus:border-primary-70 block w-full p-2.5 custom-placeholder" 
                                autocomplete="off" placeholder="Harga Beli">
                            @error('buy_price', 'update_medicine')
                                <p class="block mt-1 text-xs font-medium text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Medicine Sell Price -->
                        <div class="mb-4">
                            <label for="update_sell_price" class="block mb-2 text-base font-medium text-gray-900">{{ __('Harga Jual') }}</label>
                            <input type="number" id="update_sell_price" name="sell_price" value="{{ old('sell_price') }}"
                                class="border-2 border-primary-20 text-primary-50 text-sm rounded-md focus:ring-primary-70 focus:border-primary-70 block w-full p-2.5 custom-placeholder" 
                                autocomplete="off" placeholder="Harga Jual">
                            @error('sell_price', 'update_medicine')
                                <p class="block mt-1 text-xs font-medium text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Medicine Quantity -->
                        <div class="mb-4">
                            <label for="update_quantity" class="block mb-2 text-base font-medium text-gray-900">{{ __('Kuantitas') }}</label>
                            <input type="number" id="update_quantity" name="quantity" value="{{ old('quantity') }}"
                                class="border-2 border-primary-20 text-primary-50 text-sm rounded-md focus:ring-primary-70 focus:border-primary-70 block w-full p-2.5 custom-placeholder" 
                                autocomplete="off" placeholder="Kuantitas">
                            @error('quantity', 'update_medicine')
                                <p class="block mt-1 text-xs font-medium text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Medicine Unit -->
                        <div class="mb-4">
                            <label for="update_unit_id" class="block mb-2 text-base font-medium text-gray-900">{{ __('Satuan Obat') }}</label>
                            <select name="unit_id" id="update_unit_id"
                                class="border-2 border-primary-20 text-primary-50 text-sm rounded-md focus:ring-primary-70 focus:border-primary-70 block w-full p-2.5 custom-placeholder">
                                <option value="" selected disabled hidden>Pilih Satuan Obat</option>
                                @foreach ($units as $unit)
                                    <option value="{{ $unit->id }}" 
                                        @selected(old('unit_id') == $unit->id)>
                                        {{ $unit->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('unit_id', 'update_medicine')
                                <p class="block mt-1 text-xs font-medium text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Medicine Description -->
                        <div class="mb-4">
                            <label for="update_description" class="block mb-2 text-base font-medium text-gray-900">{{ __('Deskripsi Obat') }}</label>
                            <input type="text" id="update_description" name="description" value="{{ old('description') }}"
                                class="border-2 border-primary-20 text-primary-50 text-sm rounded-md focus:ring-primary-70 focus:border-primary-70 block w-full p-2.5 custom-placeholder" 
                                autocomplete="off" placeholder="Deskripsi">
                            @error('description', 'update_medicine')
                                <p class="block mt-1 text-xs font-medium text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>
                    <!-- SUBMIT BUTTON -->
                    <div class="flex justify-end">
                        <button type="submit" class="w-fit text-white bg-primary hover:bg-primary-70 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-md text-sm px-5 py-2.5 text-center">
                            {{ __('Simpan Perubahan') }}
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div> --}}

    <script>
        $(document).ready(function () {
            window.addEventListener('showDetail:location', event => {
                $("#location_asset").attr("src", event.detail.asset);
                $("#location_name").text(event.detail.name);
                $("#location_type").text(event.detail.type);
                $("#location_address").text(event.detail.address);
                $("#location_phone").text(event.detail.phone);
                $("#location_latitude").text(event.detail.latitude);
                $("#location_longitude").text(event.detail.longitude);
                let rating = `<div class="flex w-fit mx-auto justify-center gap-1 text-gray-300">`;
                for (let i=1; i<=5; i++) {
                    if (event.detail.rating >= i ) {
                        rating += `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 text-yellow-500">`
                            +`<path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z" clip-rule="evenodd" /></svg>`;
                    } else {
                        rating += `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">`
                            +`<path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z" clip-rule="evenodd" /></svg>`;
                    }
                }
                rating += `<span class="block w-fit text-sm text-gray-700">(`+event.detail.rating+`)</span></div>`;
                    
                $("#location_rating").html(rating);
                $("#locationDetailModal").removeClass("hidden");
            });
        });
        $("#closeLocationDetailButton").click(function (e) { 
            e.preventDefault();
            $("#locationDetailModal").addClass("hidden");
            $("#location_asset").attr("src", "");
            $("#location_name").text("");
            $("#location_type").text("");
            $("#location_address").text("");
            $("#location_phone").text("");
            $("#location_latitude").text("");
            $("#location_longitude").text("");
            $("#location_rating").html("");
        });
        window.addEventListener('delete:location', event => {
            Swal.fire({
                title: 'Peringatan',
                text: `Anda yakin akan menghapus data lokasi ini?`,
                icon: 'warning',
                showCancelButton : true,
                cancelButtonText : 'Batal',
                cancelButtonColor : '#6C7582',
                showConfirmButton : true,
                confirmButtonText : 'Hapus',
                confirmButtonColor : '#FF4248',
                buttonsStyling : 'py-2 w-20 text-center',
            })
            .then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Berhasil',
                        text: 'Data lokasi berhasil dihapus.',
                        icon: 'success',
                        showConfirmButton : false,
                        timer: 2000
                    });
                    window.livewire.emit('deleteLocation', event.detail.id)
                }
            })
        });
    </script>

    @include('layouts.footer')
@endsection
