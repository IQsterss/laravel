@props(['locations', 'selectedLocationId'])

<div class="location-list">

    @foreach ($locations as $location)
        <x-location-item :selectedLocationId="$selectedLocationId" :id="$location->id" :name="$location->name" :latitude="$location->latitude" :longitude="$location->longitude" />
    @endforeach

</div>
