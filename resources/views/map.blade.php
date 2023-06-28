
<head>
        <script src="https://api-maps.yandex.ru/2.1/?apikey=b1de3bee-5003-4e47-bf6e-e6ea27bd2ef0&lang=ru_RU"></script>
        <script type="text/javascript">
        // Функция для инициализации карты
        ymaps.ready( function () {
        function init(latitude, longitude){
            var map = new ymaps.Map("map", {
                center: [latitude, longitude],
                zoom: 12 } , {
            searchControlProvider: 'yandex#search'
            });
            // Создание метки на карте
            var placemark = new ymaps.Placemark([latitude, longitude]);
            map.geoObjects.add(placemark);
        }

        //получение геолокации и местонахождения пользователя
        function getUserLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    function (position) {
                        var latitude = position.coords.latitude;
                        var longitude = position.coords.longitude;
                        // Инициализация карты с полученными координатами
                        init(latitude, longitude);
                    },
                    function (error) {
                        console.log(error);
                    }
                );
            } 
            else {
                console.log("Геолокация не поддерживается в вашем браузере");
            }
        }
        getUserLocation();
        });
        </script>
        
        <!-- function setMarker() {
        var latitude = parseFloat(document.getElementById('latitudeInput').value);
        var longitude = parseFloat(document.getElementById('longitudeInput').value);

        if (isNaN(latitude) || isNaN(longitude)) {
            alert('Invalid coordinates');
            return;
        }

        var coords = [latitude, longitude];

        // Create a placemark at the entered coordinates
        var myPlacemark = new ymaps.Placemark(coords, {}, {
            preset: 'islands#redDotIcon'
        });

        // Add the placemark to the map
        myMap.geoObjects.add(myPlacemark);

        // Center the map on the marker
        myMap.setCenter(coords);
        myMap.setZoom(13);
    } -->
    
    
        </head>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Map') }}
            </h2>
        </x-slot>
        
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                <!-- <div>
                        <x-input-label for="latitudeInput" :value="__('Широта: ')" />
                        <x-text-input id="latitudeInput" name="latitudeInput" type="text" required  />  <!--class="mt-1 block w-full" :value="old('latitudeInput', $user->latitudeInput)"
                        <!- <x-input-error class="mt-2" :messages="$errors->get('name')" />  -->

                        <!-- <x-input-label for="longitudeInput" :value="__('Долгота: ')" /> -->
                        <!-- <x-text-input id="longitudeInput" name="longitudeInput" type="text" required  /> class="mt-1 block w-full" :value="old('longitudeInput', $user->longitudeInput)" required   /> -->
                        <!-- <x-input-error class="mt-2" :messages="$errors->get('name')" /> -->

                        <!-- <x-primary-button>{{ __('Поставить метку') }}</x-primary-button> -->
                    <!-- </div> --> 
                <div>
                    Широта: <input type="text" id="latitudeInput">
                    Долгота: <input type="text" id="longitudeInput">
                    <x-primary-button>{{ __('Поставить метку') }}</x-primary-button>
                </div>
                    <div id="map" style="width: 600px; height: 400px;"></div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>