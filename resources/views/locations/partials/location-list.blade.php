<section>
    <div class="location-list">
        <x-location-input :selectedLocationId="$selectedLocationId" />
        @foreach ($locations as $location)
            <x-location-item :id="$location->id" :name="$location->name" :latitude="$location->latitude" :longitude="$location->longitude"
                :selectedLocationId="$selectedLocationId" />
        @endforeach
    </div>

</section>
