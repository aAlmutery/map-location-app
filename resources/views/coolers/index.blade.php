@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-6 flex justify-between items-center">
        <h1 class="text-3xl font-bold">Census Data</h1>
        <a href="{{ route('coolers.import-form') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition">
            Import Data
        </a>
    </div>

    @if (session('success'))
        <div class="mb-4 p-4 bg-green-50 border border-green-200 rounded-lg">
            <p class="text-green-800">{{ session('success') }}</p>
        </div>
    @endif

    @if (session('error'))
        <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-lg">
            <p class="text-red-800">{{ session('error') }}</p>
        </div>
    @endif

    <!-- Filters Section -->
    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <h2 class="text-xl font-semibold mb-4">Filters</h2>
        <form method="GET" action="{{ route('coolers.index') }}" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <!-- Outlet Name Filter -->
                <div>
                    <label for="outlet_name" class="block text-sm font-medium text-gray-700 mb-1">
                        Outlet Name
                    </label>
                    <input type="text" id="outlet_name" name="outlet_name" 
                        value="{{ request('outlet_name') }}"
                        placeholder="Search outlet name..."
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Region Filter -->
                <div>
                    <label for="region" class="block text-sm font-medium text-gray-700 mb-1">
                        Region
                    </label>
                    <select id="region" name="region" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">All Regions</option>
                        @foreach ($regions as $region)
                            <option value="{{ $region }}" {{ request('region') == $region ? 'selected' : '' }}>
                                {{ $region }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- City Filter -->
                <div>
                    <label for="city" class="block text-sm font-medium text-gray-700 mb-1">
                        City
                    </label>
                    <select id="city" name="city" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">All Cities</option>
                        @foreach ($cities as $city)
                            <option value="{{ $city }}" {{ request('city') == $city ? 'selected' : '' }}>
                                {{ $city }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Chain Name Filter -->
                <div>
                    <label for="chain_name" class="block text-sm font-medium text-gray-700 mb-1">
                        Chain Name
                    </label>
                    <select id="chain_name" name="chain_name" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">All Chains</option>
                        @foreach ($chains as $chain)
                            <option value="{{ $chain }}" {{ request('chain_name') == $chain ? 'selected' : '' }}>
                                {{ $chain }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Pepsi Coolers Filter -->
                <div>
                    <label for="pepsi_coolers" class="block text-sm font-medium text-gray-700 mb-1">
                        Pepsi Coolers (min)
                    </label>
                    <input type="number" id="pepsi_coolers" name="pepsi_coolers" 
                        value="{{ request('pepsi_coolers') }}"
                        placeholder="0"
                        min="0"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Cola Coolers Filter -->
                <div>
                    <label for="cola_coolers" class="block text-sm font-medium text-gray-700 mb-1">
                        Cola Coolers (min)
                    </label>
                    <input type="number" id="cola_coolers" name="cola_coolers" 
                        value="{{ request('cola_coolers') }}"
                        placeholder="0"
                        min="0"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Other Branded Coolers Filter -->
                <div>
                    <label for="other_branded_coolers" class="block text-sm font-medium text-gray-700 mb-1">
                        Other Branded Coolers (min)
                    </label>
                    <input type="number" id="other_branded_coolers" name="other_branded_coolers" 
                        value="{{ request('other_branded_coolers') }}"
                        placeholder="0"
                        min="0"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Total Coolers Filter -->
                <div>
                    <label for="total_number_of_coolers" class="block text-sm font-medium text-gray-700 mb-1">
                        Total Coolers (min)
                    </label>
                    <input type="number" id="total_number_of_coolers" name="total_number_of_coolers" 
                        value="{{ request('total_number_of_coolers') }}"
                        placeholder="0"
                        min="0"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>

            <div class="flex gap-2 pt-2">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg transition">
                    Apply Filters
                </button>
                <a href="{{ route('coolers.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-6 rounded-lg transition">
                    Clear Filters
                </a>
            </div>
        </form>
    </div>

    <!-- Data Table -->
    @if ($coolers->count() > 0)
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-100 border-b border-gray-300">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Outlet Name</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Region</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">City</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Chain</th>
                            <th class="px-6 py-3 text-center text-sm font-semibold text-gray-700">Pepsi Coolers</th>
                            <th class="px-6 py-3 text-center text-sm font-semibold text-gray-700">Cola Coolers</th>
                            <th class="px-6 py-3 text-center text-sm font-semibold text-gray-700">Other Branded</th>
                            <th class="px-6 py-3 text-center text-sm font-semibold text-gray-700">Total Coolers</th>
                            <th class="px-6 py-3 text-center text-sm font-semibold text-gray-700">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($coolers as $cooler)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 text-sm text-gray-900 font-medium">{{ $cooler->outlet_name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $cooler->region }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $cooler->city }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $cooler->chain_name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900 text-center">
                                    <span class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded-full font-semibold">
                                        {{ $cooler->pepsi_coolers ?? 0 }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900 text-center">
                                    <span class="inline-block bg-red-100 text-red-800 px-3 py-1 rounded-full font-semibold">
                                        {{ $cooler->cola_coolers ?? 0 }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900 text-center">
                                    <span class="inline-block bg-gray-100 text-gray-800 px-3 py-1 rounded-full font-semibold">
                                        {{ $cooler->other_branded_coolers ?? 0 }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900 text-center font-bold">
                                    {{ ($cooler->pepsi_coolers ?? 0) + ($cooler->cola_coolers ?? 0) + ($cooler->other_branded_coolers ?? 0) }}
                                </td>
                                <td class="px-6 py-4 text-sm text-right space-x-2 flex items-center justify-end gap-2">
                                    <a href="{{ route('coolers.show', $cooler) }}" class="text-blue-600 hover:text-blue-800 font-medium">View</a>
                                    <a href="{{ route('coolers.edit', $cooler) }}" class="text-green-600 hover:text-green-800 font-medium">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if ($coolers->hasPages())
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $coolers->links() }}
                </div>
            @endif
        </div>

        <div class="mt-4 text-sm text-gray-600">
            Showing <strong>{{ $coolers->count() }}</strong> of <strong>{{ $coolers->total() }}</strong> records
        </div>
    @else
        <div class="bg-white rounded-lg shadow p-6 text-center">
            <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
            </svg>
            <p class="text-gray-600 text-lg mb-4">No data found. Start by importing a CSV or Excel file.</p>
            <a href="{{ route('coolers.import-form') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg transition inline-block">
                Import Data Now
            </a>
        </div>
    @endif
</div>
@endsection
