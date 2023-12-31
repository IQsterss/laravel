@props(['id', 'name', 'latitude', 'longitude', 'selectedLocationId'])
<a href="{{ route('locations.index', ['location' => $id]) }}" style="{{ $id == $selectedLocationId ? 'outline:2px solid #ef4444;' : '' }}" class='location-item flex justify-between scale-100  mb-4 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500'>
    <div>
        <h2 class="text-lg font-medium text-gray-900">
            <span id="nameField" contenteditable="false">{{ $name ?: 'Введите название' }}</span>
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Широта: <span id="latitudeField" contenteditable="false">{{ $latitude ?: 'Введите широту' }}</span>
        </p>
        <p class="mt-1 text-sm text-gray-600">
            Долгота: <span id="longitudeField" contenteditable="false">{{ $longitude ?: 'Введите долготу' }}</span>
        </p>
    </div>

    <div class="inline-flex items-center">
        <form style="margin:0 .5rem 0 0 " method="post" action="{{ route('locations.destroy', $id) }}">
            @csrf
            @method('delete')

            <x-danger-button>
                {{ __('Delete') }}
            </x-danger-button>
        </form>

        <!-- <form style="margin:0 .5rem 0 0 0" method="post" action="{{ route('locations.update', $id) }}">
            @csrf
            @method('put')
            <x-secondary-button id="editButton" onclick="enableFields()">
                {{ __('Edit') }}
            </x-secondary-button>
        </form> -->
    </div>
</a>


