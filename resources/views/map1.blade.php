
<!-- <head>
        <script src="https://api-maps.yandex.ru/2.1/?apikey=b1de3bee-5003-4e47-bf6e-e6ea27bd2ef0&lang=ru_RU"></script>
        <script type="text/javascript">
        var map; // Объявляем переменную для карты
        var placemark; // Объявляем переменную для метки   
        var userPlacemark;
        var placemarks = [];
        
        // Функция для инициализации карты
        ymaps.ready( function () {
        function init(latitude, longitude){
            map = new ymaps.Map("map", {
            center: [latitude, longitude],
            zoom: 12 } , {
            searchControlProvider: 'yandex#search'
            });
            // Создание метки на карте
            userPlacemark = new ymaps.Placemark([latitude, longitude]);
            map.geoObjects.add(userPlacemark);
        }

        function placeMarker(latitude, longitude) {
            placemark = new ymaps.Placemark([latitude, longitude]);
            map.geoObjects.add(placemark);
            placemarks.push(placemark);
            map.panTo([latitude, longitude], { flying: true });
        }

        function removeMarkers() {
            map.geoObjects.removeAll();
            placemarks = [];
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

        function handlePlaceMarker() {
            var latitudeInput = document.getElementById("latitude");
            var longitudeInput = document.getElementById("longitude");

            var latitude = parseFloat(latitudeInput.value);
            var longitude = parseFloat(longitudeInput.value);

            if (!isNaN(latitude) && !isNaN(longitude)) {
                placeMarker(latitude, longitude);
            } else {
                console.log("Неверные координаты");
            }
        }

        function handleRemoveMarkers() {
            removeMarkers();
        }

        getUserLocation();
        
        
        var placeMarkerButton = document.getElementById("place-marker-button");
        placeMarkerButton.addEventListener("click", handlePlaceMarker);

        var removeMarkersButton = document.getElementById("remove-markers-button");
        removeMarkersButton.addEventListener("click", handleRemoveMarkers);
        });
    </script>
</head> -->
<!-- <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Map') }}
            </h2>
        </x-slot>
        
        <div class="py-12">
            <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 margin: 0 auto;">
                        <label for="l_name"> Название места:</label>
                        <input type="text" id="l_name">
                        <label for="latitude">Широта:</label>
                        <input type="text" id="latitude">
                        <label for="longitude">Долгота:</label>
                        <input type="text" id="longitude">
                    
                        <x-primary-button id="place-marker-button" >Поставить метку</x-primary-button>
                        <x-primary-button id="remove-markers-button">Удалить все метки</x-primary-button>
                    </div>
                <div id="map" style="width: 600px; height: 500px;  margin: 0 auto;"></div>
            </div>
        </div>
    </div>
</x-app-layout> -->