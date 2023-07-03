@props(['locations', 'selectedLocationId'])
<div>
<script src="https://api-maps.yandex.ru/2.1/?apikey=b1de3bee-5003-4e47-bf6e-e6ea27bd2ef0&lang=ru_RU"></script>
        <script type="text/javascript">
        
        // Функция для инициализации карты
        ymaps.ready(init) 
        
        function init(){
            const locations = {!! json_encode($locations) !!};
            const geolocation=ymaps.geolocation;
            const selectedLocationId = "{{ $selectedLocationId }}";
            const selectedLocation=locations.filter((location)=>location.id==selectedLocationId)[0];
            const map = new ymaps.Map("map", {
            center: selectedLocation?[selectedLocation.latitude,selectedLocation.longitude]:[0, 0],
            zoom: 12 } , {
            searchControlProvider: 'yandex#search'
            });
            if(!selectedLocation){
                geolocation.get({
                    provider: 'browser',
                    mapStateAutoApply: true
                }).then(function(result) {
                    result.geoObjects.options.set('preset', 'islands#blueCircleIcon');
                    map.geoObjects.add(result.geoObjects);
                });
            }
            locations.forEach((location)=>{const myPlacemark = new ymaps.Placemark( [location.latitude, location.longitude], {
                    balloonContentBody: location.name,
                }, {
                    preset: 'islands#redCircleIcon',

                });
            map.geoObjects.add(myPlacemark);})
        
    };
        
    </script>
    
    <div id="map" style="width: 600px; height: 400px;"></div>
    

</div>
