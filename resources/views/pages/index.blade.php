@extends('layouts.app')

@section('title', ucwords($object_type))

@section('head')
    <script>
        let data = {!! json_encode($data) !!};
    </script>
@endsection

@section('banner')
    <div class="banner-full"
        style="background: linear-gradient(to bottom, hsla(0, 0%, 30.2%, 0.7), hsla(0, 0%, 30.2%, 0.7)), url({{ asset('pictures/banner.png') }}) no-repeat center center / cover;">
        <div>
            <p class="banner-full__header capitalize">Cari {{ $object_type }}</p>
            <p>
                @if ($object_type == 'sarana olahraga')
                    Mari jaga kesehatan fisik dengan rutin berolahraga. Pilih sarana olahraga sesuai keinginanmu!
                @else
                    Penat dengan aktifitas sehari - harimu? Mari berpariwisata untuk healing mu sejenak!
                @endif
            </p>
        </div>

    </div>
    <div style="position: absolute; padding: 30px 80px; top: 0px; width: 100%" class="notHome">
        @include('layouts.navigation')
    </div>

@endsection

@section('content')
    <form id="searchForm" method="get"
        action="{{ 
            $object_type == 'sarana olahraga' ? 
                route('olahraga.index') 
                : 
                route('wisata.index') 
        }}">
        <input type="hidden" name="sortby" value="{{ $sortby }}" id="inputSort">
        <input type="hidden" name="mylatitude" value="{{ $mylatitude }}" id="mylatitude">
        <input type="hidden" name="mylongitude" value="{{ $mylongitude }}" id="mylongitude">
        <div class="relative min-h-14 w-3/5 mb-10">
            <div class="absolute w-full z-[110] -top-16 flex gap-4 justify-between items-center">
                <input id="searchLoc" name="search" value="{{$search_key}}"
                    class="block w-full bg-white text-gray-800 text-xl p-2 rounded-lg border border-gray-400"
                    placeholder="Cari {{ $object_type }}" autocomplete="off">
                <button type="submit" class="h-full aspect-square font-semibold text-white bg-[#2A2A2A] hover:bg-gray-900 focus:ring-2 focus:outline-none focus:ring-gray-600 rounded-md text-sm p-2.5 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                        <path fill-rule="evenodd" d="M10.5 3.75a6.75 6.75 0 100 13.5 6.75 6.75 0 000-13.5zM2.25 10.5a8.25 8.25 0 1114.59 5.28l4.69 4.69a.75.75 0 11-1.06 1.06l-4.69-4.69A8.25 8.25 0 012.25 10.5z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        </div>
    </form>

    <div class="flex justify-between">
        <div class="map" id="map"></div>

        <div class="relative flex flex-col px-[50px] overflow-y-auto custom-scrollbar max-h-[800px]">
            <div class="relative mb-5">
                <div class="relative" x-data=" {showSortOption : false} ">
                    <button type="button" x-on:click="showSortOption =! showSortOption" 
                        class="p-2 rounded-md bg-[#2A2A2A] text-white font-medium hover:bg-gray-800 border border-">
                        Urut Berdasarkan
                    </button>
                    <div x-cloak x-show="showSortOption" class="w-[145px] bg-gray-200 absolute top-full inset-x-auto rounded-b-md py-2">
                        <button id="sortByRatingBtn" type="button" class="w-full text-[#2A2A2A] font-medium hover:bg-[#2A2A2A] hover:text-white flex gap-2 items-center py-1 px-2 mt-1">
                            {{ __('Rating Terbaik') }}
                        </button>
                        <button id="sortByDistanceBtn" type="button" class="w-full text-[#2A2A2A] font-medium hover:bg-[#2A2A2A] hover:text-white flex gap-2 items-center py-1 px-2 mt-1">
                            {{ __('Jarak Terdekat') }}
                        </button>
                    </div>
                </div>
            </div>
            @foreach ($data as $item)
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
    </div>
@endsection

@section('footer')
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
            document.getElementById('mylatitude').setAttribute('value', position.coords.latitude)
            document.getElementById('mylongitude').setAttribute('value', position.coords.longitude)

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

            // Add a marker for the current location to the map
            L.marker(currentLocation).addTo(map);
    
            // marNew = L.marker(currentLocation).addTo(permLayer);
            permLayer   = L.layerGroup().addTo(map);
            markerLayer = L.layerGroup().addTo(map);
            routeLayer  = L.layerGroup().addTo(map);
    
            var circle = L.circle(currentLocation, {
                color: '#6BAF85',
                fillColor: '#71E99F',
                fillOpacity: 0.5,
                radius: 5000
            }).addTo(permLayer);

            let startWayPoint = new L.Routing.Waypoint(currentLocation);

            let processedData = Object.values(data);
            
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
        function cek (sortValue){
            let sort = document.getElementById('inputSort');
            sort.setAttribute('value',sortValue);
            document.getElementById('searchForm').submit();
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

            $("#sortByRatingBtn").click(function (e) { 
                e.preventDefault();
                cek('rating')
            });
            $("#sortByDistanceBtn").click(function (e) { 
                e.preventDefault();
                cek('distance')
            });
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
            
    </script>
@endsection