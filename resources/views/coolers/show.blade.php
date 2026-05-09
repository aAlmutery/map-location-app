@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold">Outlet Details</h1>
            <p class="text-gray-600">Comprehensive outlet survey information</p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('coolers.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded-lg">Back to List</a>
            <a href="{{ route('coolers.edit', $cooler) }}" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-lg">Edit Outlet</a>
        </div>
    </div>

    @if (session('success'))
        <div class="mb-4 p-4 bg-green-50 border border-green-200 rounded-lg">
            <p class="text-green-800">{{ session('success') }}</p>
        </div>
    @endif

    <!-- Basic Outlet Information -->
    <div class="bg-white rounded-lg shadow mb-6">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-900">Basic Outlet Information</h2>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div>
                    <h3 class="text-sm font-semibold text-gray-500 uppercase">Outlet Serial Number</h3>
                    <p class="text-lg text-gray-900">{{ $cooler->outlet_serial_number ?? 'N/A' }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-500 uppercase">Outlet Name</h3>
                    <p class="text-lg text-gray-900">{{ $cooler->outlet_name ?? 'N/A' }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-500 uppercase">Region</h3>
                    <p class="text-lg text-gray-900">{{ $cooler->region ?? 'N/A' }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-500 uppercase">City</h3>
                    <p class="text-lg text-gray-900">{{ $cooler->city ?? 'N/A' }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-500 uppercase">DC Name</h3>
                    <p class="text-lg text-gray-900">{{ $cooler->dc_name ?? 'N/A' }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-500 uppercase">Outlet Code BSDC Lays Code</h3>
                    <p class="text-lg text-gray-900">{{ $cooler->outlet_code_bsdc_lays_code ?? 'N/A' }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-500 uppercase">Chain Name</h3>
                    <p class="text-lg text-gray-900">{{ $cooler->chain_name ?? 'N/A' }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-500 uppercase">Belongs to Chain</h3>
                    <p class="text-lg text-gray-900">{{ $cooler->belongs_to_chain ? 'Yes' : 'No' }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-500 uppercase">Area Name</h3>
                    <p class="text-lg text-gray-900">{{ $cooler->area_name ?? 'N/A' }}</p>
                </div>
                <div class="md:col-span-2">
                    <h3 class="text-sm font-semibold text-gray-500 uppercase">Detailed Address</h3>
                    <p class="text-lg text-gray-900">{{ $cooler->detailed_address ?? 'N/A' }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-500 uppercase">Area Type</h3>
                    <p class="text-lg text-gray-900">{{ $cooler->area_type ?? 'N/A' }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-500 uppercase">Area Classification</h3>
                    <p class="text-lg text-gray-900">{{ $cooler->area_classification ?? 'N/A' }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-500 uppercase">Area Houses Type</h3>
                    <p class="text-lg text-gray-900">{{ $cooler->area_houses_type ?? 'N/A' }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-500 uppercase">Next To</h3>
                    <p class="text-lg text-gray-900">{{ $cooler->next_to ?? 'N/A' }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-500 uppercase">Type</h3>
                    <p class="text-lg text-gray-900">{{ $cooler->type ?? 'N/A' }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-500 uppercase">Classification</h3>
                    <p class="text-lg text-gray-900">{{ $cooler->classification ?? 'N/A' }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-500 uppercase">Size Per SQM</h3>
                    <p class="text-lg text-gray-900">{{ $cooler->size_per_sqm ? number_format($cooler->size_per_sqm, 2) : 'N/A' }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-500 uppercase">Top Shop</h3>
                    <p class="text-lg text-gray-900">{{ $cooler->top_shop ? 'Yes' : 'No' }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-500 uppercase">Signage Written In</h3>
                    <p class="text-lg text-gray-900">{{ $cooler->signage_written_in ?? 'N/A' }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Information -->
    <div class="bg-white rounded-lg shadow mb-6">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-900">Contact Information</h2>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div>
                    <h3 class="text-sm font-semibold text-gray-500 uppercase">Contact Person Name</h3>
                    <p class="text-lg text-gray-900">{{ $cooler->contact_person_name ?? 'N/A' }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-500 uppercase">Phone Number</h3>
                    <p class="text-lg text-gray-900">{{ $cooler->phone_number ?? 'N/A' }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-500 uppercase">Number of Cashier System</h3>
                    <p class="text-lg text-gray-900">{{ $cooler->cashier_system_count ?? 'N/A' }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-500 uppercase">POS Name</h3>
                    <p class="text-lg text-gray-900">{{ $cooler->pos_name ?? 'N/A' }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-500 uppercase">Delivery Availability</h3>
                    <p class="text-lg text-gray-900">{{ $cooler->delivery_availability ? 'Yes' : 'No' }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-500 uppercase">Butcher Availability</h3>
                    <p class="text-lg text-gray-900">{{ $cooler->butcher_availability ? 'Yes' : 'No' }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-500 uppercase">Frozen Food Availability</h3>
                    <p class="text-lg text-gray-900">{{ $cooler->frozen_food_availability ? 'Yes' : 'No' }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-500 uppercase">Outlet Service</h3>
                    <p class="text-lg text-gray-900">{{ $cooler->outlet_service ? 'Yes' : 'No' }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-500 uppercase">Storage Availability</h3>
                    <p class="text-lg text-gray-900">{{ $cooler->storage_availability ? 'Yes' : 'No' }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Pepsi Coolers -->
    <div class="bg-white rounded-lg shadow mb-6">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-900">Pepsi Coolers</h2>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-blue-50 rounded-lg p-4">
                    <h3 class="text-sm font-semibold text-blue-700">Total Pepsi Coolers</h3>
                    <p class="text-3xl font-bold text-blue-900">{{ $cooler->pepsi_coolers ?? 0 }}</p>
                </div>
                <div class="bg-blue-50 rounded-lg p-4">
                    <h3 class="text-sm font-semibold text-blue-700">Single Door Coolers</h3>
                    <p class="text-2xl font-bold text-blue-900">{{ $cooler->pepsi_single_door_coolers ?? 0 }}</p>
                </div>
                <div class="bg-blue-50 rounded-lg p-4">
                    <h3 class="text-sm font-semibold text-blue-700">Double Door Coolers</h3>
                    <p class="text-2xl font-bold text-blue-900">{{ $cooler->pepsi_double_door_coolers ?? 0 }}</p>
                </div>
                <div class="bg-blue-50 rounded-lg p-4">
                    <h3 class="text-sm font-semibold text-blue-700">Triple Door Coolers</h3>
                    <p class="text-2xl font-bold text-blue-900">{{ $cooler->pepsi_triple_door_coolers ?? 0 }}</p>
                </div>
            </div>
            <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="text-sm font-semibold text-gray-500 uppercase">Total Doors</h3>
                    <p class="text-lg text-gray-900">{{ $cooler->pepsi_total_doors ?? 0 }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-500 uppercase">Prime Location</h3>
                    <p class="text-lg text-gray-900">{{ $cooler->pepsi_prime_location ? 'Yes' : 'No' }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-500 uppercase">Cooler Location</h3>
                    <p class="text-lg text-gray-900">{{ $cooler->pepsi_cooler_location ?? 'N/A' }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-500 uppercase">Foreign Product Availability</h3>
                    <p class="text-lg text-gray-900">{{ $cooler->pepsi_foreign_product_availability ? 'Yes' : 'No' }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-500 uppercase">Can Availability</h3>
                    <p class="text-lg text-gray-900">{{ $cooler->pepsi_can_availability ? 'Yes' : 'No' }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-500 uppercase">NRB Availability</h3>
                    <p class="text-lg text-gray-900">{{ $cooler->pepsi_nrb_availability ? 'Yes' : 'No' }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-500 uppercase">PET Availability</h3>
                    <p class="text-lg text-gray-900">{{ $cooler->pepsi_pet_availability ? 'Yes' : 'No' }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Cola Coolers -->
    <div class="bg-white rounded-lg shadow mb-6">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-900">Cola Coolers</h2>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-red-50 rounded-lg p-4">
                    <h3 class="text-sm font-semibold text-red-700">Total Cola Coolers</h3>
                    <p class="text-3xl font-bold text-red-900">{{ $cooler->cola_coolers ?? 0 }}</p>
                </div>
                <div class="bg-red-50 rounded-lg p-4">
                    <h3 class="text-sm font-semibold text-red-700">Single Door Coolers</h3>
                    <p class="text-2xl font-bold text-red-900">{{ $cooler->cola_single_door_coolers ?? 0 }}</p>
                </div>
                <div class="bg-red-50 rounded-lg p-4">
                    <h3 class="text-sm font-semibold text-red-700">Double Door Coolers</h3>
                    <p class="text-2xl font-bold text-red-900">{{ $cooler->cola_double_door_coolers ?? 0 }}</p>
                </div>
                <div class="bg-red-50 rounded-lg p-4">
                    <h3 class="text-sm font-semibold text-red-700">Triple Door Coolers</h3>
                    <p class="text-2xl font-bold text-red-900">{{ $cooler->cola_triple_door_coolers ?? 0 }}</p>
                </div>
            </div>
            <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="text-sm font-semibold text-gray-500 uppercase">Total Doors</h3>
                    <p class="text-lg text-gray-900">{{ $cooler->cola_total_doors ?? 0 }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-500 uppercase">Prime Location</h3>
                    <p class="text-lg text-gray-900">{{ $cooler->cola_prime_location ? 'Yes' : 'No' }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-500 uppercase">Cooler Location</h3>
                    <p class="text-lg text-gray-900">{{ $cooler->cola_cooler_location ?? 'N/A' }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-500 uppercase">Can Availability</h3>
                    <p class="text-lg text-gray-900">{{ $cooler->cola_can_availability ? 'Yes' : 'No' }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-500 uppercase">NRB Availability</h3>
                    <p class="text-lg text-gray-900">{{ $cooler->cola_nrb_availability ? 'Yes' : 'No' }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-500 uppercase">PET Availability</h3>
                    <p class="text-lg text-gray-900">{{ $cooler->cola_pet_availability ? 'Yes' : 'No' }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Other Branded Coolers Summary -->
    <div class="bg-white rounded-lg shadow mb-6">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-900">Other Branded Coolers Summary</h2>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-gray-50 rounded-lg p-4">
                    <h3 class="text-sm font-semibold text-gray-700">Total Other Branded Coolers</h3>
                    <p class="text-3xl font-bold text-gray-900">{{ $cooler->other_branded_coolers ?? 0 }}</p>
                </div>
                <div class="bg-gray-50 rounded-lg p-4">
                    <h3 class="text-sm font-semibold text-gray-700">Total Number of Coolers</h3>
                    <p class="text-3xl font-bold text-gray-900">{{ $cooler->total_number_of_coolers ?? 0 }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-500 uppercase">Open Chiller Availability</h3>
                    <p class="text-lg text-gray-900">{{ $cooler->open_chiller_availability ? 'Yes' : 'No' }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-500 uppercase">Open Chiller Length</h3>
                    <p class="text-lg text-gray-900">{{ $cooler->open_chiller_length ? number_format($cooler->open_chiller_length, 2) : 'N/A' }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-500 uppercase">Not Branded Coolers Availability</h3>
                    <p class="text-lg text-gray-900">{{ $cooler->not_branded_coolers_availability ? 'Yes' : 'No' }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Snack Availability -->
    <div class="bg-white rounded-lg shadow mb-6">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-900">Snack Availability</h2>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div>
                    <h3 class="text-sm font-semibold text-gray-500 uppercase">Lays Availability</h3>
                    <p class="text-lg text-gray-900">{{ $cooler->lays_availability ? 'Yes' : 'No' }}</p>
                    @if($cooler->lays_availability)
                        <p class="text-sm text-gray-600">Location: {{ $cooler->lays_availability_location ?? 'N/A' }}</p>
                        <p class="text-sm text-gray-600">Blocks: {{ $cooler->lays_blocks ?? 0 }}</p>
                        <p class="text-sm text-gray-600">Stand: {{ $cooler->lays_stand ? 'Yes' : 'No' }}</p>
                    @endif
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-500 uppercase">Doritos Availability</h3>
                    <p class="text-lg text-gray-900">{{ $cooler->doritos_availability ? 'Yes' : 'No' }}</p>
                    @if($cooler->doritos_availability)
                        <p class="text-sm text-gray-600">Location: {{ $cooler->doritos_availability_location ?? 'N/A' }}</p>
                        <p class="text-sm text-gray-600">Blocks: {{ $cooler->doritos_blocks ?? 0 }}</p>
                        <p class="text-sm text-gray-600">Stand: {{ $cooler->doritos_stand ? 'Yes' : 'No' }}</p>
                    @endif
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-500 uppercase">Cheetos Availability</h3>
                    <p class="text-lg text-gray-900">{{ $cooler->cheetos_availability ? 'Yes' : 'No' }}</p>
                    @if($cooler->cheetos_availability)
                        <p class="text-sm text-gray-600">Location: {{ $cooler->cheetos_availability_location ?? 'N/A' }}</p>
                        <p class="text-sm text-gray-600">Blocks: {{ $cooler->cheetos_blocks ?? 0 }}</p>
                        <p class="text-sm text-gray-600">Stand: {{ $cooler->cheetos_stand ? 'Yes' : 'No' }}</p>
                    @endif
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-500 uppercase">Nice Availability</h3>
                    <p class="text-lg text-gray-900">{{ $cooler->nice_availability ? 'Yes' : 'No' }}</p>
                    @if($cooler->nice_availability)
                        <p class="text-sm text-gray-600">Blocks: {{ $cooler->nice_blocks ?? 0 }}</p>
                        <p class="text-sm text-gray-600">Stand: {{ $cooler->nice_stand ? 'Yes' : 'No' }}</p>
                    @endif
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-500 uppercase">Bato Availability</h3>
                    <p class="text-lg text-gray-900">{{ $cooler->bato_availability ? 'Yes' : 'No' }}</p>
                    @if($cooler->bato_availability)
                        <p class="text-sm text-gray-600">Blocks: {{ $cooler->bato_blocks ?? 0 }}</p>
                        <p class="text-sm text-gray-600">Stand: {{ $cooler->bato_stand ? 'Yes' : 'No' }}</p>
                    @endif
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-500 uppercase">Pringles Availability</h3>
                    <p class="text-lg text-gray-900">{{ $cooler->pringles_availability ? 'Yes' : 'No' }}</p>
                    @if($cooler->pringles_availability)
                        <p class="text-sm text-gray-600">Blocks: {{ $cooler->pringles_blocks ?? 0 }}</p>
                        <p class="text-sm text-gray-600">Stand: {{ $cooler->pringles_stand ? 'Yes' : 'No' }}</p>
                    @endif
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-500 uppercase">Dana Dana Availability</h3>
                    <p class="text-lg text-gray-900">{{ $cooler->dana_dana_availability ? 'Yes' : 'No' }}</p>
                    @if($cooler->dana_dana_availability)
                        <p class="text-sm text-gray-600">Blocks: {{ $cooler->dana_dana_blocks ?? 0 }}</p>
                        <p class="text-sm text-gray-600">Stand: {{ $cooler->dana_dana_stand ? 'Yes' : 'No' }}</p>
                    @endif
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-500 uppercase">Kish Availability</h3>
                    <p class="text-lg text-gray-900">{{ $cooler->kish_availability ? 'Yes' : 'No' }}</p>
                    @if($cooler->kish_availability)
                        <p class="text-sm text-gray-600">Blocks: {{ $cooler->kish_blocks ?? 0 }}</p>
                        <p class="text-sm text-gray-600">Stand: {{ $cooler->kish_stand ? 'Yes' : 'No' }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Other Products -->
    <div class="bg-white rounded-lg shadow mb-6">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-900">Other Products</h2>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div>
                    <h3 class="text-sm font-semibold text-gray-500 uppercase">Battery</h3>
                    <p class="text-lg text-gray-900">{{ $cooler->battery ? 'Yes' : 'No' }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-500 uppercase">Biscuits</h3>
                    <p class="text-lg text-gray-900">{{ $cooler->biscuits ? 'Yes' : 'No' }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-500 uppercase">Chocolate</h3>
                    <p class="text-lg text-gray-900">{{ $cooler->chocolate ? 'Yes' : 'No' }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-500 uppercase">Ice Cream</h3>
                    <p class="text-lg text-gray-900">{{ $cooler->ice_cream ? 'Yes' : 'No' }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-500 uppercase">Nuts</h3>
                    <p class="text-lg text-gray-900">{{ $cooler->nuts ? 'Yes' : 'No' }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-500 uppercase">Personal Care</h3>
                    <p class="text-lg text-gray-900">{{ $cooler->personal_care ? 'Yes' : 'No' }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-500 uppercase">Popcorn</h3>
                    <p class="text-lg text-gray-900">{{ $cooler->popcorn ? 'Yes' : 'No' }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-500 uppercase">Rice Pack</h3>
                    <p class="text-lg text-gray-900">{{ $cooler->rice_pack ? 'Yes' : 'No' }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-500 uppercase">Tobacco</h3>
                    <p class="text-lg text-gray-900">{{ $cooler->tobacco ? 'Yes' : 'No' }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
