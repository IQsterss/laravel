<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users table') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 ">
                <table>
    <thead >
        <tr >
            <th style="padding-right: 50px;"><a href="{{ route('userstable', ['sort_column' => 'name', 'sort_order' => $sortOrder === 'asc' && $sortColumn === 'name' ? 'desc' : 'asc']) }}">Name</a></th>
            <th style="padding-right: 50px;"><a href="{{ route('userstable', ['sort_column' => 'phone_number', 'sort_order' => $sortOrder === 'asc' && $sortColumn === 'phone_number' ? 'desc' : 'asc']) }}">Phone number</a></th>
            <th style="padding-right: 50px;"><a href="{{ route('userstable', ['sort_column' => 'created_at', 'sort_order' => $sortOrder === 'asc' && $sortColumn === 'created_at' ? 'desc' : 'asc']) }}">Date Reg</a></th>
            <!-- Add more columns as needed -->
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr>
                <td style="padding-right: 50px;"> {{ $user->name }}</td>

                <td style="padding-right: 50px;">{{ $user->phone_number }}</td>

                <td style="padding-right: 50px;">{{ $user->created_at }}</td>
                <!-- Display more user data as needed -->
            </tr>
        @endforeach
    </tbody>
</table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

